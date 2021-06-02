<?php
/* ----------------------------------------------------------------------
   $Id: ot_xmembers.php,v 1.1 2007/06/07 17:30:51 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: ot_xmembers.php,v 1.1 2003/01/08 10:53:04 elarifr 
         ot_lev_members.php,v 1.0 2002/04/08 01:13:43 hpdl 
   ----------------------------------------------------------------------
   Customers_status v3.x / Catalog part
   Copyright elari@free.fr

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class ot_xmembers {
    var $title, $output, $enabled = false;

    public function __construct() {
      global $aLang, $aUser;

      $this->code = 'ot_xmembers';
      $this->title = $aLang['module_xmembers_title'];
      $this->description = $aLang['module_xmembers_description'];
      $this->enabled = (defined('MODULE_XMEMBERS_STATUS') && (MODULE_XMEMBERS_STATUS == 'true') ? true : false);
      $this->sort_order = (defined('MODULE_XMEMBERS_SORT_ORDER') ? MODULE_XMEMBERS_SORT_ORDER : null);
      $this->include_shipping = (defined('MODULE_XMEMBERS_INC_SHIPPING') ? MODULE_XMEMBERS_INC_SHIPPING : null);
      $this->include_tax = (defined('MODULE_XMEMBERS_INC_TAX') ? MODULE_XMEMBERS_INC_TAX : null);
      $this->percentage = isset($aUser['ot_discount']) ? $aUser['ot_discount'] : 1; 
      $this->minimum = isset($aUser['ot_minimum']) ? $aUser['ot_minimum'] : 0; 
      $this->calculate_tax = (defined('MODULE_XMEMBERS_CALC_TAX') ? MODULE_XMEMBERS_CALC_TAX : null);

      $this->output = array();
    }

    function process() {
      global $oOrder, $aUser, $oCurrencies;

      $od_amount = $this->calculate_credit($this->get_order_total());
      if ($od_amount>0) {
        $this->deduction = $od_amount;
        $this->output[] = array('title' => '<span class="otDiscount">- ' . $this->title . ' ('. number_format($aUser['ot_discount'], 2) .'%):</span>',
                                'text' => '<strong><span class="otDiscount">' . $oCurrencies->format($od_amount) . '</span></strong>',
                                'value' => $od_amount);
        $oOrder->info['total'] = $oOrder->info['total'] - $od_amount;
      }
    }


  function calculate_credit($amount) {
    global $oOrder, $aUser;

    $od_amount=0;
    $od_pc = $this->percentage;
    if ($amount > $this->minimum) {
      if ($aUser['ot_discount_flag'] == '1') {  // Calculate tax reduction if necessary
        if ($this->calculate_tax == 'true') {  // Calculate main tax reduction
          $tod_amount = round($oOrder->info['tax']*10)/10*$od_pc/100;
          $oOrder->info['tax'] = $oOrder->info['tax'] - $tod_amount; // Calculate tax group deductions
          reset($oOrder->info['tax_groups']);
          foreach($oOrder->info['tax_groups'] as $key => $value) {			  
            $god_amount = round($value*10)/10*$od_pc/100;
            $oOrder->info['tax_groups'][$key] = $oOrder->info['tax_groups'][$key] - $god_amount;
         }
        }
        $od_amount = round($amount*10)/10*$od_pc/100;
        $od_amount = $od_amount + $tod_amount;
      }
    }
    return $od_amount;
  }



  function get_order_total() {
    global $oOrder;

    // Get database information
    $dbconn =& oosDBGetConn();
    $oostable =& oosDBGetTables();

    $order_total = $oOrder->info['total'];
     // Check if gift voucher is in cart and adjust total
    $products = $_SESSION['cart']->get_products();
    for ($i=0; $i<count($products); $i++) {
      $t_prid = oos_get_product_id($products[$i]['id']);

      $productstable = $oostable['products'];
      $query = "SELECT products_price, products_tax_class_id, products_model
                FROM $productstable
                WHERE products_id = '" . intval($t_prid) . "'";
      $gv_result = $dbconn->GetRow($query);

      if (preg_match('/^GIFT/', addslashes($gv_result['products_model']))) {
        $qty = $_SESSION['cart']->get_quantity($t_prid);
        $products_tax = oos_get_tax_rate($gv_result['products_tax_class_id']);
        if ($this->include_tax == 'false') {
          $gv_amount = $gv_result['products_price'] * $qty;
        } else {
          $gv_amount = ($gv_result['products_price'] + oos_calculate_tax($gv_result['products_price'],$products_tax)) * $qty;
        }
        $order_total = $order_total - $gv_amount;
      }
    }
    if ($this->include_tax == 'false') $order_total = $order_total-$oOrder->info['tax'];
    if ($this->include_shipping == 'false') $order_total = $order_total-$oOrder->info['shipping_cost'];
    return $order_total;
  }


    function check() {
      if (!isset($this->_check)) {
        $this->_check = defined('MODULE_XMEMBERS_STATUS');
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_XMEMBERS_STATUS', 'MODULE_XMEMBERS_SORT_ORDER', 'MODULE_XMEMBERS_INC_SHIPPING', 'MODULE_XMEMBERS_INC_TAX', 'MODULE_XMEMBERS_CALC_TAX');
    }

    function install() {

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $configurationtable = $oostable['configuration'];
      $dbconn->Execute("INSERT INTO  $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_XMEMBERS_STATUS', 'true', '6', '1','oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $dbconn->Execute("INSERT INTO  $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_XMEMBERS_SORT_ORDER', '3', '6', '2', now())");
      $dbconn->Execute("INSERT INTO  $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function ,date_added) values ('MODULE_XMEMBERS_INC_SHIPPING', 'true', '6', '5', 'oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $dbconn->Execute("INSERT INTO  $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function ,date_added) values ('MODULE_XMEMBERS_INC_TAX', 'true', '6', '6','oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $dbconn->Execute("INSERT INTO  $configurationtable (configuration_key, configuration_value, configuration_group_id, sort_order, set_function ,date_added) values ('MODULE_XMEMBERS_CALC_TAX', 'false', '6', '5','oos_cfg_select_option(array(\'true\', \'false\'), ', now())");
    }

    function remove() {

      // Get database information
      $dbconn =& oosDBGetConn();
      $oostable =& oosDBGetTables();

      $configurationtable = $oostable['configuration'];
      $dbconn->Execute("DELETE FROM  $configurationtable WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }

