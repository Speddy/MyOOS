<?php
/* ----------------------------------------------------------------------
   $Id: oos_blocks.php,v 1.2 2008/01/24 14:08:31 r23 Exp $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
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

  $aContentBlock = array();

  $blocktable = $oostable['block'];
  $block_infotable = $oostable['block_info'];
  $block_to_page_typetable = $oostable['block_to_page_type'];
  $block_sql = "SELECT b.block_id, b.block_side, b.block_status, b.block_file, b.block_type,
                       b.block_sort_order, b.block_login_flag, b.block_cache, bi.block_name
                FROM $blocktable b,
                     $block_to_page_typetable b2p,
                     $block_infotable bi
                WHERE b.block_status = '1'
                  AND b.block_id = b2p.block_id
                  AND bi.block_id = b2p.block_id
                  AND bi.block_languages_id = '" .  intval($nLanguageID) . "'
                  AND b2p.page_type_id = '" . intval($nPageType) . "'";
  if (isset($_SESSION['customer_id'])) {
    $block_sql .= "  AND ( b.block_login_flag = '0' OR b.block_login_flag = '1')";
  } else {
    $block_sql .= "  AND b.block_login_flag = '0'";
  }
  $block_sql .= " ORDER BY b.block_side, b.block_sort_order ASC";
  $block_result = $dbconn->GetAll($block_sql);

  foreach ($block_result as $block) {
    $block_heading = $block['block_name'];
    $block_file = trim($block['block_file']);
    $block_side = $block['block_side'];

    if (empty($block_file)) {
      continue;
    }
	
    $block_tpl = $sTheme . '/blocks/' . $block_file . '.html';

    if ($block['block_cache'] != '') {
		if ( (USE_CACHE == 'true') && (!isset($_SESSION)) ) {
			$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
		}
      $bid = trim('oos_' . $block['block_cache'] . '_cache_id');
      if (!$smarty->isCached($block_tpl, ${$bid})) {
        include_once MYOOS_INCLUDE_PATH . '/includes/blocks/block_' . $block_file . '.php';
      }
      $block_content = $smarty->fetch($block_tpl, ${$bid});
    } else {
      $smarty->setCaching(false);
      include_once MYOOS_INCLUDE_PATH . '/includes/blocks/block_' . $block_file . '.php';
      $block_content = $smarty->fetch($block_tpl);
    }
	
    $aContentBlock[] = array('side' => $block_side,
                             'block_content' => $block_content );

  }

  
 

  for ($i = 0, $n = count($aContentBlock); $i < $n; $i++) {
     switch ($aContentBlock[$i]['side']) {

       case 'left':
         $smarty->append('oos_blockleft', array('content' => $aContentBlock[$i]['block_content']));
         break;

       case 'right':
         $smarty->append('oos_blockright', array('content' => $aContentBlock[$i]['block_content']));
         break;

     }
  }

  $smarty->setCaching(false);

