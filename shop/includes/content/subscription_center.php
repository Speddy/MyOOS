<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2016 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   Newsletter Module
   P&G developmment

   Contribution based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 - 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/newsletter_subscription_center.php';

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {

	$email_address = oos_prepare_input($_POST['email_address']);
	
	if ( empty( $email_address ) || !is_string( $email_address ) ) {
		oos_redirect(oos_href_link($aContents['403']));
	}
  
    $customerstable = $oostable['customers'];
    $sql = "SELECT customers_firstname, customers_lastname, customers_id
            FROM $customerstable
            WHERE customers_email_address = '" . oos_db_input($email_address) . "'";
    $check_customer_result = $dbconn->Execute($sql);
    if ($check_customer_result->RecordCount()) {
      $check_customer = $check_customer_result->fields;

      $customerstable = $oostable['customers'];
      $dbconn->Execute("UPDATE $customerstable
                    SET customers_newsletter = '0'
                    WHERE customers_id = '" . $check_customer['customers_id'] . "'");
      oos_redirect(oos_href_link($aContents['newsletter_unsubscribe_success']));
    } else {
      $newsletter_recipientstable = $oostable['newsletter_recipients'];
      $sql = "SELECT customers_firstname
              FROM $newsletter_recipientstable
              WHERE customers_email_address = '" . oos_db_input($email_address) . "'";
      $check_mail_customer_result = $dbconn->Execute($sql);
      if ($check_mail_customer_result->RecordCount()) {
        $newsletter_recipientstable = $oostable['newsletter_recipients'];
        $dbconn->Execute("UPDATE $newsletter_recipientstable
                          SET customers_newsletter = '0'
                          WHERE customers_email_address = '" . oos_db_input($email_address) . "'");
        oos_redirect(oos_href_link($aContents['newsletter_unsubscribe_success']));
      }
    }
    oos_redirect(oos_href_link($aContents['subscription_center'], 'email=nonexistent', 'SSL'));
  } else {

    $oBreadcrumb->add($aLang['navbar_title'], oos_href_link($aContents['newsletter']));

    $aTemplate['page'] = $sTheme . '/page/subscription_center.html';

    $nPageType = OOS_PAGE_TYPE_SERVICE;
	$sPagetitle = $aLang['heading_title'] . ' ' . OOS_META_TITLE;

    require_once MYOOS_INCLUDE_PATH . '/includes/system.php';
    if (!isset($option)) {
      require_once MYOOS_INCLUDE_PATH . '/includes/message.php';
      require_once MYOOS_INCLUDE_PATH . '/includes/blocks.php';
    }

    // assign Smarty variables;
    $smarty->assign(
        array(
            'breadcrumb' => $oBreadcrumb->trail(),
            'heading_title' => $aLang['heading_title'],
			'robots'		=> 'noindex,follow,noodp,noydir'
        )
    );

	// display the template
	$smarty->display($aTemplate['page']);
  }
