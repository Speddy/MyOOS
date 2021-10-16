<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: wishlist_help.php,v 1  2002/11/09 wib 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

// cookie-notice 
if ( $bNecessary === false ) {
	oos_redirect(oos_href_link($aContents['home']));
}

// start the session
if ( $session->hasStarted() === false ) $session->start();
  
if (!isset($_SESSION['customer_id'])) {
  	// navigation history
	if (!isset($_SESSION['navigation'])) {
		$_SESSION['navigation'] = new navigationHistory();
	}

	$_SESSION['info_message'] = $aLang['info_login_for_wichlist'];
	$_SESSION['guest_login'] = 'off';
	
    $_SESSION['navigation']->set_snapshot();
    oos_redirect(oos_href_link($aContents['login']));
}  

$nPage = (!isset($_GET['page']) || !is_numeric($_GET['page'])) ? 1 : intval($_GET['page']); 

// split-page-results
require_once MYOOS_INCLUDE_PATH . '/includes/classes/class_split_page_results.php';
require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/account_wishlist.php';

$customers_wishlisttable = $oostable['customers_wishlist'];
$wishlist_result_raw = "SELECT products_id, customers_wishlist_date_added
                          FROM $customers_wishlisttable
                          WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'
                            AND customers_wishlist_link_id = '" . oos_db_input($_SESSION['customer_wishlist_link_id']) . "' 
                       ORDER BY customers_wishlist_date_added";
$wishlist_split = new splitPageResults($wishlist_result_raw, MAX_DISPLAY_WISHLIST_PRODUCTS);
$wishlist_result = $dbconn->Execute($wishlist_split->sql_query);

$aWishlist = array();
while ($wishlist = $wishlist_result->fields) {
	$wl_products_id = oos_get_product_id($wishlist['products_id']);

	$productstable = $oostable['products'];
	$products_descriptiontable = $oostable['products_description'];
	$sql = "SELECT p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_replacement_product_id,
                   p.products_image, p.products_price, p.products_base_price, p.products_base_unit, p.products_product_quantity, 
				   p.products_quantity_order_min, p.products_quantity_order_max,
                   p.products_tax_class_id, p.products_units_id
            FROM $productstable p,
                 $products_descriptiontable pd
            WHERE p.products_id = '" . intval($wl_products_id) . "'
              AND pd.products_id = p.products_id
              AND pd.products_languages_id = '" .  intval($nLanguageID) . "'";
	$wishlist_product = $dbconn->GetRow($sql);

    $wishlist_product_price = NULL;
    $wishlist_product_special_price = NULL;
    $wishlist_base_product_price = NULL;
    $wishlist_special_price = NULL;

	$base_product_price = $wishlist_product['products_price'];
	$wishlist_product_price = $oCurrencies->display_price($wishlist_product['products_price'], oos_get_tax_rate($wishlist_product['products_tax_class_id']));

	if ($wishlist_special_price = oos_get_products_special_price($wl_products_id)) {
		$base_product_price = $wishlist_special_price;
		$wishlist_product_special_price = $oCurrencies->display_price($wishlist_special_price, oos_get_tax_rate($wishlist_product['products_tax_class_id']));
    } 

	if ($wishlist_product['products_base_price'] != 1) {
		$wishlist_base_product_price = $oCurrencies->display_price($base_product_price * $wishlist_product['products_base_price'], oos_get_tax_rate($wishlist_product['products_tax_class_id']));
	}

    $customers_wishlist_attributestable = $oostable['customers_wishlist_attributes'];
    $sql = "SELECT products_options_id, products_options_value_id
            FROM $customers_wishlist_attributestable
            WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'
              AND customers_wishlist_link_id = '" . oos_db_input($_SESSION['customer_wishlist_link_id']) . "'
              AND products_id = '" . oos_db_input($wishlist['products_id']) . "'";
    $attributes_result = $dbconn->Execute($sql);
    $attributes_print = '';
	$attributes_hidden_field = '';
	while ($attributes = $attributes_result->fields) {
		$attributes_hidden_field .=  oos_draw_hidden_field('id[' . $attributes['products_options_id'] . ']', $attributes['products_options_value_id']);
		$attributes_print .=  '<ul class="list-unstyled mb-0">';

		$products_optionstable = $oostable['products_options'];
		$products_options_valuestable = $oostable['products_options_values'];
		$products_attributestable = $oostable['products_attributes'];
		$sql = "SELECT popt.products_options_name,
                     poval.products_options_values_name,
                     pa.options_values_price, pa.price_prefix
              FROM $products_optionstable popt,
                   $products_options_valuestable poval,
                   $products_attributestable pa
             WHERE pa.products_id = '" . intval($wl_products_id) . "'
               AND pa.options_id = '" . oos_db_input($attributes['products_options_id']) . "'
               AND pa.options_id = popt.products_options_id 
               AND pa.options_values_id = '" . oos_db_input($attributes['products_options_value_id']) . "'
               AND pa.options_values_id = poval.products_options_values_id
               AND popt.products_options_languages_id = '" .  intval($nLanguageID) . "'
               AND poval.products_options_values_languages_id = '" .  intval($nLanguageID) . "'";
		$option_values = $dbconn->GetRow($sql);

		$attributes_print .=  '<li> - ' . $option_values['products_options_name'] . ' ' . $option_values['products_options_values_name'] . ' ';

		if ($option_values['options_values_price'] != 0) {
			$attributes_print .=  $option_values['price_prefix'] . $oCurrencies->display_price($option_values['options_values_price'], oos_get_tax_rate($wishlist_product['products_tax_class_id'])) . '</li>';
		} else {
			$attributes_print .=  '</li>';
		}
		$attributes_print .=  '</ul>';

		$attributes_result->MoveNext();
	}
	
	$order_min = number_format($wishlist_product['products_quantity_order_min']);
	$order_max = number_format($wishlist_product['products_quantity_order_max']);

    // with option $wishlist['products_id'] = 2{3}1
    $aWishlist[] = array('products_id' => $wishlist['products_id'],
                         'wl_products_id' => $wl_products_id,
                         'products_image' => $wishlist_product['products_image'],
                         'products_name' => $wishlist_product['products_name'],
                         'order_min' => $order_min,
                         'order_max' => $order_max,
						'product_quantity' => $wishlist_product['products_product_quantity'],
						'product_units' => $wishlist_product['products_units_id'],						
                         'product_price' => $wishlist_product_price,
                         'product_special_price' => $wishlist_product_special_price,
                         'base_product_price' => $wishlist_base_product_price,
                         'products_base_price' => $wishlist_product['products_base_price'],
                         'products_base_unit' => $wishlist_product['products_base_unit'],
                         'attributes_print' => $attributes_print,
						 'attributes_hidden' => $attributes_hidden_field);
    $wishlist_result->MoveNext();
}

// links breadcrumb
$oBreadcrumb->add($aLang['navbar_title'], oos_href_link($aContents['account_wishlist']));
$sCanonical = oos_href_link($aContents['specials'], 'page='. $nPage, false, true);
  
$aTemplate['page'] = $sTheme . '/page/account_wishlist.html';
$aTemplate['pagination'] = $sTheme . '/system/_pagination.html';

$nPageType = OOS_PAGE_TYPE_CATALOG;
$sPagetitle = $aLang['heading_title'] . ' ' . OOS_META_TITLE;

require_once MYOOS_INCLUDE_PATH . '/includes/system.php';
if (!isset($option)) {
	require_once MYOOS_INCLUDE_PATH . '/includes/message.php';
	require_once MYOOS_INCLUDE_PATH . '/includes/blocks.php';
}

// assign Smarty variables;
$smarty->assign(
	array(
		'breadcrumb'		=> $oBreadcrumb->trail(),
		'heading_title' 	=> $aLang['heading_title'],
		'robots'			=> 'noindex,nofollow,noodp,noydir',
		'canonical'			=> $sCanonical,

		'account_active'	=> 1,
		'page_split'		=> $wishlist_split->display_count($aLang['text_display_number_of_wishlist']),
		'display_links' 	=> $wishlist_split->display_links(MAX_DISPLAY_PAGE_LINKS, oos_get_all_get_parameters(array('page', 'info'))),
		'numrows' 			=> $wishlist_split->number_of_rows,
		'numpages' 			=> $wishlist_split->number_of_pages,

		'page'				=> $nPage,
		'wishlist'		 	=> $aWishlist,
		'attributes_hidden'	=> $attributes_hidden_field,
		'attributes_print'	=> $attributes_print
	)
);

$smarty->assign('pagination', $smarty->fetch($aTemplate['pagination']));

// display the template
$smarty->display($aTemplate['page']);
