<?php
/**
   ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: sitemap.php,v 1.1 2004/02/16 07:13:17 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2001 - 2004 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- 
 */

/**
 * ensure this file is being included by a parent file 
 */
defined('OOS_VALID_MOD') or die('Direct Access to this location is not allowed.');

require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/sitemap.php';

$aTemplate['page'] = $sTheme . '/page/sitemap.html';

$nPageType = OOS_PAGE_TYPE_MAINPAGE;
$sPagetitle = $aLang['heading_title'] . ' ' . OOS_META_TITLE;

$sGroup = trim($aUser['text']);
$nContentCacheID = $sTheme . '|info|' . $sGroup . '|sitemap|' . $sLanguage;

require_once MYOOS_INCLUDE_PATH . '/includes/system.php';
if (!isset($option)) {
    include_once MYOOS_INCLUDE_PATH . '/includes/message.php';
    include_once MYOOS_INCLUDE_PATH . '/includes/blocks.php';
}

if ((USE_CACHE == 'true') && (!isset($_SESSION))) {
    $smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
}

if (!$smarty->isCached($aTemplate['page'], $nContentCacheID)) {
    $oSitemap = new oosCategoryTree();
    $oSitemap->setShowCategoryProductCount(false);

    // links breadcrumb
    $oBreadcrumb->add($aLang['navbar_title'], oos_href_link($aContents['sitemap']));
    $sCanonical = oos_href_link($aContents['sitemap'], '', false, true);

    // assign Smarty variables;
    $smarty->assign(
        array(
            'breadcrumb'    => $oBreadcrumb->trail(),
            'heading_title' => $aLang['heading_title'],
            'canonical'        => $sCanonical
        )
    );

    $smarty->assign('sitemap', $oSitemap->buildTree());
}

// display the template
$smarty->display($aTemplate['page']);
