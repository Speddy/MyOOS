<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: specials.php,v 1.38 2002/05/16 15:32:22 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('OOS_VALID_MOD', 'yes');
require 'includes/main.php';


/**
 * Sets the status of a special
 *
 * @param $specials_id
 * @param $status
 */
function oos_set_specials_status($specials_id, $status)
{

    // Get database information
    $dbconn =& oosDBGetConn();
    $oostable =& oosDBGetTables();

    if ($status == '1') {
        $specialstable = $oostable['specials'];
        return $dbconn->Execute("UPDATE $specialstable SET status = '1', expires_date = NULL, date_status_change = NULL WHERE specials_id = '" . intval($specials_id) . "'");
    } elseif ($status == '0') {
        $specialstable = $oostable['specials'];
        return $dbconn->Execute("UPDATE $specialstable SET status = '0', date_status_change = now() WHERE specials_id = '" . intval($specials_id) . "'");
    } else {
        return false;
    }
}

require 'includes/classes/class_currencies.php';
$currencies = new currencies();

$nPage = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : intval($_GET['page']);
$action = (isset($_GET['action']) ? $_GET['action'] : '');
$sID = (isset($_GET['sID']) ? intval($_GET['sID']) : '');


if (!empty($action)) {
    switch ($action) {
        case 'setflag':
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                oos_set_specials_status($_GET['id'], $_GET['flag']);
            }

            oos_redirect_admin(oos_href_link_admin($aContents['specials'], 'sID=' . intval($_GET['id']) . '&page=' . intval($nPage)));
            break;

      case 'insert':
        if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
            $products_id = oos_db_prepare_input($_POST['products_id']);
            $products_price = oos_db_prepare_input($_POST['products_price']);
            $specials_price = oos_db_prepare_input($_POST['specials_price']);
            $expires_date = oos_db_prepare_input($_POST['expires_date']);

            // insert a product on special
            if (substr($_POST['specials_price'], -1) == '%') {
                $productstable = $oostable['products'];
                $new_special_insert_result = $dbconn->Execute("SELECT products_id, products_price FROM $productstable WHERE products_id = '" . intval($products_id) . "'");
                $new_special_insert = $new_special_insert_result->fields;

                $products_price = $new_special_insert['products_price'];
                $specials_price = ($products_price - (($specials_price / 100) * $products_price));
            }

            $dbconn->Execute("INSERT INTO " . $oostable['specials'] . " (products_id, specials_new_products_price, specials_date_added, expires_date, status) VALUES ('" . intval($products_id) . "', '" . oos_db_input($specials_price) . "', now(), '" . oos_db_input($expires_date) . "', '1')");
			// product price history
			$sql_price_array = array('products_id' => intval($products_id),
									'products_price' => oos_db_input($specials_price),
                                    'date_added' => 'now()');
            oos_db_perform($oostable['products_price_history'], $sql_price_array);
        }
        oos_redirect_admin(oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage)));
        break;

      case 'update':
        $specials_id = oos_db_prepare_input($_POST['specials_id']);
        $products_price = oos_db_prepare_input($_POST['products_price']);
        $specials_price = oos_db_prepare_input($_POST['specials_price']);
        $expires_date = oos_db_prepare_input($_POST['expires_date']);

        if (substr($specials_price, -1) == '%') {
            $specials_price = ($products_price - (($specials_price / 100) * $products_price));
        }

        $dbconn->Execute("UPDATE " . $oostable['specials'] . " SET specials_new_products_price = '" . oos_db_input($specials_price) . "', specials_last_modified = now(), expires_date = '" . oos_db_input($expires_date) . "' WHERE specials_id = '" .intval($specials_id) . "'");
         
		$specialstable = $oostable['specials'];
        $query = "SELECT products_id FROM $specialstable WHERE specials_id = '" . intval($specials_id) . "'";
        $products_id = $dbconn->GetOne($query);

		// product price history
		$sql_price_array = array('products_id' => intval($products_id),
								'products_price' => oos_db_input($specials_price),
								'date_added' => 'now()');
		oos_db_perform($oostable['products_price_history'], $sql_price_array);


        oos_redirect_admin(oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . intval($specials_id)));
        break;

      case 'deleteconfirm':
        $specials_id = oos_db_prepare_input($_GET['sID']);

        $specialstable = $oostable['specials'];
        $dbconn->Execute("DELETE FROM $specialstable WHERE specials_id = '" . oos_db_input($specials_id) . "'");

        oos_redirect_admin(oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage)));
        break;
    }
}
  require 'includes/header.php';

?>
<!-- body //-->
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
<?php

