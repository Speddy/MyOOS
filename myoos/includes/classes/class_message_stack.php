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
   $oMessage->add('Error: Error 1', 'error');
   $oMessage->add('Error: Error 2', 'warning');
   if ($oMessage->size > 0) echo $oMessage->output();
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

class messageStack {

	public function __construct() {

		$this->messages = array();
		
		if (isset($_SESSION) && isset($_SESSION['messageToStack'])) {
			$messageToStack = $_SESSION['messageToStack'];
			for ($i=0, $n=count($messageToStack); $i<$n; $i++) {
				$this->add($messageToStack[$i]['class'], $messageToStack[$i]['text'], $messageToStack[$i]['type']);
			}
			unset($_SESSION['messageToStack']);
		}
    }

// class methods
    public function add($class, $message, $type = 'danger') {
		$this->messages[] = array('class' => $class, 'type' => $type, 'text' => $message);
    }

    public function add_session($class, $message, $type = 'danger') {
		$messageToStack = array();
		if (isset($_SESSION['messageToStack']) && is_array($_SESSION['messageToStack'])) {
			$messageToStack = $_SESSION['messageToStack'];
		}  
	  
	  
		$messageToStack[] = array('class' => $class, 'text' => $message, 'type' => $type);
		$_SESSION['messageToStack'] = $messageToStack;
		$this->add($class, $message, $type);
    }

    public function reset() {
		$this->messages = array();
    }

    public function output($class) {
		$output = array();
		for ($i=0, $n=count($this->messages); $i<$n; $i++) {
			if ($this->messages[$i]['class'] == $class) {
				$output[] = $this->messages[$i];
			}
		}

		return $output;
    }

    public function size($class) {
		$count = 0;

		for ($i=0, $n=count($this->messages); $i<$n; $i++) {
			if ($this->messages[$i]['class'] == $class) {
				$count++;
			}
		}

		return $count;
	}
}
