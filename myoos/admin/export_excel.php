<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  define('OOS_VALID_MOD', 'yes');
  require 'includes/main.php';


  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (!empty($action)) {
    switch ($action) {

      case 'make_file_now':
        $excel_file = 'db_export-' . date('YmdHis') . '.cvs';
        $fp = fopen(OOS_EXPORT_PATH . $excel_file, 'w');

        $schema = '';
        $schema .= 'id | Model | Name | tax_class_id | Status |  Price ' .  "\n";

        $nLanguageID = intval($_SESSION['language_id']);

        $productstable = $oostable['products'];
        $products_descriptiontable = $oostable['products_description'];
        $sql = "SELECT p.products_id, p.products_model, p.products_price, p.products_tax_class_id, p.products_status, pd.products_name
                FROM $productstable p,
                     $products_descriptiontable pd
                WHERE p.products_id = pd.products_id
                  AND pd.products_languages_id = '" . intval($nLanguageID) . "'";
        $products_result = $dbconn->Execute($sql);

        $rows = 0;
        while ($products = $products_result->fields) {
          $rows++;

          $name = $products['products_name'];
          $name = str_replace('|',' ',$name);
          $name = strip_tags($name); 

          $price = $products['products_price'];
          $tax = (100+oos_get_tax_rate($products['products_tax_class_id']))/100;
          $price = number_format($price*$tax,2,".","");

          $schema .= $products['products_id']. '|'  . $products['products_model'] . '|' . $name . '|' . $products['products_tax_class_id'] . '|' . $products['products_status'] . '|' . $price . "\n";

          // Move that ADOdb pointer!
          $products_result->MoveNext();
        }


        fputs($fp, $schema);
        fclose($fp);

        if (isset($_POST['download']) && ($_POST['download'] == 'yes')) {
          switch ($_POST['compress']) {
            case 'gzip':
              exec(LOCAL_EXE_GZIP . ' ' . OOS_EXPORT_PATH . $excel_file);
              $excel_file .= '.gz';
              break;

            case 'zip':
              exec(LOCAL_EXE_ZIP . ' -j ' . OOS_EXPORT_PATH . $excel_file . '.zip ' . OOS_EXPORT_PATH . $excel_file);
              @unlink(OOS_EXPORT_PATH . $excel_file);
              $excel_file .= '.zip';
          }
          header('Content-type: application/x-octet-stream');
          header('Content-disposition: attachment; filename=' . $excel_file);

          readfile(OOS_EXPORT_PATH . $excel_file);
          @unlink(OOS_EXPORT_PATH . $excel_file);

          exit;
        } else {
          switch ($_POST['compress']) {
            case 'gzip':
              exec(LOCAL_EXE_GZIP . ' ' . $excel_file);
              break;

            case 'zip':
              exec(LOCAL_EXE_ZIP . ' -j ' . $excel_file . '.zip ' . $excel_file);
              unlink(OOS_EXPORT_PATH . $excel_file);
          }
          $messageStack->add_session(SUCCESS_DATABASE_SAVED, 'success');
        }
        oos_redirect_admin(oos_href_link_admin($aContents['export_excel']));
        break;

      case 'download':
        $extension = substr($_GET['file'], -3);
        if ( ($extension == 'zip') || ($extension == '.gz') || ($extension == 'cvs') ) {
          if ($fp = fopen(OOS_EXPORT_PATH . $_GET['file'], 'rb')) {
            $buffer = fread($fp, filesize(OOS_EXPORT_PATH . $_GET['file']));
            fclose($fp);
            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $_GET['file']);
            echo $buffer;
            exit;
          }
        } else {
          $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) oos_redirect_admin(oos_href_link_admin($aContents['export_excel']));

        oos_remove(OOS_EXPORT_PATH . '/' . oos_db_prepare_input($_GET['file']));
        if (!$oos_remove_error) {
          $messageStack->add_session(SUCCESS_EXPORT_DELETED, 'success');
          oos_redirect_admin(oos_href_link_admin($aContents['export_excel']));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = FALSE;
  if (is_dir(oos_get_local_path(OOS_EXPORT_PATH))) {
    if (is_writeable(oos_get_local_path(OOS_EXPORT_PATH))) {
      $dir_ok = TRUE;
    } else {
      $messageStack->add(ERROR_EXPORT_DIRECTORY_NOT_WRITEABLE, 'error');
    }
  } else {
    $messageStack->add(ERROR_EXPORT_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

  require 'includes/header.php'; 
?>
<div class="wrapper">
	<!-- Header //-->
	<header class="topnavbar-wrapper">
		<!-- Top Navbar //-->
		<?php require 'includes/menue.php'; ?>
	</header>
	<!-- END Header //-->
	<aside class="aside">
		<!-- Sidebar //-->
		<div class="aside-inner">
			<?php require 'includes/blocks.php'; ?>
		</div>
		<!-- END Sidebar (left) //-->
	</aside>
	
	<!-- Main section //-->
	<section>
		<!-- Page content //-->
		<div class="content-wrapper">
							
			<!-- Breadcrumbs //-->
			<div class="content-heading">
				<div class="col-lg-12">
					<h2><?php echo HEADING_TITLE; ?></h2>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<?php echo '<a href="' . oos_href_link_admin($aContents['default']) . '">' . HEADER_TITLE_TOP . '</a>'; ?>
						</li>
						<li class="breadcrumb-item">
							<?php echo '<a href="' . oos_href_link_admin($aContents['categories'], 'selected_box=catalog') . '">' . BOX_HEADING_CATALOG . '</a>'; ?>
						</li>
						<li class="breadcrumb-item active">
							<strong><?php echo HEADING_TITLE; ?></strong>
						</li>
					</ol>
				</div>
			</div>
			<!-- END Breadcrumbs //-->

			<div class="wrapper wrapper-content">
				<div class="row">
					<div class="col-lg-12">	
<!-- body_text //-->
	<div class="table-responsive">
		<table class="table w-100">
          <tr>
            <td valign="top">
				<table class="table table-striped table-hover w-100">
					<thead class="thead-dark">
						<tr>
							<th><?php echo TABLE_HEADING_TITLE; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_FILE_DATE; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_FILE_SIZE; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
						</tr>	
					</thead>
<?php
if ($dir_ok) {
	$dir = dir(OOS_EXPORT_PATH);
	$contents = array();
	while ($file = $dir->read()) {
        if ( ($file != '.') && ($file != '..') && ($file != '.htaccess') ) {
			if (!is_dir(OOS_EXPORT_PATH . $file)) {
				$contents[] = $file;
			}
		}
	}
    sort($contents);
	
    for ($files = 0, $count = count($contents); $files < $count; $files++) {
		$entry = $contents[$files];

		$check = 0;

		if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] == $entry))) && !isset($buInfo) && ($action != 'backup')) {
			$file_array['file'] = $entry;
			$file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(OOS_EXPORT_PATH . $entry));
			$file_array['size'] = number_format(filesize(OOS_EXPORT_PATH . $entry)) . ' bytes';
			
			switch (substr($entry, -3)) {
				case 'zip': $file_array['compression'] = 'ZIP'; break;
				case '.gz': $file_array['compression'] = 'GZIP'; break;
				default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
			}

			$buInfo = new objectInfo($file_array);
		}

		echo '              <tr>' . "\n";
		$onclick_link = 'file=' . $entry;
?>
                <td onclick="document.location.href='<?php echo oos_href_link_admin($aContents['export_excel'], $onclick_link); ?>'"><?php echo '<a href="' . oos_href_link_admin($aContents['export_excel'], 'action=download&file=' . $entry) . '">' . oos_image(OOS_IMAGES . 'icons/file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td>
                <td align="center" onclick="document.location.href='<?php echo oos_href_link_admin($aContents['export_excel'], $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(OOS_EXPORT_PATH . $entry)); ?></td>
                <td align="right" onclick="document.location.href='<?php echo oos_href_link_admin($aContents['export_excel'], $onclick_link); ?>'"><?php echo number_format(filesize(OOS_EXPORT_PATH . $entry)); ?> bytes</td>
                <td class="text-right"><?php if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file) ) { echo '<button class="btn btn-info" type="button"><i class="fa fa-check" aria-hidden="true"></i></i></button>'; } else { echo '<a href="' . oos_href_link_admin($aContents['export_excel'], 'file=' . $entry) . '">' . oos_image(OOS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
    $dir->close();
}
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_EXPORT_DIRECTORY . ' ' . OOS_EXPORT_PATH; ?></td>
                <td align="right" class="smallText"><?php if ($action != 'backup')  echo '<a href="' . oos_href_link_admin($aContents['export_excel'], 'action=backup') . '">' . oos_button(BUTTON_BACKUP) . '</a>'; ?></td>
             </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'backup':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_BACKUP . '</b>');

      $contents = array('form' => oos_draw_form('id', 'backup', $aContents['export_excel'], 'action=make_file_now', 'post', FALSE));
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);
      
      if (file_exists(LOCAL_EXE_GZIP)) $contents[] = array('text' => '<br />' . oos_draw_radio_field('compress', 'gzip') . ' ' . TEXT_INFO_USE_GZIP);
      if (file_exists(LOCAL_EXE_ZIP)) $contents[] = array('text' => oos_draw_radio_field('compress', 'zip') . ' ' . TEXT_INFO_USE_ZIP);

      if ($dir_ok == TRUE) {
        $contents[] = array('text' => '<br />' . oos_draw_checkbox_field('download', 'yes') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><br />*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      } else {
        $contents[] = array('text' => '<br />' . oos_draw_radio_field('download', 'yes', TRUE) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><br />*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      }

      $contents[] = array('align' => 'center', 'text' => '<br />' . oos_submit_button(BUTTON_BACKUP) . '&nbsp;<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['export_excel']) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    case 'delete':
      $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

      $contents = array('form' => oos_draw_form('id', 'delete', $aContents['export_excel'], 'file=' . $buInfo->file . '&action=deleteconfirm', 'post', FALSE));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $buInfo->file . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . oos_submit_button(BUTTON_DELETE) . ' <a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['export_excel'], 'file=' . $buInfo->file) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    default:
      if (isset($buInfo) && is_object($buInfo)) {
        $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . oos_href_link_admin($aContents['export_excel'], 'file=' . $buInfo->file . '&action=delete') . '">' . oos_button(BUTTON_DELETE) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

    if ( (oos_is_not_null($heading)) && (oos_is_not_null($contents)) ) {
?>
	<td class="w-25">
		<table class="table table-striped">
<?php
		$box = new box;
		echo $box->infoBox($heading, $contents);  
?>
		</table> 
	</td> 
<?php
  }
?>
          </tr>
        </table>
	</div>
<!-- body_text_eof //-->
				</div>
			</div>
        </div>

		</div>
	</section>
	<!-- Page footer //-->
	<footer>
		<span>&copy; <?php echo date('Y'); ?> - <a href="https://www.oos-shop.de" target="_blank" rel="noopener">MyOOS [Shopsystem]</a></span>
	</footer>
</div>


<?php 
	require 'includes/bottom.php';
	require 'includes/nice_exit.php';
?>