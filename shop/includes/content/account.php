<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: account.php,v 1.58 2003/02/13 01:58:22 hpdl 
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

require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/user_account.php';

$customerstable = $oostable['customers'];
$address_bookstable = $oostable['address_book'];
$sql = "SELECT c.customers_gender, c.customers_firstname, c.customers_lastname,
                 c.customers_dob, c.customers_number, c.customers_email_address,
                 c.customers_vat_id, c.customers_telephone, c.customers_fax, c.customers_newsletter,
                 a.entry_company, a.entry_owner, a.entry_street_address, a.entry_suburb,
                 a.entry_postcode, a.entry_city, a.entry_zone_id, a.entry_state,
                 a.entry_country_id
          FROM $customerstable c,
             $address_bookstable a
          WHERE c.customers_id = '" . intval($_SESSION['customer_id']) . "'
            AND a.customers_id = c.customers_id
            AND a.address_book_id = '" . intval($_SESSION['customer_default_address_id']) . "'";
$account = $dbconn->GetRow($sql);

if ($account['customers_gender'] == 'm') {
	$gender = $aLang['male'];
} elseif ($account['customers_gender'] == 'f') {
	$gender = $aLang['female'];
}
$sCountryName = oos_get_country_name($account['entry_country_id']);

if ($account['customers_newsletter'] == '1') {
	$newsletter = $aLang['entry_newsletter_yes'];
} else {
	$newsletter = $aLang['entry_newsletter_no'];
}

// links breadcrumb
$oBreadcrumb->add($aLang['navbar_title'], oos_href_link($aContents['account'], '', 'SSL'));

$aTemplate['page'] = $sTheme . '/page/user_account.html';
$aTemplate['page_heading'] = $sTheme . '/heading/page_heading.html';

$nPageType = OOS_PAGE_TYPE_ACCOUNT;

require_once MYOOS_INCLUDE_PATH . '/includes/oos_system.php';
if (!isset($option)) {
	require_once MYOOS_INCLUDE_PATH . '/includes/message.php';
	require_once MYOOS_INCLUDE_PATH . '/includes/oos_blocks.php';
}

  // assign Smarty variables;
$smarty->assign(
      array(
          'breadcrumb'       => $oBreadcrumb->trail(),
          'heading_title'    => $aLang['heading_title'],

          'account'              => $account,
          'gender'               => $gender,
          'oos_get_country_name' => $sCountryName,
          'newsletter'           => $newsletter
      )
  );

$smarty->assign('oosPageHeading', $smarty->fetch($aTemplate['page_heading']));

// display the template
$smarty->display($aTemplate['page']);
