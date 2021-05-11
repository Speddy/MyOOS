<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2020 by the MyOOS Development Team.
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
		if ( $session->hasStarted() === FALSE ) $session->start();

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
						$_SESSION['cart']->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, FALSE, $_POST['to_wl_id'][$i]);
					} else {
						$_SESSION['error_message'] = oos_get_products_name($_POST['products_id'][$i]) . ' - ' . $aLang['error_products_units_invalid'] . ' ' . $_POST['cart_quantity'][$i] . ' - ' . $aLang['products_order_qty_unit_text_cart'] . ' ' . 		$products_order_units;
					}
				} else {
					$_SESSION['error_message'] =  $aLang['error_products_quantity_order_min_text'] . ' ' . oos_get_products_name($_POST['products_id'][$i]) . ' - ' . $aLang['error_products_quantity_invalid'] . ' ' . $_POST['cart_quantity'][$i] . ' - ' . $aLang['products_order_qty_min_text_cart'] . ' ' . $products_order_min;
				}
			}
		}

		oos_redirect(oos_href_link($goto_file, oos_get_all_get_parameters($parameters)));
		break;

	case 'add_product' :
		// start the session
		if ( $session->hasStarted() === FALSE ) $session->start();
		
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
						$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
					}
				} else {
					$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
				}

				if ($_SESSION['error_message'] == '') {
					oos_redirect(oos_href_link($goto_file, oos_get_all_post_parameters($parameters)));
				} else {
					oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['products_id']));
				}
			}
		}
		break;

	case 'clear_cart' :
		// start the session
		if ( $session->hasStarted() === FALSE ) $session->start();

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
		if ( $session->hasStarted() === FALSE ) $session->start();

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
      if (isset($_GET['products_id'])) {
        if (oos_has_product_attributes($_GET['products_id'])) {
			oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_GET['products_id']));
        } else {
			// start the session
			if ( $session->hasStarted() === FALSE ) $session->start();	

			// create the shopping cart
			if (!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = new shoppingCart();
			}
			
			if (isset($_GET['cart_quantity']) && is_numeric($_GET['cart_quantity'])) {
				$cart_quantity = oos_prepare_input($_GET['cart_quantity']);
			} else {
				$cart_quantity = 1;
			}
			$cart_qty = $_SESSION['cart']->get_quantity($_GET['products_id']);
			$news_qty = $cart_qty + $cart_quantity;

			$products_order_min = oos_get_products_quantity_order_min($_GET['products_id']);
			$products_order_units = oos_get_products_quantity_order_units($_GET['products_id']);

			if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
				if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
					$_SESSION['cart']->add_cart($_GET['products_id'], $news_qty);
				} else {
					$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
				}
			} else {
				$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
			}
        }
        if ($_SESSION['error_message'] == '') {
			oos_redirect(oos_href_link($goto_file, oos_get_all_get_parameters($parameters)));
        } else {
			oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_GET['products_id']));
        }
      } elseif (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
        if (oos_has_product_attributes($_POST['products_id'])) {
          oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['products_id']));
        } else {
			// start the session
			if ( $session->hasStarted() === FALSE ) $session->start();

			// create the shopping cart
			if (!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = new shoppingCart();
			}
			
			if (isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity'])) {

				$cart_quantity = oos_prepare_input($_POST['cart_quantity']);			
			
				$cart_qty = $_SESSION['cart']->get_quantity($_POST['products_id']);
				$news_qty = $cart_qty + $cart_quantity;

				$products_order_min = oos_get_products_quantity_order_min($_POST['products_id']);
				$products_order_units = oos_get_products_quantity_order_units($_POST['products_id']);

				if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
					if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
						$_SESSION['cart']->add_cart($_POST['products_id'], $news_qty);
					} else {
						$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
					}
				} else {
					$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
				}
			}
			if ($_SESSION['error_message'] == '') {
				oos_redirect(oos_href_link($goto_file, oos_get_all_post_parameters($parameters)));
			} else {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['products_id']));
			}
        }
	}
	break;


    case 'buy_slave' :	
      if (isset($_GET['slave_id'])) {
        if (oos_has_product_attributes($_GET['slave_id'])) {
          oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_GET['slave_id']));
        } else {
			// start the session
			if ( $session->hasStarted() === FALSE ) $session->start();

			// create the shopping cart
			if (!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = new shoppingCart();
			}			
          $cart_quantity = 1;
          $cart_qty = $_SESSION['cart']->get_quantity($_GET['slave_id']);
          $news_qty = $cart_qty + $cart_quantity;

          $products_order_min = oos_get_products_quantity_order_min($_GET['slave_id']);
          $products_order_units = oos_get_products_quantity_order_units($_GET['slave_id']);

          if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
            if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
              $_SESSION['cart']->add_cart($_GET['slave_id'], $news_qty);
            } else {
              $_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
            }
          } else {
            $_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
          }
        }
        if ($_SESSION['error_message'] == '') {
          oos_redirect(oos_href_link($goto_file, oos_get_all_get_parameters($parameters)));
        } else {
          oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_GET['slave_id']));
        }
      } elseif (isset($_POST['slave_id']) && is_numeric($_POST['slave_id'])) {
        if (oos_has_product_attributes($_POST['slave_id'])) {
          oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['slave_id']));
        } else {
			// start the session
			if ( $session->hasStarted() === FALSE ) $session->start();

			// create the shopping cart
			if (!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = new shoppingCart();
			}			

          if (isset($_POST['cart_quantity']) && is_numeric($_POST['cart_quantity'])) {
            $cart_quantity = oos_prepare_input($_POST['cart_quantity']);
            $cart_qty = $_SESSION['cart']->get_quantity($_POST['slave_id']);
            $news_qty = $cart_qty + $cart_quantity;

            $products_order_min = oos_get_products_quantity_order_min($_POST['slave_id']);
            $products_order_units = oos_get_products_quantity_order_units($_POST['slave_id']);

            if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
              if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
                $_SESSION['cart']->add_cart($_POST['slave_id'], $news_qty);
              } else {
                $_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
              }
            } else {
              $_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
            }
          }
        }
        if ($_SESSION['error_message'] == '') {
          oos_redirect(oos_href_link($goto_file, oos_get_all_post_parameters($parameters)));
        } else {
          oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['slave_id']));
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

        $products_notificationstable = $oostable['products_notifications'];

        if (!is_array($notify)) $notify = array($notify);
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
		if ( $session->hasStarted() === FALSE ) $session->start();
		
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
		if (isset($_GET['products_id']) && is_numeric($_GET['products_id'])) {
			$wishlist_products_id = oos_prepare_input($_GET['products_id']);
			
			// start the session
			if ( $session->hasStarted() === FALSE ) $session->start();
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

			if (oos_has_product_attributes($_GET['products_id'])) {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $wishlist_products_id));
			}

			$customers_wishlisttable = $oostable['customers_wishlist'];
			$dbconn->Execute("DELETE FROM $customers_wishlisttable WHERE customers_id = '" . intval($_SESSION['customer_id']) . "'  AND products_id = '" . oos_db_input($wishlist_products_id) . "'");

			$dbconn->Execute("INSERT INTO $customers_wishlisttable
							(customers_id, customers_wishlist_link_id, products_id,
							customers_wishlist_date_added) VALUES (" . $dbconn->qstr($_SESSION['customer_id']) . ','
                                                                    . $dbconn->qstr($_SESSION['customer_wishlist_link_id']) . ','
                                                                    . $dbconn->qstr($wishlist_products_id) . ','
                                                                    . $dbconn->qstr(date('Ymd')) . ")");
			oos_redirect(oos_href_link($aContents['account_wishlist']));
		}
		break;	  
	  
	  
    case 'wishlist_add_product' :
	
		// start the session
		if ( $session->hasStarted() === FALSE ) $session->start();

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

			$cart_qty = $_SESSION['cart']->get_quantity(oos_get_uprid($_POST['products_id'], $_POST['id']));
			$news_qty = $cart_qty + $cart_quantity;
	
			$products_order_min = oos_get_products_quantity_order_min($_POST['products_id']);
			$products_order_units = oos_get_products_quantity_order_units($_POST['products_id']);

			if ( ($cart_quantity >= $products_order_min) or ($cart_qty >= $products_order_min) ) {
				if ( ($cart_quantity%$products_order_units == 0) and ($news_qty >= $products_order_min) ) {
					$_SESSION['cart']->add_cart($_POST['products_id'], $news_qty, $_POST['id'], TRUE, $_POST['wl_products_id']);   
				} else {
					$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_units_invalid'] . $cart_quantity  . ' - ' . $aLang['products_order_qty_unit_text_info'] . ' ' . $products_order_units;
				}
			} else {
				$_SESSION['error_message'] = $aLang['error_products_quantity_order_min_text'] . $aLang['error_products_quantity_invalid'] . $cart_quantity . ' - ' . $aLang['products_order_qty_min_text_info'] . ' ' . $products_order_min;
			}
			if ($_SESSION['error_message'] == '') {
				oos_redirect(oos_href_link($aContents['account_wishlist'], 'page=' . intval($_POST['page'])));
			} else {
				oos_redirect(oos_href_link($aContents['product_info'], 'products_id=' . $_POST['products_id']));
			}
		}
		break;

    }

