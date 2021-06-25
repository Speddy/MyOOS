<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: new_products.php,v 1.33 2003/02/12 23:55:58 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

if (!$oEvent->installed_plugin('spezials')) return false;
if (!is_numeric(MAX_DISPLAY_NEW_SPEZILAS)) return false;

$productstable = $oostable['products'];
$products_descriptiontable = $oostable['products_description'];
$specialstable = $oostable['specials'];
$sql = "SELECT p.products_id, pd.products_name, pd.products_short_description, p.products_price, p.products_tax_class_id, 
				p.products_units_id, p.products_quantity_order_min, p.products_quantity_order_max,
				p.products_product_quantity, p.products_image, p.products_base_price, p.products_base_unit, s.specials_new_products_price 
          FROM $productstable p,
               $products_descriptiontable pd,
               $specialstable s
          WHERE p.products_setting = '2'
            AND s.products_id = p.products_id
            AND p.products_id = pd.products_id
            AND pd.products_languages_id = '" . intval($nLanguageID) . "'
            AND s.status = '1'
          ORDER BY s.specials_date_added DESC";
$new_spezials_result = $dbconn->SelectLimit($sql, MAX_DISPLAY_NEW_SPEZILAS);
if ($new_spezials_result->RecordCount() >= MIN_DISPLAY_NEW_SPEZILAS) {
    $aSpezials = array();
    while ($new_spezials = $new_spezials_result->fields) {

		$new_spezials_base_product_price = null;
		$new_spezials_base_product_special_price = null;

		if ($aUser['show_price'] == 1 ) {

			$new_spezials_product_price = $oCurrencies->display_price($new_spezials['products_price'], oos_get_tax_rate($new_spezials['products_tax_class_id']));
			$new_spezials_product_special_price = $oCurrencies->display_price($new_spezials['specials_new_products_price'], oos_get_tax_rate($new_spezials['products_tax_class_id']));

			if ($new_spezials['products_base_price'] != 1) {
				$new_spezials_base_product_price = $oCurrencies->display_price($new_spezials['products_price'] * $new_spezials['products_base_price'], oos_get_tax_rate($new_spezials['products_tax_class_id']));
				$new_spezials_base_product_special_price = $oCurrencies->display_price($new_spezials['specials_new_products_price'] * $new_spezials['products_base_price'], oos_get_tax_rate($new_spezials['products_tax_class_id']));
			}
		}

		$order_min = number_format($new_spezials['products_quantity_order_min']);
		$order_max = number_format($new_spezials['products_quantity_order_max']);

		$aCategoryPath = array();
		$aCategoryPath = oos_get_category_path($new_products['products_id']);
		
		$aSpezials[] = array('products_id' => $new_spezials['products_id'],
                                    'products_image' => $new_spezials['products_image'],
                                    'products_name' => $new_spezials['products_name'],
                                    'products_short_description' => $new_spezials['products_short_description'],
									'products_path' => $aCategoryPath['path'],
									'categories_name' => $aCategoryPath['name'],										
                                    'order_min' => $order_min,
                                    'order_max' => $order_max,
                                    'product_quantity' => $new_spezials['products_product_quantity'],
                                    'products_base_unit' => $new_spezials['products_base_unit'],
                                    'products_base_price' => $new_spezials['products_base_price'],
                                    'products_units' => $new_spezials['products_units_id'],
                                    'products_price' => $new_spezials_product_price,
                                    'products_special_price' => $new_spezials_product_special_price,
                                    'base_product_price' => $new_spezials_base_product_price,
                                    'base_product_special_price' => $new_spezials_base_product_special_price);

		// Move that ADOdb pointer!
		$new_spezials_result->MoveNext();
    }

    $smarty->assign('spezials', $aSpezials);
}

