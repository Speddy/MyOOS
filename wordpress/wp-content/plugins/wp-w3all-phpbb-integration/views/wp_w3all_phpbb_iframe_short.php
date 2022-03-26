<?php defined( 'ABSPATH' ) or die( 'forbidden' );
// 2022 - @axew3.com //

// START (MAY) DO NOT MODIFY

  if(defined("W3PHPBBCONFIG")){
    // detect if it is the uid2 in phpBB
    $phpBBuid2 = (isset($_COOKIE[W3PHPBBCONFIG["cookie_name"].'_u']) && $_COOKIE[W3PHPBBCONFIG["cookie_name"].'_u'] == 2) ? 2 : 0;
   } else { $phpBBuid2 = 0; }
  if(defined("WPW3ALL_NOT_ULINKED")) { $phpBBuid2 = 2; } // switch to be like it is uid2, so to avoid the reload of the page loop
  // the shortcode homepage push has been excluded directly more below where: if(w3all_passed_url != '' && inhomepageShort != 'inhomepage-phpbbiframe'){
  // exclude also if the passed url_push is set to 'no' more below

global $w3all_iframe_custom_w3fancyurl,$w3all_url_to_cms,$w3all_iframe_custom_top_gap,$w3cookie_domain,$wp_w3all_forum_folder_wp;
$wp_w3all_forum_folder_wp = empty($ltm['wp_page_name']) ? $wp_w3all_forum_folder_wp : $ltm['wp_page_name'];
$w3all_iframe_custom_top_gap = empty($ltm['wp_page_iframe_top_gap']) ? $w3all_iframe_custom_top_gap : $ltm['wp_page_iframe_top_gap'];
$w3allhomeurl = get_home_url();

$current_user = wp_get_current_user();
$w3all_url_to_cms_clean = $w3all_url_to_cms;
$w3all_url_to_cms_clean0 = strpos($w3all_url_to_cms_clean, 'https://') !== false ? str_replace('https://', 'http://', $w3all_url_to_cms_clean) : str_replace('http://', 'https://', $w3all_url_to_cms_clean);
// guess to get the domain.com to display into preloader // array order here, is !important
if(!empty($w3all_url_to_cms)){
$w3guessdomaindisplay = str_replace(array("http://www.","https://www.","http://","https://"), array("","","",""), $w3all_url_to_cms);
$spos = strpos($w3guessdomaindisplay,'/');
if($spos !== false)
{
 $w3guessdomaindisplay = substr($w3guessdomaindisplay, 0, $spos);
}} else { $w3guessdomaindisplay = 'Did you setup the URL that point to phpBB into the integration plugin admin page<br /> and is it correct?'; }

if(!empty($w3cookie_domain)){
 if(substr($w3cookie_domain, 0, 1) == '.'){
    $document_domain = substr($w3cookie_domain, 1);
   } else {
      $document_domain = $w3cookie_domain;
     }
 } else {
  $document_domain = 'localhost';
 }

// do not use wp is_ssl() because it fail on some server
$w3all_orig = strpos($w3all_url_to_cms,'https') !== false ? 'https://'. $document_domain : 'http://' . $document_domain;
$w3all_orig_www = strpos($w3all_url_to_cms,'https') !== false ? 'https://www.'. $document_domain : 'http://www.' . $document_domain;

// security switch
$w3all_url_to_cms0 = $w3all_url_to_cms;

if( isset($_GET["w3"]) ){ // default
 $phpbb_url = trim(base64_decode($_GET["w3"]));
 $w3all_url_to_cms = $w3all_url_to_cms . '/' . $phpbb_url;
   if( preg_match('/[^-0-9A-Za-z\._#\:\?\/=&%]/ui',$phpbb_url) ){
    $w3all_url_to_cms = $w3all_url_to_cms0;
   }
} elseif ( isset($_GET[$w3all_iframe_custom_w3fancyurl]) ){ //fancy
 $phpbb_url = trim(base64_decode($_GET[$w3all_iframe_custom_w3fancyurl]));
 $w3all_url_to_cms = $w3all_url_to_cms . '/' . $phpbb_url;
   if( preg_match('/[^-0-9A-Za-z\._#\:\?\/=&%]/ui',$phpbb_url) ){
    $w3all_url_to_cms = $w3all_url_to_cms0;
   }
}

// old way to be removed
// assure that passed url is correctly all decoded // may something else need to added in certain conditions
$w3all_url_to_cms = str_replace(array("%2F", "%23", "%2E"), array("/", "#", "."), $w3all_url_to_cms);
$w3all_url_to_cms_switch_phpbb_default_url = (empty($ltm['phpbb_default_url'])) ? $w3all_url_to_cms : $ltm['phpbb_default_url'];

echo'<!-- noscript warning and simple preloader -->
<div id="w3idwloader" class="w3_wrap_loader">
  <noscript><h3 style="background-color:#333;color:#FFF;padding:15px;font-size:0.8em;pointer-events:auto;">Javascript disabled: can\'t load the forum page at this Url.<br />Enable Javascript on your browser or visit the forum here:<br /><br />'.$w3all_url_to_cms.'<br /><a href="'.$w3all_url_to_cms.'">To be auto-redirected click here<br />(may this link will not work)</a></h3></noscript>
