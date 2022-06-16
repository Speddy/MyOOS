<?php
/**
   ----------------------------------------------------------------------
   $Id: localization.php 437 2013-06-22 15:33:30Z r23 $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: localization.php,v 1.15 2002/03/16 00:20:11 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */

/**
 * ensure this file is being included by a parent file
 */
defined('OOS_VALID_MOD') or die('Direct Access to this location is not allowed.');

$bActive = ($_SESSION['selected_box'] == 'localization') ? true : false;

$aBlocks[] = array(
    'heading' => BOX_HEADING_LOCALIZATION,
    'link' => oos_href_link_admin(basename($_SERVER['PHP_SELF']), oos_get_all_get_params(array('selected_box')) . 'selected_box=localization'),
    'icon' => 'fa fa-language',
    'active' => $bActive,
    'contents' => array(
        array(
            'code' => $aContents['currencies'],
            'title' => BOX_LOCALIZATION_CURRENCIES,
            'link' => oos_admin_files_boxes('currencies', 'selected_box=localization')
        ),
        array(
            'code' => $aContents['languages'],
            'title' => BOX_LOCALIZATION_LANGUAGES,
            'link' => oos_admin_files_boxes('languages', 'selected_box=localization')
        ),
    ),
);
