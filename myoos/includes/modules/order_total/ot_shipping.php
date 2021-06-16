<?php
/* ----------------------------------------------------------------------
   $Id: ot_shipping.php,v 1.1 2007/06/07 17:30:51 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: ot_shipping.php,v 1.15 2003/02/07 22:01:57 dgw_ 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class ot_shipping {
    var $title, $output, $enabled = false;

    public function __construct() {
      global $aLang;

      $this->code = 'ot_shipping';
      $this->title = $aLang['module_order_total_shipping_title'];
	  $this->info = $aLang['shopping_cart_shipping_info'];
      $this->description = $aLang['module_order_total_shipping_description'];
      $this->enabled = (defined('MODULE_ORDER_TOTAL_SHIPPING_STATUS') && (MODULE_ORDER_TOTAL_SHIPPING_STATUS == 'true') ? true : false);
      $this->sort_order = (defined('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER') ? MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER : null);

      $this->output = array();
    }

    function process() {
      global $oOrder, $oCurrencies, $aUser;

	  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
        switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
          case 'national':
            if ($oOrder->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
          case 'international':
            if ($oOrder->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
          case 'both':
            $pass = true; break;
          default:
            $pass = false; break;
        }

        if ( ($pass == true) && ( ($oOrder->info['total'] - $oOrder->info['shipping_cost']) >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
          $oOrder->info['shipping_method'] = $this->title;
          $oOrder->info['total'] -= $oOrder->info['shipping_cost'];
          $oOrder->info['shipping_cost'] = 0;
        }
      }

      $module = substr($_SESSION['shipping']['id'], 0, strpos($_SESSION['shipping']['id'], '_'));

      if (oos_is_not_null($oOrder->info['shipping_method'])) {
        if ($GLOBALS[$module]->tax_class > 0) {
          $shipping_tax = oos_get_tax_rate($GLOBALS[$module]->tax_class, $oOrder->billing['country']['id'], $oOrder->billing['zone_id']);
          $shipping_tax_description = oos_get_tax_rate($GLOBALS[$module]->tax_class, $oOrder->billing['country']['id'], $oOrder->billing['zone_id']);

          $tax = oos_calculate_tax($oOrder->info['shipping_cost'], $shipping_tax);
          if ($aUser['price_with_tax'] == 1)  $oOrder->info['shipping_cost'] += $tax;

          $oOrder->info['tax'] += $tax;
          $oOrder->info['tax_groups']["$shipping_tax_description"] += $tax;
          $oOrder->info['total'] += $tax;
        }


        $this->output[] = array('title' => $oOrder->info['shipping_method'] . ':',
                                'text' => $oCurrencies->format($oOrder->info['shipping_cost'], true, $oOrder->info['currency'], $oOrder->info['currency_value']),
								'info' => '',
                                'value' => $oOrder->info['shipping_cost']);
      }
    }

    function shopping_cart_process() {
		global $oCurrencies, $aUser;

		$content_type = $_SESSION['cart']->get_content_type();
			
		// if the order contains only virtual products
		if (($content_type == 'virtual') || ($_SESSION['cart']->show_subtotal() == 0)) {
			$_SESSION['shipping'] = false;
			$_SESSION['sendto'] = false;
			$pass = true;
		}


		$delivery_country_id = isset($_SESSION['delivery_country_id']) ? intval($_SESSION['delivery_country_id']) : STORE_COUNTRY;
		$shipping = isset($_SESSION['shipping']) ? oos_prepare_input($_SESSION['shipping']) : DEFAULT_SHIPPING_METHOD . '_' . DEFAULT_SHIPPING_METHOD;

		if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
			switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
				case 'national':
					if ($delivery_country_id == STORE_COUNTRY) $pass = true; break;

				case 'international':
					if ($delivery_country_id != STORE_COUNTRY) $pass = true; break;

				case 'both':
					$pass = true; break;

				default:
					$pass = false; break;
			}

			if ( ($pass == true) && ( ($_SESSION['cart']->info['total'] - $_SESSION['cart']->info['shipping_cost']) >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
				$_SESSION['cart']->info['shipping_method'] = $this->title;
				$_SESSION['cart']->info['shipping_cost'] = 0;
				$_SESSION['cart']->info['total'] -= $_SESSION['cart']->info['shipping_cost'];

			}
		}

		$module = substr($_SESSION['shipping']['id'], 0, strpos($_SESSION['shipping']['id'], '_'));

		if (oos_is_not_null($_SESSION['cart']->info['shipping_method'])) {
			if ($GLOBALS[$module]->tax_class > 0) {
				$shipping_tax = oos_get_tax_rate($GLOBALS[$module]->tax_class, $oOrder->billing['country']['id'], $oOrder->billing['zone_id']);
				$shipping_tax_description = oos_get_tax_rate($GLOBALS[$module]->tax_class, $oOrder->billing['country']['id'], $oOrder->billing['zone_id']);

				if ($aUser['price_with_tax'] == 1)  $_SESSION['cart']->info['shipping_cost'] += $tax;

				$_SESSION['cart']->info['tax'] += $tax;
				$_SESSION['cart']->info['tax_groups']["$shipping_tax_description"] += $tax;
				$_SESSION['cart']->info['total'] += $tax;
			}

			$currency = $_SESSION['currency'];
			$currency_value = $oCurrencies->currencies[$_SESSION['currency']]['value'];
		
			$this->output[] = array('title' => $_SESSION['cart']->info['shipping_method'] . ':',
                                'text' => $oCurrencies->format($_SESSION['cart']->info['shipping_cost'], true, $currency, $currency_value),
								'info' => $this->info,
                                'value' => $_SESSION['cart']->info['shipping_cost']);
		}
    }


    function check() {
      if (!isset($this->_check)) {
        $this->_check = defined('MODULE_ORDER_TOTAL_SHIPPING_STATUS');
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION');
    }

    function install() {

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $configurationtable = $oostable['configuration'];
      $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '6', '1','oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '5', '6', '2', now())");
      $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', '6', '3', 'oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, use_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', '6', '4', 'currencies->format', now())");
      $dbconn->Execute("INSERT INTO $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', '6', '5', 'oos_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now())");
    }

    function remove() {

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $configurationtable = $oostable['configuration'];
      $dbconn->Execute("DELETE FROM $configurationtable WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }

