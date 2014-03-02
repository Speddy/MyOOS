<?php
/* ----------------------------------------------------------------------
   $Id: block_currencies.php 296 2013-04-13 14:48:55Z r23 $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: currencies.php,v 1.16 2003/02/12 20:27:31 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

$currency_block = 'false';
if (isset($oCurrencies) && is_object($oCurrencies)) {

    reset($oCurrencies->currencies);

    $aCurrencies = array();	
    while (list($sKey, $value) = each($oCurrencies->currencies)) {
		$aCurrencies[] = array('id' => $sKey, 'text' => $value['title']);
    }
	
	$currency_result = count($aCurrencies);
	if ($currency_result >= 2) {
		$currency_block = 'true';

		$currency_get_parameters = oos_get_all_get_parameters(array('language', 'currency'));
		$currency_all_get_parameters = oos_remove_trailing($currency_get_parameters);

		$smarty->assign('currencies_contents', $aCurrencies);

		$smarty->assign(
			array(
            'block_heading_currencies' => $block_heading,
            'currency_get_parameters' => $currency_all_get_parameters
			)
		);
	
	} else {
		$blockstable = $oostable['block'];
		$dbconn->Execute("UPDATE " . $blockstable . "
							SET block_status = 0
							WHERE block_file = 'currencies'");   
	}
}
	
$smarty->assign('currency_block', $currency_block);	
	
