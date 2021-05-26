<?php
/* ----------------------------------------------------------------------
   $Id: administrator.php 437 2013-06-22 15:33:30Z r23 $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: administrator.php,v 1.20 2002/03/16 00:20:11 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) or die( 'Direct Access to this location is not allowed.' );

$bActive = ($_SESSION['selected_box'] == 'administrator' ) ? TRUE : FALSE;
   
$aBlocks[] = array(
	'heading' => BOX_HEADING_ADMINISTRATOR,
	'link' => oos_href_link_admin(basename($_SERVER['PHP_SELF']), oos_get_all_get_params(array('selected_box')) . 'selected_box=administrator'),
	'icon' => 'fa fa-user',
	'active' => $bActive,
	'contents' => array(
		array(
			'code' => $aContents['admin_members'],
			'title' => BOX_ADMINISTRATOR_MEMBERS,
			'link' => oos_admin_files_boxes('admin_members', 'selected_box=administrator')
		),
		array(
			'code' => $aContents['admin_files'],
			'title' => BOX_ADMINISTRATOR_BOXES,
			'link' => oos_admin_files_boxes('admin_files', 'selected_box=administrator')
		),	
	),
);

