<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: navigation_history.php,v 1.5 2003/02/12 21:07:45 hpdl 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

/**
* Class Navigation History

*/
class navigationHistory {

	var $path;
	var $snapshot;

	/**
     * Constructor of our Class
     */
	public function __construct() {
		$this->reset();
	}

	public function reset() {
		$this->path = array();
		$this->snapshot = array();
	}


    public function set_snapshot($page = '') {
      global $sContent;
	  
      if (is_array($page)) {
        $this->snapshot = array('content' => $page['content'],
                                'get' => $page['get']);
      } else {
        $get_all = ''; 
        if (isset($_GET)) {
          $get_all = oos_get_all_get_parameters();
          $get_all = oos_remove_trailing($get_all);
        }
        $this->snapshot = array('content' => $sContent,
                                'get' => $get_all);
      }
    }


    public function clear_snapshot() {
      $this->snapshot = array();
    }

    public function set_path_as_snapshot($history = 0) {
      $pos = (count($this->path)-1-$history);
      $this->snapshot = array('content' => $this->path[$pos]['content'],
                              'get' => $this->path[$pos]['get']);
    }


    public function debug() {
      for ($i=0, $n=count($this->path); $i<$n; $i++) {
        echo $this->path[$i]['content'] . '&' . $this->path[$i]['get'] . '<br />';
        echo '<br />';
      }

      echo '<br /><br />';
      if (count($this->snapshot) > 0) {
        echo $this->snapshot['content'] . '&' . $this->snapshot['get'] . '<br />';
      }
    }

}

