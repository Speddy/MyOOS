<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: message_stack.php,v 1.5 2002/11/22 18:45:46 dgw_ 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- 
   Example usage:

   $oMessage = new messageStack();
   $oMessage->add('error', 'Error: Error 1');
   $oMessage->add('warning', 'Error: Error 2');
   if ($oMessage->size > 0) echo $oMessage->output();
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

class messageStack {

	public function __construct() {

		$this->messages = array();
			
		if (isset($_SESSION) && isset($_SESSION['messageToStack']) && is_array($_SESSION['messageToStack'])) {
			for ($i=0, $n=count($_SESSION['messageToStack']); $i<$n; $i++) {
				$this->add($_SESSION['messageToStack'][$i]['type'], $_SESSION['messageToStack'][$i]['text']);
			}
			unset($_SESSION['messageToStack']);
		}		
		
    }

// class methods
    public function add($type = 'danger', $message, ) {
		$message = trim($message);
		
		if (strlen($message) > 0) {
			if (!in_array($type, ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'])) {
                $type = 'danger';
            }
					
			$this->messages[] = array('type' => $type, 'text' => $message);
		}
    }

    public function add_session($class, $message, $type = 'danger') {
		if (!isset($_SESSION['messageToStack'])) {
			$_SESSION['messageToStack'] = array();
		}
		$_SESSION['messageToStack'][] = array('text' => $message, 'type' => $type);
	}		

    public function reset() {
		$this->messages = array();
    }

    public function output($type) {
		$output = array();
		
        foreach ($this->messages as $next_message) {
            if ($next_message['type'] == $type) {
                $output[] = $next_message;
            }
        }

		return $output;
    }


    public function size($type) {

        if (!empty($_SESSION['messageToStack'])) {
            foreach ($_SESSION['messageToStack'] as $next_message) {
                $this->add($next_message['type'], $next_message['text']);
            }
        }

        $count = 0;

        foreach ($this->messages as $next_message) {
            if ($next_message['type'] == $type) {
                $count++;
            }
        }

        return $count;
    }		
}
