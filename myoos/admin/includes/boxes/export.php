<?php
/* ----------------------------------------------------------------------
   $Id: export.php 437 2013-06-22 15:33:30Z r23 $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2021 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) or die( 'Direct Access to this location is not allowed.' );


$bActive = ($_SESSION['selected_box'] == 'export' ) ? TRUE : FALSE;

  
$aBlocks[] = array(
	'heading' => BOX_HEADING_EXPORT,
	'link' => oos_href_link_admin(basename($_SERVER['PHP_SELF']), oos_get_all_get_params(array('selected_box')) . 'selected_box=tools'),
	'icon' => 'fa fa-database',
	'active' => $bActive,
	'contents' => array(
		array(
			'code' => $aContents['export_excel'],
			'title' => BOX_CATALOG_EXPORT_EXCEL,
			'link' => oos_admin_files_boxes('export_excel', 'selected_box=export')
		),
		array(
		'code' => $aContents['import_excel'],
			'title' => BOX_CATALOG_IMPORT_EXCEL,
			'link' => oos_admin_files_boxes('import_excel', 'selected_box=catalog')
		),		
	),
);