<div class="w3preloadtext">'.$w3guessdomaindisplay.'</div>
<div class="ww3_loader"><div class="w3_loader"></div></div>
</div>
<!-- START iframe div -->
<div id="w3all_wrap_phpbb_forum_shortcode_div_id" class="w3all_wrap_phpbb_forum_shortcode_div_class">
<iframe id="w3all_phpbb_iframe" style="width:1px;min-width:100%;*width:100%;border:0;" scrolling="no" src="'.$w3all_url_to_cms_switch_phpbb_default_url.'"></iframe>
';
echo "<script type=\"text/javascript\">
    document.domain = '".$document_domain."'; // NOTE: for domains like 'mysite.co.uk' remove this line, if you setup the next to match the correct document.domain
    // document.domain = 'mydomain.com'; // NOTE: reset/setup this with domain (like mysite.co.uk) if js error when WP is installed like on mysite.domain.com and phpBB on domain.com: js origin error can come out for example when WordPress is on subdomain install and phpBB on domain. The origin fix is needed: (do this also on phpBB overall_footer.html added code, it need to match)
    var wp_u_logged = ".$current_user->ID.";
    var phpBBuid2 = ".$phpBBuid2.";
    var inhomepageShort = '".$ltm['wp_page_name']."';
    var w3urlpush = '".$ltm['url_push']."';
    var w3scrolldefault = '".$ltm['scroll_default']."';

 function w3all_ajaxup_from_phpbb(res){
      var w3all_phpbb_u_logged  = /#w3all_phpbb_u_logged=1/ig.exec(res);

   if(phpBBuid2 != 2){ // if not phpBB uid 2 or get loop for this user
       if( w3all_phpbb_u_logged == null && wp_u_logged > 1 || wp_u_logged == 0 && w3all_phpbb_u_logged != null ){
        document.location.replace('".$w3allhomeurl."/index.php/".$wp_w3all_forum_folder_wp."/');
       }
    }
      jQuery('#w3idwloader').css(\"display\",\"none\");
      var w3all_phpbbpmcount = /.*(#w3all_phpbbpmcount)=([0-9]+).*/ig.exec(res);
      if(w3all_phpbbpmcount !== null){
         w3all_ajaxup_from_phpbb_do(w3all_phpbbpmcount[2]);
       }

     if(w3scrolldefault == 'yes'){
      var w3all_lochash = /.*(#w3all_lochash)=([0-9]+).*/ig.exec(res);
      if(w3all_lochash !== null && w3all_lochash[2] != 0){
         jQuery('html, body').animate({ scrollTop: w3all_lochash[2]}, 400);
       } else {
          jQuery('html, body').animate({ scrollTop: ".$w3all_iframe_custom_top_gap."}, 400);
         }
     } // if(w3scrolldefault

 } // END w3all_ajaxup_from_phpbb(res){

   // array() of allowed domains

    var w3all_orig_domains = ['".$w3all_orig."','".$w3all_orig_www."','".$w3all_url_to_cms_clean."','".$w3all_url_to_cms_clean0."','https://localhost','http://localhost'];

 iFrameResize({
        log         : false,
        inPageLinks : true,
        targetOrigin: '".$w3all_url_to_cms."',
        checkOrigin : w3all_orig_domains,
     // heightCalculationMethod: 'taggedElement', // If iframe not resize correctly, un-comment (or change with one of others available resize methods)
     // see: https://github.com/davidjbradshaw/iframe-resizer/blob/master/docs/parent_page/options.md

  onMessage : function(messageData){ // Callback fn when message is received
        // w3all simple js check and redirects
        var w3all_passed_url = messageData.message.toString();
        var w3all_ck = \"".$_SERVER['SERVER_NAME']."\";
        var w3all_pass_ext  = (w3all_passed_url.indexOf(w3all_ck) > -1);
        var w3all_ck_preview = (w3all_passed_url.indexOf('preview') > -1);

   if (w3all_ck_preview == false) { // or the phpBB passed preview link, will be recognized as external, and preview will redirect to full forum url instead
    // so these are maybe, external iframe redirects
     if (w3all_pass_ext == true) {
        window.location.replace(w3all_passed_url);
      }
     if (/^(f|ht)tps?:\/\//i.test(w3all_passed_url)) {
       window.location.replace(w3all_passed_url);
     }
   }

  // do not pass to be encoded an url with sid or if it point to phpBB admin ACP via iframe
   if( /[^-0-9A-Za-z\._#\:\?\/=&%]/ig.exec(w3all_passed_url) !== null || /adm\//ig.exec(w3all_passed_url) !== null || /sid=/ig.exec(w3all_passed_url) !== null ){
     w3all_passed_url = '';
   }
  // PUSH phpBB URLs // do not push in home if inhomepage-phpbbiframe set. If not set then page-forum ($wp_w3all_forum_folder_wp value) need to exist
   if(w3all_passed_url != '' && inhomepageShort != 'inhomepage-phpbbiframe' && w3urlpush == 'yes'){
    w3all_passed_url = window.btoa(unescape(encodeURIComponent(w3all_passed_url)));
    var w3all_passed_url_push = '".$w3allhomeurl."/".$wp_w3all_forum_folder_wp."/?".$w3all_iframe_custom_w3fancyurl."=' + w3all_passed_url;
    history.replaceState({w3all_passed_url: w3all_passed_url}, \"\", w3all_passed_url_push);
   }
  } // end // onMessage
,
onScroll: function(x,y){
return false;
}
});
</script>";

echo'</div><!-- END iframe div -->
';