if (($action == 'new') || ($action == 'edit')) {
    $form_action = 'insert';
    if (($action == 'edit') && isset($_GET['sID'])) {
        $form_action = 'update';

        $productstable = $oostable['products'];
        $products_descriptiontable = $oostable['products_description'];
        $specialstable = $oostable['specials'];
        $sql = "SELECT p.products_tax_class_id, p.products_id, p.products_image, pd.products_name,
					p.products_price, s.specials_new_products_price, s.expires_date
              FROM $productstable p,
                   $products_descriptiontable pd,
                   $specialstable s
              WHERE p.products_id = pd.products_id AND
                  pd.products_languages_id = '" . intval($_SESSION['language_id']) . "' AND
                  p.products_id = s.products_id AND
                  s.specials_id = '" . intval($sID) . "'";
        $product = $dbconn->GetRow($sql);

        $sInfo = new objectInfo($product);
    } elseif (($action == 'new') && isset($_GET['pID'])) {
        $productstable = $oostable['products'];
        $products_descriptiontable = $oostable['products_description'];
        $sql = "SELECT p.products_tax_class_id, p.products_id, p.products_image, pd.products_name, p.products_price
              FROM $productstable p,
                   $products_descriptiontable pd
              WHERE p.products_id = pd.products_id AND
                    pd.products_languages_id = '" . intval($_SESSION['language_id']) . "' AND
                    p.products_id = '" . intval($_GET['pID']) . "'";
        $product = $dbconn->GetRow($sql);

        $sInfo = new objectInfo($product);
    } else {
        $sInfo = new objectInfo(array());

        $specials_array = [];
        $productstable = $oostable['products'];
        $specialstable = $oostable['specials'];
        $specials_result = $dbconn->Execute("SELECT p.products_id FROM $productstable p, $specialstable s WHERE s.products_id = p.products_id");
        while ($specials = $specials_result->fields) {
            $specials_array[] = $specials['products_id'];

            // Move that ADOdb pointer!
            $specials_result->MoveNext();
        }
    } ?>
<!-- body_text //-->
	<div class="card card-default">
		<div class="card-header"><?php echo HEADING_TITLE; ?></div>
			<div class="card-body">

				<form name="new_special" <?php echo 'action="' . oos_href_link_admin($aContents['specials'], oos_get_all_get_params(array('action', 'info', 'sID')) . 'action=' . $form_action) . '"'; ?> method="post">
					<?php if ($form_action == 'update') {
        echo oos_draw_hidden_field('specials_id', intval($sID));
    } ?>

<?php
    if (isset($_GET['pID'])) {
        echo '<input type="hidden" name="products_id" value="' . $sInfo->products_id . '">';
    } else {
        // echo '<input type="hidden" name="products_up_id" value="' . $sInfo->products_id . '">';
    }

    $in_new_price_netto = '';
    if (!empty($sInfo->products_name)) {
        echo '<br><a href="' . oos_catalog_link($aCatalog['product_info'], 'products_id=' . $sInfo->products_id) . '" target="_blank" rel="noopener">' . product_info_image($sInfo->products_image, $sInfo->products_name) . '</a><br>';

        $tax_result = $dbconn->Execute("SELECT tax_rate FROM " . $oostable['tax_rates'] . " WHERE tax_class_id = '" . intval($sInfo->products_tax_class_id) . "' ");
        $tax = $tax_result->fields;

        $in_price_netto = $sInfo->products_price;
        $in_new_price_netto = $sInfo->specials_new_products_price;

        $in_price = ($in_price_netto*($tax['tax_rate']+100)/100);
        $in_new_price = ($in_new_price_netto*($tax['tax_rate']+100)/100);

        $in_price_netto = round($in_price_netto, TAX_DECIMAL_PLACES);
        $in_new_price_netto = round($in_new_price_netto, TAX_DECIMAL_PLACES);

        $in_price = round($in_price, TAX_DECIMAL_PLACES);
        $in_new_price = round($in_new_price, TAX_DECIMAL_PLACES);


        echo $sInfo->products_name;
        echo '<br>' . TEXT_INFO_ORIGINAL_PRICE . ' ' . $currencies->format($in_price) . ' - ' . TEXT_TAX_INFO . $currencies->format($in_price_netto);
        echo '<br>' . TEXT_INFO_NEW_PRICE . ' ' . $currencies->format($in_new_price) . ' - ' . TEXT_TAX_INFO . $currencies->format($in_new_price_netto);
        echo '<br>' . TEXT_INFO_PERCENTAGE . ' ' . number_format(100 - (($sInfo->specials_new_products_price / $sInfo->products_price) * 100)) . '%';
    } else {
        ?>
                     <fieldset>
                        <div class="form-group row mb-2 mt-3">
                           <label class="col-md-2 col-form-label mb-2"><?php echo TEXT_SPECIALS_PRODUCT; ?></label>
                           <div class="col-md-10">
								<?php echo oos_draw_products_pull_down('products_id', $specials_array);
        echo oos_draw_hidden_field('products_price', (isset($sInfo->products_price) ? $sInfo->products_price : '')); ?>
                           </div>
                        </div>
                     </fieldset>
<?php
    } ?>
                     <fieldset>
                        <div class="form-group row mb-2">
                           <label class="col-md-2 col-form-label" for="input-id-1"><?php echo TEXT_SPECIALS_SPECIAL_PRICE; ?></label>
                           <div class="col-md-10">
                              <?php echo oos_draw_input_field('specials_price', $in_new_price_netto); ?> 
                           </div>
                        </div>
                     </fieldset>
                     <fieldset>
                        <div class="form-group row mb-2">
                           <label class="col-md-2 col-form-label mb-2"><?php echo TEXT_SPECIALS_EXPIRES_DATE; ?></label>
                           <div class="col-xl-6 col-10">
                              <div class="input-group date" id="datetimepicker1">
                                 <input class="form-control" type="text" name="expires_date" value="<?php echo(isset($sInfo->expires_date) ? $sInfo->expires_date : ''); ?>">
                                 <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </fieldset>

		<div class="text-md-left mt-3">
			<p><?php echo TEXT_SPECIALS_PRICE_TIP; ?></p>
		</div>
	
		<div class="text-right mt-3">
			<?php echo '<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . intval($sID)) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>'; ?>
			<?php echo(($form_action == 'insert') ? oos_submit_button(BUTTON_INSERT) : oos_submit_button(BUTTON_UPDATE)); ?>
		</div>
					
			</form>	
		</div>
	</div>
	  
<?php
} else {
        ?>
	<div class="table-responsive">
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">	
			
				<table class="table table-striped table-hover w-100">
					<thead class="thead-dark">
						<tr>
							<th><?php echo TABLE_HEADING_PRODUCTS; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_PRODUCTS_PRICE; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_STATUS; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
						</tr>	
					</thead>
<?php
    $productstable = $oostable['products'];
        $products_descriptiontable = $oostable['products_description'];
        $specialstable = $oostable['specials'];
        $specials_sql_raw = "SELECT p.products_tax_class_id, p.products_id, pd.products_name, p.products_price,
                               s.specials_id, s.specials_new_products_price, s.specials_date_added,
                               s.specials_last_modified, s.expires_date, s.date_status_change, s.status
                           FROM $productstable p,
                                $specialstable s,
                                $products_descriptiontable pd
                           WHERE p.products_id = pd.products_id AND
                                 pd.products_languages_id = '" . intval($_SESSION['language_id']) . "' AND
                                 p.products_id = s.products_id
                           ORDER BY pd.products_name";
        $specials_split = new splitPageResults($nPage, MAX_DISPLAY_SEARCH_RESULTS, $specials_sql_raw, $specials_numrows);
        $specials_result = $dbconn->Execute($specials_sql_raw);
        while ($specials = $specials_result->fields) {
            if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $specials['specials_id']))) && !isset($sInfo)) {
                $productstable = $oostable['products'];
                $products_result = $dbconn->Execute("SELECT products_image FROM $productstable WHERE products_id = '" . $specials['products_id'] . "'");
                $products = $products_result->fields;
                $sInfo_array = array_merge($specials, $products);
                $sInfo = new objectInfo($sInfo_array);
            }

            if (isset($sInfo) && is_object($sInfo) && ($specials['specials_id'] == $sInfo->specials_id)) {
                echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $sInfo->specials_id . '&action=edit') . '\'">' . "\n";
            } else {
                echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $specials['specials_id']) . '\'">' . "\n";
            }

            # $in_price = $sInfo->products_price;
            # $in_new_price = $sInfo->specials_new_products_price;?>
                <td><?php echo $specials['products_name']; ?></td>
                <td  align="right"><s><?php echo $currencies->format($specials['products_price']); ?></s> <span><?php echo $currencies->format($specials['specials_new_products_price']); ?></span></td>
                <td  align="right">
<?php
        if ($specials['status'] == '1') {
            echo '<i class="fa fa-circle text-success" title="' . IMAGE_ICON_STATUS_GREEN . '"></i>&nbsp;<a href="' . oos_href_link_admin($aContents['specials'], 'action=setflag&flag=0&id=' . $specials['specials_id']) . '"><i class="fa fa-circle-notch text-danger" title="' . IMAGE_ICON_STATUS_RED_LIGHT . '"></i></a>';
        } else {
            echo '<a href="' . oos_href_link_admin($aContents['specials'], 'action=setflag&flag=1&id=' . $specials['specials_id']) . '"><i class="fa fa-circle-notch text-success" title="' . IMAGE_ICON_STATUS_GREEN_LIGHT . '"></i></a>&nbsp;<i class="fa fa-circle text-danger" title="' . IMAGE_ICON_STATUS_RED . '"></i>';
        } ?></td>
                <td class="text-right"><?php if (isset($sInfo) && is_object($sInfo) && ($specials['specials_id'] == $sInfo->specials_id)) {
            echo '<button class="btn btn-info" type="button"><i class="fa fa-eye-slash" title="' . IMAGE_ICON_INFO . '" aria-hidden="true"></i></i></button>';
        } else {
            echo '<a href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $specials['specials_id']) . '"><button class="btn btn-default" type="button"><i class="fa fa-eye-slash"></i></button></a>';
        } ?>&nbsp;</td>
      </tr>
