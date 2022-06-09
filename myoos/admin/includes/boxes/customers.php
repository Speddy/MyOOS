<?php
/** ---------------------------------------------------------------------
   $Id: customers.php 437 2013-06-22 15:33:30Z r23 $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: customers.php,v 1.15 2002/03/16 00:20:11 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/**
 * ensure this file is being included by a parent file 
 */
defined('OOS_VALID_MOD') or die('Direct Access to this location is not allowed.');


$bActive = ($_SESSION['selected_box'] == 'customers') ? true : false;

$aBlocks[] = array(
    'heading' => BOX_HEADING_CUSTOMERS,
    'link' => oos_href_link_admin(basename($_SERVER['PHP_SELF']), oos_get_all_get_params(array('selected_box')) . 'selected_box=customers'),
    'icon' => 'fas fa-users',
    'active' => $bActive,
    'contents' => array(
        array(
            'code' => $aContents['customers'],
            'title' => BOX_CUSTOMERS_CUSTOMERS,
            'link' => oos_admin_files_boxes('customers', 'selected_box=customers')
        ),
        array(
            'code' => $aContents['orders'],
            'title' => BOX_CUSTOMERS_ORDERS,
            'link' => oos_admin_files_boxes('orders', 'selected_box=customers')
        ),
        array(
            'code' => $aContents['customers_status'],
            'title' => BOX_LOCALIZATION_CUSTOMERS_STATUS,
            'link' => oos_admin_files_boxes('customers_status', 'selected_box=customers')
        ),
        array(
            'code' => $aContents['orders_status'],
            'title' => BOX_ORDERS_STATUS,
            'link' => oos_admin_files_boxes('orders_status', 'selected_box=customers')
        ),
        array(
            'code' => $aContents['manual_loging'],
            'title' => BOX_ADMIN_LOGIN,
            'link' => oos_admin_files_boxes('manual_loging', 'selected_box=customers')
        ),
    ),
);
