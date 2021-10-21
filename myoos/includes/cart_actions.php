<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: application_top.php,v 1.264 2003/02/17 16:37:52 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

if (isset($_GET['action'])) {
    $action = oos_var_prep_for_os($_GET['action']);
} elseif (isset($_POST['action'])) {
    $action = oos_var_prep_for_os($_POST['action']);
}



if (DISPLAY_CART == 'true') {
    $goto_file = $aContents['shopping_cart'];
    $parameters = array('action', 'category', 'products_id', 'pid');
} else {
    $goto_file = $sContent;
    if ($action == 'buy_now') {
		$parameters = array('action', 'pid', 'products_id', 'cart_quantity');
    } elseif ($action == 'buy_slave')  {
		$parameters = array('action', 'pid', 'slave_id', 'cart_quantity');
    } else {
		$parameters = array('action', 'pid', 'cart_quantity');
    }
}


switch ($action) {
	case 'update_product' :
		// start the session
		if ( $session->hasStarted() === false ) $session->start();

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}
		
		// customer wants to update the product quantity in their shopping cart
		for ($i=0; $i<count($_POST['products_id']);$i++) {
			if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array())) or $_POST['cart_quantity'][$i] == 0) {
				$_SESSION['cart']->remove($_POST['products_id'][$i]);
			} else {

				$products_order_min = oos_get_products_quantity_order_min($_POST['products_id'][$i]);
				$products_order_units = oos_get_products_quantity_order_units($_POST['products_id'][$i]);

				if ( ($_POST['cart_quantity'][$i] >= $products_order_min) ) {
					if ($_POST['cart_quantity'][$i]%$products_order_units == 0) {
						$attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
						$_SESSION['cart']->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false, $_POST['to_wl_id'][$i]);
					} else {
						$oMessage->add_session('danger', oos_get_products_name($_POST['products_id'][$i]) . ' - ' . $aLang['error_products_units_invalid'] . ' ' . oos_prepare_input($_POST['cart_quantity'][$i]) . ' - ' . $aLang['products_order_qty_unit_text_cart'] . ' ' . $products_order_units);
					}
				} else {
					$oMessage->add_session('danger',  $aLang['error_products_quantity_order_min_text'] . ' ' . oos_get_products_name($_POST['products_id'][$i]) . ' - ' . $aLang['error_products_quantity_invalid'] . ' ' . oos_prepare_input($_POST['cart_quantity'][$i]) . ' - ' . $aLang['products_order_qty_min_text_cart'] . ' ' . $products_order_min);
				}
			}
		}

		# oos_redirect(oos_href_link($goto_file, oos_get_all_get_parameters($parameters)));
		# todo remove?
		oos_redirect(oos_href_link($aContents['shopping_cart']));
		break;

	case 'add_product' :	
		// start the session
		if ( $session->hasStarted() === false ) $session->start();
		
		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}
		
		// customer adds a product from the products page
		if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
			$real_ids = $_POST['id'];
			// File_upload 
			if (isset($_POST['number_of_uploads']) && is_numeric($_POST['number_of_uploads']) && ($_POST['number_of_uploads'] > 0)) {
				require_once 'includes/classes/class_upload.php';
				for ($i = 1; $i <= $_POST['number_of_uploads']; $i++) {
					if (oos_is_not_null($_FILES['id']['tmp_name'][TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]]) and ($_FILES['id']['tmp_name'][TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] != 'none')) {

					$products_options_file = new upload('id');
					$products_options_file->set_destination(OOS_UPLOADS);
					$files_uploadedtable = $oostable['files_uploaded'];

					if ($products_options_file->parse(TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i])) {
						if (isset($_SESSION['customer_id'])) {
							$dbconn->Execute("INSERT INTO " . $files_uploadedtable . " (sesskey, customers_id, files_uploaded_name) VALUES ('" . $session->getId() . "', '" . intval($_SESSION['customer_id']) . "', '" . oos_db_input($products_options_file->filename) . 		"')");
						} else {
							$dbconn->Execute("INSERT INTO " . $files_uploadedtable . " (sesskey, files_uploaded_name) VALUES ('" . $session->getId() . "', '" . oos_db_input($products_options_file->filename) . "')");
						}
						$insert_id = $dbconn->Insert_ID();
						$real_ids[TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] = $insert_id . ". " . $products_options_file->filename;
						$products_options_file->set_filename("$insert_id" . $products_options_file->filename);
						if (!($products_options_file->save())) {
							break 2;
						}
					} else {
							break 2;
						}
					} else { // No file uploaded -- use previous value
						$real_ids[TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] = $_POST[TEXT_PREFIX . UPLOAD_PREFIX . $i];
					}
				}
			}
 
			if (isset($_POST['add_wishlist']) && ($_POST['add_wishlist'] == 1 )) {
				if (!isset($_SESSION['customer_id'])) {
					$wishlist_products_id = oos_get_uprid($_POST['products_id'], $_POST['id']);

					$aPage = array();
					$aPage['modules'] = $sMp;
					$aPage['file'] = $sFile;
					$aPage['mode'] = $request_type;
					$aPage['get'] = 'products_id=' . rawurlencode($_POST['products_id']) . '&amp;action=add_wishlist';
					
					$_SESSION['wishlist'] = 'yes';

					$_SESSION['navigation']->set_snapshot($aPage);
					oos_redirect(oos_href_link($aModules['user'], $aFilename['login'], '', 'SSL'));
				} else {
					$wishlist_products_id = oos_get_uprid($_POST['products_id'], $_POST['id']);

					$customers_wishlisttable = $oostable['customers_wishlist'];
					$dbconn->Execute("DELETE FROM $customers_wishlisttable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($wishlist_products_id) . "'"); 

					$customers_wishlist_attributestable = $oostable['customers_wishlist_attributes'];
					$dbconn->Execute("DELETE FROM $customers_wishlist_attributestable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($wishlist_products_id) . "'"); 

					$customers_wishlisttable = $oostable['customers_wishlist'];
					$dbconn->Execute("INSERT INTO $customers_wishlisttable 
								(customers_id, customers_wishlist_link_id, products_id, 
								customers_wishlist_date_added) VALUES (" . $dbconn->qstr($_SESSION['customer_id']) . ','
																		. $dbconn->qstr($_SESSION['customer_wishlist_link_id']) . ','
																		. $dbconn->qstr($wishlist_products_id) . ','
																		. $dbconn->qstr(date('Ymd')) . ")");
					if (is_array($_POST['id'])) {
						reset($_POST['id']);
						foreach ($_POST['id'] as $option => $value) {

							$customers_wishlist_attributestable = $oostable['customers_wishlist_attributes'];
							$dbconn->Execute("INSERT INTO $customers_wishlist_attributestable
											(customers_id, customers_wishlist_link_id, products_id, products_options_id, 
											products_options_value_id) VALUES (" . $dbconn->qstr($_SESSION['customer_id']) . ','
																				. $dbconn->qstr($_SESSION['customer_wishlist_link_id']) . ','
																				. $dbconn->qstr($wishlist_products_id) . ','
																				. $dbconn->qstr($option) . ','
																				. $dbconn->qstr($value) . ")");
						}	
					}
					oos_redirect(oos_href_link($aContents['account_wishlist']));
				}
			} else {
				if (isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity'])) {
			  
					$cart_quantity = oos_prepare_input($_POST['cart_quantity']);			  
	
					$cart_qty = $_SESSION['cart']->get_quantity(oos_get_uprid($_POST['products_id'], $real_ids));
					$news_qty = $cart_qty + $cart_quantity;

					$products_order_min = oos_get_products_quantity_order_min($_POST['products_id']);
					$products_order_units = oos_get_products_quantity_order_units($_POST['products_id']);

					if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
						if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
							$_SESSION['cart']->add_cart($_POST['products_id'], $news_qty, $real_ids);
						} else {
							$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units);
						}
					} else {
						$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min);
					}

					if ($oMessage->size('danger') == 0) {
						oos_redirect(oos_href_link($goto_file, oos_get_all_post_parameters($parameters)));
					} else {
						oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['products_id']));
					}
				}
			}
		}
		break;

	case 'clear_cart' :
		// start the session
		if ( $session->hasStarted() === false ) $session->start();

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}
		
		if (isset($_SESSION['cart']) && ($_SESSION['cart']->count_contents() > 0)) {
			$products = $_SESSION['cart']->get_products();

			$n = count($products);
			for ($i=0, $n; $i<$n; $i++) {			
				$_SESSION['cart']->remove($products[$i]['id']);
			}
		}	
		break;


	case 'cart_delete' :
		// start the session
		if ( $session->hasStarted() === false ) $session->start();

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}	
		if (isset($_SESSION['cart']) && ($_SESSION['cart']->count_contents() > 0)) {	
			if (isset($_GET['products_id']) && is_string($_GET['products_id'])) {
				$_SESSION['cart']->remove(oos_var_prep_for_os($_GET['products_id']));
			}
		}
		oos_redirect(oos_href_link($aContents['shopping_cart']));
		break;

    case 'buy_now' :
		// start the session
		if ( $session->hasStarted() === false ) $session->start();	

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}

		if ( isset($_GET['products_id']) || isset($_POST['products_id']) )  {		
			$sProductsId  = oos_prepare_input($_GET['products_id']) ?? oos_prepare_input($_POST['products_id']);

			if (oos_has_product_attributes($sProductsId)) {
				$oMessage->add_session('danger', $aLang['error_product_has_attributes']);
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $sProductsId));
			} else {
			
				if (isset($_GET['cart_quantity']) && is_numeric($_GET['cart_quantity'])) {
					$cart_quantity = oos_prepare_input($_GET['cart_quantity']);
				} elseif (isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity'])) {
					$cart_quantity = oos_prepare_input($_POST['cart_quantity']);
				} else {
					$cart_quantity = 1;
				}
				
				$cart_qty = $_SESSION['cart']->get_quantity($sProductsId);
				$news_qty = $cart_qty + $cart_quantity;

				$products_order_min = oos_get_products_quantity_order_min($sProductsId);
				$products_order_units = oos_get_products_quantity_order_units($sProductsId);

				if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
					if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
						$_SESSION['cart']->add_cart($sProductsId, $news_qty);
					} else {
						$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units);
					}
				} else {
					$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min);
				}
			}
			if ($oMessage->size('danger') == 0) {
				oos_redirect(oos_href_link($goto_file, oos_get_all_get_parameters($parameters)));
			} else {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $sProductsId));
			}
		} 
		break;

    case 'buy_slave' :	
	
		// start the session
		if ( $session->hasStarted() === false ) $session->start();

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}
		
		if ( isset($_GET['slave_id']) || isset($_POST['slave_id']) )  {		
			$slave_id  = oos_prepare_input($_GET['slave_id']) ?? oos_prepare_input($_POST['slave_id']);
			
			if ( empty( $slave_id ) || !is_string( $slave_id ) ) {
				oos_redirect(oos_href_link($aContents['403']));
			}		
			
			if (oos_has_product_attributes($slave_id)) {
				$oMessage->add_session('danger', $aLang['error_product_has_attributes']);
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $slave_id));
			} else {
			
				$cart_quantity = isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity']) ? oos_prepare_input($_POST['cart_quantity']) : 1;
				$cart_qty = $_SESSION['cart']->get_quantity($slave_id);
				$news_qty = $cart_qty + $cart_quantity;

				$products_order_min = oos_get_products_quantity_order_min($slave_id);
				$products_order_units = oos_get_products_quantity_order_units($slave_id);

				if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
					if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
						$_SESSION['cart']->add_cart($slave_id, $news_qty);
					} else {
						$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units);
					}
				} else {
					$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min);
				}
			}

			if ($oMessage->size('danger') == 0) {
				oos_redirect(oos_href_link($goto_file, oos_get_all_post_parameters($parameters)));
			} else {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $slave_id));
			}
		}
		break;

    case 'notify' :
		if (isset($_SESSION['customer_id'])) {
			if (isset($_GET['products_id'])) {
				$notify = oos_var_prep_for_os($_GET['products_id']);
			} elseif (isset($_GET['notify'])) {
				$notify = oos_var_prep_for_os($_GET['notify']);
			} elseif (isset($_POST['notify'])) {
				$notify = oos_var_prep_for_os($_POST['notify']);
			} else {
				oos_redirect(oos_href_link($sContent, oos_get_all_get_parameters(array('action', 'notify'))));
			}

			if (!is_array($notify)) $notify = array($notify);
			
			$products_notificationstable = $oostable['products_notifications'];
			for ($i=0, $n=count($notify); $i<$n; $i++) {
				$check_sql = "SELECT COUNT(*) AS total 
                        FROM $products_notificationstable 
                        WHERE products_id = '" . intval($notify[$i]) . "'
                        AND customers_id = '" . intval($_SESSION['customer_id']) . "'";
				$check = $dbconn->Execute($check_sql);
				if ($check->fields['total'] < 1) {
					$today = date("Y-m-d H:i:s");
					$sql = "INSERT INTO $products_notificationstable
						(products_id, customers_id, 
						date_added) VALUES (" . $dbconn->qstr($notify[$i]) . ','
                                           . $dbconn->qstr($_SESSION['customer_id']) . ','
                                           . $dbconn->DBTimeStamp($today) . ")";
					$dbconn->Execute($sql);
				}
			}
			oos_redirect(oos_href_link($sContent, oos_get_all_get_parameters(array('action'))));
		} else {
			// navigation history
			if (!isset($_SESSION['navigation'])) {
				$_SESSION['navigation'] = new navigationHistory();
			}		  
			$_SESSION['navigation']->set_snapshot();
			oos_redirect(oos_href_link($aContents['login']));
		}
		break;

    case 'notify_remove' :
		// start the session
		if ( $session->hasStarted() === false ) $session->start();
		
		$products_notificationstable = $oostable['products_notifications'];
		if (isset($_SESSION['customer_id']) && isset($_GET['products_id'])) {
			if (!isset($nProductsID)) $nProductsID = oos_get_product_id($_GET['products_id']);
			
			$check_sql = "SELECT COUNT(*) AS total
                      FROM $products_notificationstable
                      WHERE products_id = '" . intval($nProductsID) . "'
                      AND customers_id = '" . intval($_SESSION['customer_id']) . "'";
			$check = $dbconn->Execute($check_sql);
			if ($check->fields['total'] > 0) {
				$dbconn->Execute("DELETE FROM $products_notificationstable WHERE products_id = '" . intval($nProductsID) . "' AND customers_id = '" . intval($_SESSION['customer_id']) . "'");
			}
			oos_redirect(oos_href_link($sContent, oos_get_all_get_parameters(array('action'))));
		} else {
			// navigation history
			if (!isset($_SESSION['navigation'])) {
				$_SESSION['navigation'] = new navigationHistory();
			} 
			$_SESSION['navigation']->set_snapshot();
			oos_redirect(oos_href_link($aContents['login']));
		}
		break;


	case 'remove_wishlist' :	
		if (isset($_SESSION['customer_id']) && isset($_GET['pid'])) {
			$customers_wishlisttable = $oostable['customers_wishlist'];
			$dbconn->Execute("DELETE FROM $customers_wishlisttable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($_GET['pid']) . "'");

			$customers_wishlist_attributestable = $oostable['customers_wishlist_attributes'];
			$dbconn->Execute("DELETE FROM $customers_wishlist_attributestable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($_GET['pid']) . "'");
		}
		break;

	case 'add_wishlist' :
		if (isset($_GET['products_id'])) {

			$sProductsId  = oos_prepare_input($_GET['products_id']);
			$wishlist_products_id = oos_get_product_id($sProductsId);
			$attributes = oos_get_attributes($sProductsId);

			// start the session
			if ( $session->hasStarted() === false ) $session->start();
			if (!isset($_SESSION['customer_id'])) {
				// navigation history
				if (!isset($_SESSION['navigation'])) {
					$_SESSION['navigation'] = new navigationHistory();
				}

				$_SESSION['info_message'] = $aLang['info_login_for_wichlist'];
				$_SESSION['guest_login'] = 'off';
				
				$aPage = array();
				$aPage['content'] = $sContent;
				$aPage['get'] = 'products_id=' . rawurlencode($wishlist_products_id) . '&amp;action=add_wishlist';

				$_SESSION['navigation']->set_snapshot($aPage);
				oos_redirect(oos_href_link($aContents['login']));
			}
						
			$customers_wishlisttable = $oostable['customers_wishlist'];
			$dbconn->Execute("DELETE FROM $customers_wishlisttable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($wishlist_products_id) . "'");

			$dbconn->Execute("INSERT INTO $customers_wishlisttable
							(customers_id, customers_wishlist_link_id, products_id,
							customers_wishlist_date_added) VALUES (" . $dbconn->qstr($_SESSION['customer_id']) . ','
                                                                    . $dbconn->qstr($_SESSION['customer_wishlist_link_id']) . ','
                                                                    . $dbconn->qstr($wishlist_products_id) . ','
                                                                    . $dbconn->qstr(date('Ymd')) . ")");
																	
			if (is_array($attributes)) {
				reset($attributes);
				foreach ($attributes as $option => $value) {

					$customers_wishlist_attributestable = $oostable['customers_wishlist_attributes'];
					$dbconn->Execute("INSERT INTO $customers_wishlist_attributestable
									(customers_id, customers_wishlist_link_id, products_id, products_options_id, 
									products_options_value_id) VALUES (" . $dbconn->qstr($_SESSION['customer_id']) . ','
																		. $dbconn->qstr($_SESSION['customer_wishlist_link_id']) . ','
																		. $dbconn->qstr($wishlist_products_id) . ','
																		. $dbconn->qstr($option) . ','
																		. $dbconn->qstr($value) . ")");
				}	
			}																	
			oos_redirect(oos_href_link($aContents['account_wishlist']));			
		}
		break;	  
	  
	  
    case 'wishlist_add_product' :
	
		// start the session
		if ( $session->hasStarted() === false ) $session->start();

		// create the shopping cart
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new shoppingCart();
		}

	
		if (isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity'])) {
			$cart_quantity = oos_prepare_input($_POST['cart_quantity']);
		} else {
			$cart_quantity = 1;
		}
		
		if (isset($_POST['products_id'])) {

			$sProductsId  = oos_prepare_input($_POST['products_id']);


			$cart_qty = $_SESSION['cart']->get_quantity(oos_get_uprid($sProductsId, $_POST['id']));
			$news_qty = $cart_qty + $cart_quantity;
	
			$products_order_min = oos_get_products_quantity_order_min($sProductsId);
			$products_order_units = oos_get_products_quantity_order_units($sProductsId);

			if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
				if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
					$_SESSION['cart']->add_cart($sProductsId, $news_qty, $_POST['id'], true, $_POST['wl_products_id']);   
				} else {
					$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units);
				}
			} else {
				$oMessage->add_session('danger', $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min);
			}
			if ($oMessage->size('danger') == 0) {
				$nPage = (isset($_POST['page']) ? intval($_POST['page']) : 1);
				oos_redirect(oos_href_link($aContents['account_wishlist'], 'page=' . $nPage));
			} else {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $sProductsId));
			}
		}
		break;

    }

