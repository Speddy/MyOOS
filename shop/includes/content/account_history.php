<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2016 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: account_history.php,v 1.58 2003/02/13 01:58:23 hpdl 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

// start the session
if ( $session->hasStarted() === FALSE ) $session->start();
  
if (!isset($_SESSION['customer_id'])) {
  	// navigation history
	if (!isset($_SESSION['navigation'])) {
		$_SESSION['navigation'] = new oosNavigationHistory();
	} 
    $_SESSION['navigation']->set_snapshot();
    oos_redirect(oos_href_link($aContents['login'], '', 'SSL'));
}

$nPage = isset($_GET['page']) ? $_GET['page']+0 : 1;

// split-page-results
require_once MYOOS_INCLUDE_PATH . '/includes/classes/class_split_page_results.php';
require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/account_history.php';



  $orderstable = $oostable['orders'];
  $orders_totaltable = $oostable['orders_total'];
  $orders_statustable = $oostable['orders_status'];
  $history_result_raw = "SELECT o.orders_id, o.date_purchased, o.delivery_name, ot.text AS order_total,
                                s.orders_status_name
                         FROM $orderstable o LEFT JOIN
                              $orders_totaltable ot
                           ON (o.orders_id = ot.orders_id) LEFT JOIN
                              $orders_statustable s
                           ON (o.orders_status = s.orders_status_id
                          AND s.orders_languages_id = '" .  intval($nLanguageID) . "')
                         WHERE o.customers_id = '" . intval($_SESSION['customer_id']) . "'
                           AND ot.class = 'ot_total'
                         ORDER BY orders_id DESC";
  $history_split = new splitPageResults($nPage, MAX_DISPLAY_ORDER_HISTORY, $history_result_raw, $history_numrows);
  $history_result = $dbconn->Execute($history_result_raw);

  $aHistory = array();
  if ($history_result->RecordCount()) {
    while ($history = $history_result->fields) {
      $orders_productstable = $oostable['orders_products'];
      $sql = "SELECT COUNT(*) AS total
              FROM $orders_productstable
              WHERE orders_id = '" . intval($history['orders_id']) . "'";
      $products = $dbconn->Execute($sql);
      $aHistory[] = array('orders_id' => $history['orders_id'],
                          'orders_status_name' => $history['orders_status_name'],
                          'date_purchased' => $history['date_purchased'],
                          'delivery_name' =>  $history['delivery_name'],
                          'products_total' => $products->fields['total'],
                          'order_total' => strip_tags($history['order_total']));
      // Move that ADOdb pointer!
      $history_result->MoveNext();
    }

    // Close result set
    $history_result->Close();
  }

  // links breadcrumb
  $oBreadcrumb->add($aLang['navbar_title_1'], oos_href_link($aContents['account'], '', 'SSL'));
  $oBreadcrumb->add($aLang['navbar_title_2'], oos_href_link($aContents['account_history'], '', 'SSL'));

  $aTemplate['page'] = $sTheme . '/page/account_history.html';

  $nPageType = OOS_PAGE_TYPE_ACCOUNT;
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
          'heading_title'	=> $aLang['heading_title'],
		  'robots'			=> 'noindex,nofollow,noodp,noydir',

          'page_split'    => $history_split->display_count($history_numrows, MAX_DISPLAY_ORDER_HISTORY, $nPage, $aLang['text_display_number_of_orders']),
          'display_links' => $history_split->display_links($history_numrows, MAX_DISPLAY_ORDER_HISTORY, MAX_DISPLAY_PAGE_LINKS, $nPage, oos_get_all_get_parameters(array('page', 'info'))),
          'numrows'  => $history_numrows,

          'oos_history_array' => $aHistory
      )
  );


  // display the template
$smarty->display($aTemplate['page']);