<?php
      // Move that ADOdb pointer!
      $specials_result->MoveNext();
        } ?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $specials_split->display_count($specials_numrows, MAX_DISPLAY_SEARCH_RESULTS, intval($nPage), TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
                    <td class="smallText" align="right"><?php echo $specials_split->display_links($specials_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, intval($nPage)); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr> 
                    <td colspan="2" align="right"><?php echo '<a href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&action=new') . '">' . oos_button(IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
                  </tr>
<?php
  } ?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = [];
        $contents = [];
        switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>');

      $contents = array('form' => oos_draw_form('id', 'specials', $aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $sInfo->specials_id . '&action=deleteconfirm', 'post', false));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $sInfo->products_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . oos_submit_button(BUTTON_DELETE) . '&nbsp;<a class="btn btn-sm btn-warning mb-20" href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $sInfo->specials_id) . '" role="button"><strong>' . BUTTON_CANCEL . '</strong></a>');

      break;

    default:
      if (isset($sInfo) && is_object($sInfo)) {
          $heading[] = array('text' => '<b>' . $sInfo->products_name . '</b>');

          $contents[] = array('align' => 'center', 'text' => '<a href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $sInfo->specials_id . '&action=edit') . '">' . oos_button(BUTTON_EDIT) . '</a> <a href="' . oos_href_link_admin($aContents['specials'], 'page=' . intval($nPage) . '&sID=' . $sInfo->specials_id . '&action=delete') . '">' . oos_button(BUTTON_DELETE) . '</a>');
          $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . oos_date_short($sInfo->specials_date_added));
          $contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . oos_date_short($sInfo->specials_last_modified));
          $contents[] = array('align' => 'center', 'text' => '<br>' . product_info_image($sInfo->products_image, $sInfo->products_name));


          $tax_result = $dbconn->Execute("SELECT tax_rate FROM " . $oostable['tax_rates'] . " WHERE tax_class_id = '" . $sInfo->products_tax_class_id . "' ");
          $tax = $tax_result->fields;

          $in_price_netto = $sInfo->products_price;
          $in_new_price_netto = $sInfo->specials_new_products_price;

          $in_price = ($in_price_netto*($tax['tax_rate']+100)/100);
          $in_new_price = ($in_new_price_netto*($tax['tax_rate']+100)/100);

          $in_price_netto = round($in_price_netto, TAX_DECIMAL_PLACES);
          $in_new_price_netto = round($in_new_price_netto, TAX_DECIMAL_PLACES);

          $in_price = round($in_price, TAX_DECIMAL_PLACES);
          $in_new_price = round($in_new_price, TAX_DECIMAL_PLACES);

          $contents[] = array('text' => '<br>' . TEXT_INFO_ORIGINAL_PRICE . ' ' . $currencies->format($in_price) . ' - ' . TEXT_TAX_INFO . $currencies->format($in_price_netto));
          $contents[] = array('text' => '' . TEXT_INFO_NEW_PRICE . ' ' . $currencies->format($in_new_price) . ' - ' . TEXT_TAX_INFO . $currencies->format($in_new_price_netto) );
          $contents[] = array('text' => '' . TEXT_INFO_PERCENTAGE . ' ' . number_format(100 - (($sInfo->specials_new_products_price / $sInfo->products_price) * 100)) . '%');

          if (date('Y-m-d') < $sInfo->expires_date) {
              $contents[] = array('text' => '<br>' . TEXT_INFO_EXPIRES_DATE . ' <b>' . oos_date_short($sInfo->expires_date) . '</b>');
          }
          if (oos_is_not_null($sInfo->date_status_change)) {
              $contents[] = array('text' => '' . TEXT_INFO_STATUS_CHANGE . ' ' . oos_date_short($sInfo->date_status_change));
          }
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
        } ?>
          </tr>
        </table>
	</div>
<?php
    }
?>
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
