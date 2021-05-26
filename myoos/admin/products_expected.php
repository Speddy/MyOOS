<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: products_expected.php,v 1.29 2002/03/17 17:52:23 harley_vb 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('OOS_VALID_MOD', 'yes');
require 'includes/main.php';
require 'includes/functions/function_products.php';

$nPage = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : intval($_GET['page']); 

  $productstable = $oostable['products'];
  $dbconn->Execute("UPDATE $productstable SET products_date_available = '' WHERE to_days(now()) > to_days(products_date_available)");

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
							<th></th>
							<th><?php echo TABLE_HEADING_PRODUCTS; ?></th>
							<th class="text-center"><?php echo TABLE_HEADING_DATE_EXPECTED; ?></th>
							<th class="text-right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</th>
						</tr>	
					</thead>
<?php
  $productstable = $oostable['products'];
  $products_descriptiontable = $oostable['products_description'];
  $products_result_raw = "SELECT pd.products_id, pd.products_name, p.products_date_available
                         FROM $products_descriptiontable pd,
                              $productstable p
                         WHERE p.products_id = pd.products_id AND
                               p.products_date_available != '' AND
                               pd.products_languages_id = '" . intval($_SESSION['language_id']) . "'
                         ORDER BY p.products_date_available DESC";
  $products_split = new splitPageResults($nPage, MAX_DISPLAY_SEARCH_RESULTS, $products_result_raw, $products_result_numrows);
  $products_result = $dbconn->Execute($products_result_raw);
  while ($products = $products_result->fields) {
    if ((!isset($_GET['pID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo)) {
      $pInfo = new objectInfo($products);
    }

    if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id) ) {
      echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['categories'], 'pID=' . $products['products_id'] . '&action=new_product') . '\'">' . "\n";
    } else {
      echo '                  <tr onclick="document.location.href=\'' . oos_href_link_admin($aContents['products_expected'], 'page=' . $nPage . '&pID=' . $products['products_id']) . '\'">' . "\n";
    }
?>
                <td><?php echo '<a href="' . oos_catalog_link($aCatalog['product_info'], 'products_id=' . $products['products_id']) . '" target="_blank" rel="noopener"><button class="btn btn-white btn-sm" type="button"><i class="fa fa-search"></i></button></a>&nbsp;' . '#' . $products['products_id'] . ' ' . $products['products_name']; ?></td>
                <td><?php echo $products['products_name']; ?></td>
                <td class="text-center"><?php echo oos_date_short($products['products_date_available']); ?></td>
                <td class="text-right"><?php echo
							'<a href="' . oos_href_link_admin($aContents['products'], 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product') . '"><i class="fas fa-pencil-alt" title="' .  BUTTON_EDIT . '"></i></a>';
			?>				
				
              </tr>
<?php
    // Move that ADOdb pointer!
    $products_result->MoveNext();
  }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $products_split->display_count($products_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, $nPage, TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED); ?></td>
                    <td class="smallText" align="right"><?php echo $products_split->display_links($products_result_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $nPage); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>

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