<?php
/* ----------------------------------------------------------------------
   $Id: oos_event_customer_must_login.php,v 1.1 2007/06/08 15:02:12 r23 Exp $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2016 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  /** ensure this file is being included by a parent file */
  defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

  class oos_event_customer_must_login {

    var $name;
    var $description;
    var $uninstallable;
    var $depends;
    var $preceeds;
    var $author;
    var $version;
    var $requirements;


   /**
    *  class constructor
    */
    public function __construct() {

      $this->name          = PLUGIN_EVENT_CUSTOMER_MUST_LOGIN_NAME;
      $this->description   = PLUGIN_EVENT_CUSTOMER_MUST_LOGIN_DESC;
      $this->uninstallable = TRUE;
      $this->author        = 'MyOOS Development Team';
      $this->version       = '1.0';
      $this->requirements  = array(
                               'oos'         => '1.5.0',
                               'smarty'      => '2.6.9',
                               'adodb'       => '4.62',
                               'php'         => '5.9.0'
      );
    }

    function create_plugin_instance() {

      if (!isset($_SESSION['customer_id'])) {
        $aContents = oos_get_content();

		// Todo fix
        if ($_GET['mp'] != $aModules['user']) { 
          $_SESSION['navigation']->set_snapshot();
          oos_redirect(oos_href_link($aContents['login'], '', 'SSL'));
        }
      }

      return true;
    }

    function install() {
      return true;
    }

    function remove() {
      return true;
    }

    function config_item() {
      return FALSE;
    }
  }


