<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: shopping_cart.php,v 1.71 2003/02/14 05:51:28 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/shopping_cart.php';

$cart_count_contents = 0;
$basedir = OOS_IMAGES . 'product/min/';

$aData = array();
$aData['content'] = '';


if (isset($_SESSION)) { 
 
 
if ( isset($_SESSION['formid']) && ($_SESSION['formid'] == $_POST['formid']) ) { 
 
 
	if (is_object($_SESSION['cart'])) {
		
		if (isset($_POST['id']) || is_string($_POST['id'])) {
			$_SESSION['cart']->remove($_POST['id']);
		}		
			
		$cart_count_contents = $_SESSION['cart']->count_contents();
		if ($cart_count_contents > 0) {

			$products = $_SESSION['cart']->get_products();

			$n = count($products);
			for ($i=0, $n; $i<$n; $i++) {
				
				// Display marker if stock quantity insufficient
				if (STOCK_CHECK == 'true') {
					$stock_left = $products[$i]['stock'] - $products[$i]['quantity'];
					if ($stock_left < 0) {					
						$any_out_of_stock = 1;
					}
				}			

				// Push all attributes information in an array
				if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
					foreach($products[$i]['attributes'] as $option => $value) {
						$products_id = oos_get_product_id($products[$i]['id']);

						$products_optionstable = $oostable['products_options'];
						$products_options_valuestable = $oostable['products_options_values'];
						$products_attributestable = $oostable['products_attributes'];

						if ($value == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
							$sql = "SELECT popt.products_options_name,
										pa.options_values_price, pa.price_prefix
									FROM $products_optionstable popt,
										$products_attributestable pa
									WHERE pa.products_id = '" . intval($products_id) . "'
										AND pa.options_id = popt.products_options_id
										AND pa.options_id = '" . oos_db_input($option) . "'
										AND popt.products_options_languages_id = '" . intval($nLanguageID) . "'";
						} else {
							$sql = "SELECT popt.products_options_name,
										poval.products_options_values_name,
										pa.options_values_price, pa.price_prefix
									FROM $products_optionstable popt,
										$products_options_valuestable poval,
										$products_attributestable pa
									WHERE pa.products_id = '" . intval($products_id) . "'
										AND pa.options_id = '" . oos_db_input($option) . "'
										AND pa.options_id = popt.products_options_id
										AND pa.options_values_id = '" . oos_db_input($value) . "'
										AND pa.options_values_id = poval.products_options_values_id
										AND popt.products_options_languages_id = '" . intval($nLanguageID) . "'
										AND poval.products_options_values_languages_id = '" .  intval($nLanguageID) . "'";
						}
						$attributes_values = $dbconn->GetRow($sql);

						if ($value == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
							$attr_value = $products[$i]['attributes_values'][$option];
						} else {
							$attr_value = $attributes_values['products_options_values_name'];
						}

						$attr_price = $attributes_values['options_values_price'];

						$products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
						$products[$i][$option]['options_values_id'] = $value;
						$products[$i][$option]['products_options_values_name'] = $attr_value;
						$products[$i][$option]['options_values_price'] = $attr_price;
						$products[$i][$option]['price_prefix'] = $attributes_values['price_prefix']; 						
						
					}
				}
			}
			
			$aData['content'] .= '<div class="text-right"><button id="clear-cart" type="button" class="btn btn-link"><i class="fa fa-remove" aria-hidden="true"></i> ' . $aLang['text_clear_cart'] . '</button></div>' . "\n";		
			$aData['content'] .= '<div id="cart-item-refresh" class="widget widget-featured-entries pt-3">' . "\n";

			for ($i=0, $n=count($products); $i<$n; $i++) {
		  
				$aData['content'] .= '<div class="media"><!-- cart item -->' . "\n";
				$aData['content'] .= '  <div class="featured-entry-thumb mr-3"><a href="' . oos_href_link($aContents['product_info'], 'products_id=' . $products[$i]['id']) . '">' . "\n";
				$aData['content'] .= '    ' . oos_image($basedir . $products[$i]['image'], $products[$i]['name']) . "\n";
				$aData['content'] .= '     </a></div>' . "\n";
				$aData['content'] .= '   <div class="media-body">' . "\n";
				$aData['content'] .= '     <h6 class="featured-entry-title"><a href=" ' . oos_href_link($aContents['product_info'], 'products_id=' . $products[$i]['id']) . '">' . $products[$i]['name']  . '</a></h6>' . "\n";				
		
				// Product options names
				if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
					reset($products[$i]['attributes']);
					while (list($option, $value) = each($products[$i]['attributes'])) {
						$aData['content'] .= '<br /><small><i> - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'] . '</i></small>' . "\n";
					}
				}				

				// Product options prices
				if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
					reset($products[$i]['attributes']);
					foreach ($products[$i]['attributes'] as $option => $value) {	
						if ($products[$i][$option]['options_values_price'] != 0) {
							$aData['content'] .= '<br /><small><i>' . $products[$i][$option]['price_prefix'] . $oCurrencies->display_price($products[$i][$option]['options_values_price'], $products[$i]['tax'], $products[$i]['quantity']) . '</i></small>';
						} 
					}
				}

				$aData['content'] .='     <p class="featured-entry-meta">' . $products[$i]['quantity'] . '&nbsp; <span class="text-muted">x</span> ' . $oCurrencies->display_price($products[$i]['price'], oos_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</p>' . "\n";			
				$aData['content'] .='   </div>' . "\n";
				$aData['content'] .='   <div class="text-right"><span class="item-remove-btn" data-id="' . $products[$i]['id'] . '" role="button"> <i class="fa fa-trash" aria-hidden="true"></i></span></div>' . "\n";
				$aData['content'] .='</div>	<!-- /cart item -->' . "\n";															
			}

			$cart_show_total = $oCurrencies->format($_SESSION['cart']->show_total()); 


			$aData['content'] .='<hr>' . "\n";
			$aData['content'] .='<div class="d-flex justify-content-between align-items-center py-3">' . "\n";
			$aData['content'] .='<div class="font-size-sm"> <span class="mr-2">' . $aLang['sub_title_total'] . '</span><span class="font-weight-semibold text-dark">' . $cart_show_total . '</span></div><a class="btn btn-outline-secondary btn-sm" href="' . oos_href_link($aContents['shopping_cart']). '">' . $aLang['header_title_cart_contents'] . ' <i class="fa fa-chevron-right" aria-hidden="true"></i></a>' . "\n";
			$aData['content'] .='</div><a class="btn btn-primary btn-sm btn-block" href="' . oos_href_link($aContents['checkout_shipping']) . '"><i class="fa fa-credit-card" aria-hidden="true"></i> '. $aLang['button_checkout'] . '</a></div>' . "\n";		
			$aData['content'] .='</div>' . "\n";			
		}
	}
}
}

if ($cart_count_contents == 0) {

	$aData['content'] = '<div class="container text-center m-py-60">
					<div class="mb-5">
						<span class="d-block g-color-gray-light-v1 fs-70 mb-4">
							<i class="fa fa-shopping-basket" aria-hidden="true"></i>
						</span>
						<h2 class="mb-30">' . $aLang['text_cart_empty'] . '</h2>
						<p>' . $aLang['text_cart_empty_help'] . '</p>
					</div>
					<a class="btn btn-primary fs-12 text-uppercase m-py-12 m-px-25" href="' . oos_href_link($aContents['home']) . '" role="button">' . $aLang['button_start_shopping'] . '</a>
				</div>';
}


$aData['counter'] = $cart_count_contents;
echo json_encode($aData); 

