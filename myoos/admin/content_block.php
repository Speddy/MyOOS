<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('OOS_VALID_MOD', 'yes');
require 'includes/main.php';
require 'includes/functions/function_block.php';

$nPage = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : intval($_GET['page']);
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!empty($action)) {
    switch ($action) {
        case 'setflag':
            if (isset($_GET['bID'])) {
                if (isset($_GET['flag']) && ($_GET['flag'] == '1')) {
                    $dbconn->Execute("UPDATE " . $oostable['block'] . " SET block_status = '1' WHERE block_id = '" . intval($_GET['bID']) . "'");
                } elseif (isset($_GET['flag']) && ($_GET['flag'] == '0')) {
                    $dbconn->Execute("UPDATE " . $oostable['block'] . " SET block_status = '0' WHERE block_id = '" . intval($_GET['bID']) . "'");
                }
            }
            oos_redirect_admin(oos_href_link_admin($aContents['content_block'], 'page=' . intval($nPage) . '&bID=' . intval($_GET['bID'])));
            break;

        case 'setloginflag':
            if (isset($_GET['bID'])) {
                if (isset($_GET['login_flag']) && ($_GET['login_flag'] == '1')) {
                    $dbconn->Execute("UPDATE " . $oostable['block'] . " SET block_login_flag = '1' WHERE block_id = '" . intval($_GET['bID']) . "'");
                } elseif (isset($_GET['login_flag']) && ($_GET['login_flag'] == '0')) {
                    $dbconn->Execute("UPDATE " . $oostable['block'] . " SET block_login_flag = '0' WHERE block_id = '" . intval($_GET['bID']) . "'");
                }
            }
            oos_redirect_admin(oos_href_link_admin($aContents['content_block'], 'page=' . intval($nPage) . '&bID=' . intval($_GET['bID'])));
            break;

      case 'insert':
      case 'save':
        $block_content_id = oos_db_prepare_input($_GET['bID']);

        $block_side = oos_db_prepare_input($_POST['block_side']);
        $function  = oos_db_prepare_input($_POST['function']);
        $block_cache  = oos_db_prepare_input($_POST['block_cache']);
        $sort_order  = oos_db_prepare_input($_POST['sort_order']);
        $block_status  = oos_db_prepare_input($_POST['block_status']);
        $block_login_flag  = oos_db_prepare_input($_POST['block_login_flag']);

        $sql_data_array = array('block_side' => $block_side,
                                'block_file' => $function,
                                'block_cache' => $block_cache,
                                'block_sort_order' => $sort_order,
                                'block_status' => $block_status,
                                'block_login_flag' => $block_login_flag);
        if ($action == 'insert') {
            $insert_sql_data = array('date_added' => 'now()',
                                   'set_function' => 'oos_block_select_option(array(\'\', \'sidebar\'),');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            oos_db_perform($oostable['block'], $sql_data_array);
            $block_content_id = $dbconn->Insert_ID();
        } elseif ($action == 'save') {
            $update_sql_data = array('last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            oos_db_perform($oostable['block'], $sql_data_array, 'UPDATE', "block_id = '" . intval($block_content_id) . "'");
            $dbconn->Execute("DELETE FROM " . $oostable['block_to_page_type'] . " WHERE block_id = '" . intval($block_content_id) . "'");
        }

        $languages = oos_get_languages();
        for ($i = 0, $n = count($languages); $i < $n; $i++) {
            $block_content_name_array = oos_db_prepare_input($_POST['block_name']);
            $language_id = $languages[$i]['id'];

            $sql_data_array = array('block_name' => oos_db_prepare_input($block_content_name_array[$language_id]));

            if ($action == 'insert') {
                $insert_sql_data = array('block_id' => $block_content_id,
                                     'block_languages_id' => $language_id);

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                oos_db_perform($oostable['block_info'], $sql_data_array);
            } elseif ($action == 'save') {
                oos_db_perform($oostable['block_info'], $sql_data_array, 'UPDATE', "block_id = '" . intval($block_content_id) . "' AND block_languages_id = '" . intval($language_id) . "'");
            }
        }

        if (isset($_REQUEST['page_type'])) {
            reset($_REQUEST['page_type']);
            foreach ($_REQUEST['page_type'] as $k => $id) {
                $sql = "INSERT INTO " . $oostable['block_to_page_type'] . "
                     (block_id,
                      page_type_id)
                      VALUES (" . $dbconn->qstr($block_content_id) . ','
                                . $dbconn->qstr($id) . ")";
                $dbconn->Execute($sql);
            }
        }

        oos_redirect_admin(oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $block_content_id));
        break;

      case 'deleteconfirm':
        $block_content_id = oos_db_prepare_input($_GET['bID']);

        $dbconn->Execute("DELETE FROM " . $oostable['block'] . " WHERE block_id = '" . intval($block_content_id) . "'");
        $dbconn->Execute("DELETE FROM " . $oostable['block_info'] . " WHERE block_id = '" . intval($block_content_id) . "'");
        $dbconn->Execute("DELETE FROM " . $oostable['block_to_page_type'] . " WHERE block_id = '" . intval($block_content_id) . "'");

        oos_redirect_admin(oos_href_link_admin($aContents['content_block'], 'page=' . $nPage));
        break;
    }
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
							<?php echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'selected_box=content') . '">' . BOX_HEADING_CONTENT . '</a>'; ?>
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
							<th><?php echo TABLE_HEADING_BLOCK; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_COLUMN; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_SORT_ORDER; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_STATUS; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_LOGIN; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
						</tr>
					</thead>
<?php
   $blocktable = $oostable['block'];
   $block_infotable = $oostable['block_info'];
   $block_content_result_raw = "SELECT b.block_id, bi.block_name, b.block_side, b.block_file, b.block_sort_order,
                                       b.block_status, b.block_login_flag, b.block_cache, b.date_added,
                                       b.last_modified, b.set_function
                                FROM $blocktable b,
                                     " . $block_infotable . " bi
                                WHERE b.block_id = bi.block_id AND
                                      bi.block_languages_id = '" . intval($_SESSION['language_id']) . "'
                                ORDER BY b.block_sort_order, b.block_side";
  $block_content_split = new splitPageResults($nPage, MAX_DISPLAY_SEARCH_RESULTS, $block_content_result_raw, $block_content_result_numrows);
  $block_content_result = $dbconn->Execute($block_content_result_raw);
  while ($block = $block_content_result->fields) {
      if ((!isset($_GET['bID']) || (isset($_GET['bID']) && ($_GET['bID'] == $block['block_id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'new')) {
          $bInfo = new objectInfo($block);
      } ?>
			<tr>
                <td><?php echo $block['block_name']; ?></td>
                <td class="text-center"><?php echo $block['block_side']; ?></td>
                <td class="text-center"><?php echo $block['block_sort_order']; ?></td>
                <td class="text-center">
<?php
  if ($block['block_status'] == '1') {
      echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'action=setflag&flag=0&bID=' . $block['block_id'] . '&page=' . $nPage) . '">' . oos_image(OOS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
  } else {
      echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'action=setflag&flag=1&bID=' . $block['block_id'] . '&page=' . $nPage) . '">' . oos_image(OOS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>';
  } ?></td>
                <td class="text-center">
<?php
  if ($block['block_login_flag'] == '1') {
      echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'action=setloginflag&login_flag=0&bID=' . $block['block_id'] . '&page=' . $nPage) . '">' . oos_image(OOS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
  } else {
      echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'action=setloginflag&login_flag=1&bID=' . $block['block_id'] . '&page=' . $nPage) . '">' . oos_image(OOS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>';
  } ?></td>
                <td class="text-right"><?php if (isset($bInfo) && is_object($bInfo) && ($block['block_id'] == $bInfo->block_id)) {
      echo '<button class="btn btn-info" type="button"><i class="fa fa-check" aria-hidden="true"></i></i></button>';
  } else {
      echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $block['block_id']) . '"><button class="btn btn-default" type="button"><i class="fa fa-eye-slash"></i></button></a>';
  } ?>&nbsp;</td>
              </tr>
<?php
    // Move that ADOdb pointer!
    $block_content_result->MoveNext();
  }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $block_content_split->display_count($block_content_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, $nPage, TEXT_DISPLAY_NUMBER_OF_BLOCKES); ?></td>
                    <td class="smallText" align="right"><?php echo $block_content_split->display_links($block_content_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $nPage); ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
      ?>
              <tr>
                <td align="right" colspan="6" class="smallText"><?php echo '<a href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id . '&action=new') . '">' . oos_button(BUTTON_INSERT) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = [];
  $contents = [];

  $block_status_array = [];
  $block_login_flag_array = [];
  $block_login_flag_array = array(array('id' => '0', 'text' => ENTRY_NO),
                                  array('id' => '1', 'text' => ENTRY_YES));
  $block_status_array = array(array('id' => '0', 'text' => ENTRY_NO),
                              array('id' => '1', 'text' => ENTRY_YES));

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_BLOCK . '</b>');

      $contents = array('form' => oos_draw_form('id', 'block', $aContents['content_block'], 'action=insert', 'post', false, 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);

      $block_inputs_string = '';
      $languages = oos_get_languages();
      for ($i = 0, $n = count($languages); $i < $n; $i++) {
          $block_inputs_string .= '<br>' . oos_flag_icon($languages[$i]) . '&nbsp;' . oos_draw_input_field('block_name[' . $languages[$i]['id'] . ']');
      }
      $contents[] = array('text' => '<br><b>' . TEXT_BLOCK_NAME . ':</b>' .$block_inputs_string);
      $contents[] = array('text' => '<br><b>' . TEXT_BLOCK_FUNCTION . ':</b><br>' . oos_draw_input_field('function'));
      $contents[] = array('text' => '<br><b>' . TEXT_BLOCK_CACHE . ':</b><br>' . oos_draw_input_field('block_cache'));
      $contents[] = array('text' => '<br><b>' . TABLE_HEADING_COLUMN . ':</b><br>' . oos_block_select_option(array('', 'sidebar'), 'block_side'));
      $contents[] = array('text' => '<br><b>'  . TABLE_HEADING_STATUS . ':</b> ' . oos_draw_pull_down_menu('block_status', $block_status_array));
      $contents[] = array('text' => '<br><b>'  . TEXT_BLOCK_LOGIN . '</b> ' . oos_draw_pull_down_menu('block_login_flag', $block_login_flag_array));
      $contents[] = array('text' => '<br><b>'  . TEXT_BLOCK_PAGE . '</b><br>' . oos_select_block_to_page());

      $contents[] = array('text' => '<br><b>' . TABLE_HEADING_SORT_ORDER . ':</b> ' . oos_draw_input_field('sort_order', '', 'size="2"'));

      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_SAVE) . ' <a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $_GET['bID']) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_BLOCK . '</b>');

      $contents = array('form' => oos_draw_form('id', 'block', $aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id . '&action=save', 'post', false, 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_EDIT_INTRO);

      $block_inputs_string = '';
      $languages = oos_get_languages();
      for ($i = 0, $n = count($languages); $i < $n; $i++) {
          $block_inputs_string .= '<br>' . oos_flag_icon($languages[$i]) . '&nbsp;' . oos_draw_input_field('block_name[' . $languages[$i]['id'] . ']', oos_get_block_name($bInfo->block_id, $languages[$i]['id']));
      }
      eval('$value_field = ' . $bInfo->set_function . '"' . htmlspecialchars($bInfo->block_side, ENT_QUOTES, 'UTF-8') . '");');

      $contents[] = array('text' => '<br>' . TEXT_BLOCK_NAME . $block_inputs_string);
      $contents[] = array('text' => '<br><b>' . TEXT_BLOCK_FUNCTION . ':</b><br>' . oos_draw_input_field('function', $bInfo->block_file));
      $contents[] = array('text' => '<br><b>' . TEXT_BLOCK_CACHE . ':</b><br>' . oos_draw_input_field('block_cache', $bInfo->block_cache));
      $contents[] = array('text' => '<br><b>' . TABLE_HEADING_COLUMN . ':</b><br>' . $value_field);
      $contents[] = array('text' => '<br><b>'  . TABLE_HEADING_STATUS . ':</b> ' . oos_draw_pull_down_menu('block_status', $block_status_array, $bInfo->block_status));
      $contents[] = array('text' => '<br><b>'  . TEXT_BLOCK_LOGIN . ':</b> ' . oos_draw_pull_down_menu('block_login_flag', $block_login_flag_array, $bInfo->block_login_flag));
      $contents[] = array('text' => '<br><b>'  . TEXT_BLOCK_PAGE . ':</b><br>' . oos_show_block_to_page($bInfo->block_id));

      $contents[] = array('text' => '<br><b>' . TABLE_HEADING_SORT_ORDER . ':</b><br>' . oos_draw_input_field('sort_order', $bInfo->block_sort_order, 'size="2"'));

      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_SAVE) . ' <a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_BLOCK . '</b>');

      $contents = array('form' => oos_draw_form('id', 'block', $aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id . '&action=deleteconfirm', 'post', false));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $bInfo->block_name . '</b>');

      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_DELETE) . ' <a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    default:
      if (isset($bInfo) && is_object($bInfo)) {
          $heading[] = array('text' => '<b>' . $bInfo->block_name . '</b>');

          $contents[] = array('align' => 'center', 'text' => '<a href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id . '&action=edit') . '">' . oos_button(BUTTON_EDIT) . '</a> <a href="' . oos_href_link_admin($aContents['content_block'], 'page=' . $nPage . '&bID=' . $bInfo->block_id . '&action=delete') . '">' . oos_button(BUTTON_DELETE) . '</a>');
          $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . oos_date_short($bInfo->date_added));
          if (oos_is_not_null($bInfo->last_modified)) {
              $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . oos_date_short($bInfo->last_modified));
          }
          $contents[] = array('align' => 'center', 'text' => '<br><table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td class="infoBoxContent" valign="top"><b>' . TEXT_BLOCK_FUNCTION . ':</b></td><td class="infoBoxContent">' . $bInfo->block_file . '</td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td class="infoBoxContent" valign="top"><b>' . TEXT_BLOCK_CACHE . ':</b></td><td class="infoBoxContent">' . $bInfo->block_cache . '</td></tr><tr><td colspan="2">&nbsp;</td></tr><tr><td class="infoBoxContent" valign="top"><b>' . TEXT_BLOCK_PAGE . ':</b></td><td class="infoBoxContent">' . oos_info_block_to_page($bInfo->block_id) . '</td></tr></table>');
      }
      break;
  }

    if ((oos_is_not_null($heading)) && (oos_is_not_null($contents))) {
        ?>
	<td class="w-25">
		<table class="table table-striped">
<?php
        $box = new box();
        echo $box->infoBox($heading, $contents); ?>
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