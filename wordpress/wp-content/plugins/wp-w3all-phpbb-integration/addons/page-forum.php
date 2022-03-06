<?php defined( 'ABSPATH' ) or die( 'forbidden' );
/*
 Template Name: Forum
 Template Post Type: page
 * The default template to display content for WP_w3all embedded phpBB
 * @package WordPress
 * @subpackage wp_w3all
 * @V5 JS -> https://www.axew3.com/w3/2018/12/phpbb-wordpress-template-integration-iframe-v5/
 */
// @2022 axew3.com //

// START MAY DO NOT MODIFY

  if(defined("W3PHPBBCONFIG")){
    // detect if it is the uid2 in phpBB and avoid iframe loop
    $phpBBuid2 = (isset($_COOKIE[W3PHPBBCONFIG["cookie_name"].'_u']) && $_COOKIE[W3PHPBBCONFIG["cookie_name"].'_u'] == 2) ? 2 : 0;
   } else { $phpBBuid2 = 0; }
   // detect if running as not linked users mode and avoid iframe loop
  if(defined("WPW3ALL_NOT_ULINKED")) { $phpBBuid2 = 2; } // switch to be like it is uid2, so to avoid the reload of the page loop

global $w3all_iframe_custom_w3fancyurl,$w3all_url_to_cms,$w3all_iframe_custom_top_gap,$w3cookie_domain,$wp_w3all_forum_folder_wp;
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

// assure that passed url is correctly all decoded // may something else need to be added in certain conditions
$w3all_url_to_cms = str_replace(array("%2F", "%23", "%2E"), array("/", "#", "."), $w3all_url_to_cms);

function w3all_enqueue_scripts() {
 wp_enqueue_script("jquery");
}

function wp_w3all_add_ajax() {
  global $w3all_url_to_cms,$wp_w3all_forum_folder_wp,$w3allhomeurl;

  $w3all_url_to_phpbb_ib = $w3all_url_to_cms . "/ucp.php?i=pm&folder=inbox";

$s = "
<script type=\"text/javascript\" src=\"".plugins_url()."/wp-w3all-phpbb-integration/addons/resizer/iframeResizer.min.js\"></script>
<script type=\"text/javascript\">
// pre loader js code for iframe content
//jQuery( document ).ready(function() {
 //jQuery('#w3idwloader').attr( \"class\", \"w3_wrap_loader\" );
//});
jQuery(window).load(function() {
 jQuery('#w3idwloader').css(\"display\",\"none\");
});

function w3all_ajaxup_from_phpbb_do(res){
jQuery(document).ready(function() {
if ( parseInt(res,10) > 0 && null == (document.getElementById('wp-admin-bar-w3all_phpbb_pm')) ){
var resp = '".__( 'You have ', 'wp-w3all-phpbb-integration' )."' + parseInt(res,10) + '".__( ' unread forum PM', 'wp-w3all-phpbb-integration' )."';
 jQuery('#wp-admin-bar-root-default').append('<li id=\"wp-admin-bar-w3all_phpbb_pm\"><a class=\"ab-item\" href=\"".$w3all_url_to_phpbb_ib."\">' + resp + '</li>');
 // window.location.reload(true);// this could be a work around for different themes, but lead to loop in this way
} else if (parseInt(res,10) > 0){
  var r = '".__( 'You have ', 'wp-w3all-phpbb-integration' )."' + parseInt(res,10) + '".__( ' unread forum PM', 'wp-w3all-phpbb-integration' )."';
  jQuery( 'li.w3all_phpbb_pmn' ).children().text( r );
} else {
 if( parseInt(res,10) == 0 && null !== (document.getElementById('wp-admin-bar-w3all_phpbb_pm'))){
  jQuery('li[id=wp-admin-bar-w3all_phpbb_pm]').remove();
 }
}
});
}

function w3allNormalize_phpBBUrl_onParent(href){
// try to 'normalize' passed relative links: needed all after last slash /
// exception are kind of passed urls like: /phpbb323/app.php/help/faq
// and if SEO mods that may assign some different kind of links values
// by the way, SEO absolute urls http(s) should be (all?) already considered here ...

var boardU = '".$w3all_url_to_cms."';
var phpbbRUrl = href.split(/^.+?(\w+.+)$/);
if( href.indexOf('app.php') > -1 ){ // since the previous not 'normalize' this type of passed value (and may miss something else)
   phpbburl = href.split(/^.+?(app\.php.+)$/);
   w3allappend = phpbburl[1];
 } else if ( /^https?/ig.exec(href) !== null ){ // absolute http(s) passed: try to 'normalize' a possible seo mod
   phpbburl = href.split(boardU);
   w3allappend = phpbburl[1];
 } else if ( phpbbRUrl[1] && phpbbRUrl[1].length > 1 ){ // 'normalize' any other
   w3allappend = phpbbRUrl[1];
 } else if ( phpbbRUrl[0].length > 1 ){
   w3allappend = phpbbRUrl[0];
   }
// ... if still not normalized
if(/^\W/ig.exec(w3allappend) !== null){
  w3allappend = w3allappend.split(/^.+?(\w+.+)$/);
  if(w3allappend[1]){
    w3allappend = w3allappend[1];
  }
  if ( w3allappend[1] && w3allappend[1].charAt(0) == '/' ){
    w3allappend = w3allappend[1].substr(1);
  }
}
return w3allappend;
}
</script>
<style type=\"text/css\" media=\"screen\">
.w3preloadtext{
color:#DDD;
font-size:3.5em;
font-family:impact,arial, sans-serif;
font-style:italic;
text-shadow: rgba(0,0,0,0) -1px 0px;
}
.w3_wrap_loader{
position:fixed;
top:0%;
bottom:0%;
left:0%;
right:0%;
background: rgba(0,0,0,0.95);
z-index:99999;
opacity:90;
-webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
width:100%;
text-align:center;
display:flex;
flex-direction:column;
align-items:center;
justify-content:center;
pointer-events:none;
height:100%;
}
.ww3_loader{
width:100%;
text-align:center;
}
.w3_loader {
height: 8px;
width: 30%;
align-items: center;
justify-content: center;
position: relative; left: 50%;
transform: translateX(-50%);
overflow: hidden;
background-color: #DDD;
border-radius: 20px;
margin:0px;padding:0px;
}
.w3_loader:before{
height: 8px;
border-radius: 20px;
display: block;
position: absolute;
content: \"\";
left: -200px;
width: 200px;
background-color: #333;
animation: loading 1s linear infinite;
}
@keyframes loading {
from {left: -200px; width: 30%;}
50% {width: 30%;}
70% {width: 70%;}
80% { left: 50%;}
95% {left: 120%;}
to {left: 100%;}
}
</style>
";
  echo $s;
}

add_action('wp_enqueue_scripts', 'w3all_enqueue_scripts');
add_action('wp_head','wp_w3all_add_ajax');

// END MAY DO NOT MODIFY

// START a default WordPress page
get_header();
?>

<!-- noscript warning and simple preloader -->
<div id="w3idwloader" class="w3_wrap_loader">
  <noscript><h3 style="background-color:#333;color:#FFF;padding:15px;font-size:0.8em;pointer-events:auto;">Javascript disabled: can't load the forum page at this Url.<br />Enable Javascript on your browser or visit the forum here:<br /><br /><?php echo $w3all_url_to_cms;?><br /><a href="<?php echo $w3all_url_to_cms;?>">To be auto-redirected click here<br />(may this link will not work)</a></h3></noscript>
<div class="w3preloadtext"><?php echo $w3guessdomaindisplay ; ?></div>
<div class="ww3_loader"><div class="w3_loader"></div></div>
</div>
<!-- START iframe div -->
<div id="" class="">
<iframe id="w3all_phpbb_iframe" style="width:1px;min-width:100%;*width:100%;border:0;" scrolling="no" src="<?php echo $w3all_url_to_cms; ?>"></iframe>
<?php
    echo "<script type=\"text/javascript\">
    document.domain = '".$document_domain."'; // NOTE: for domains like 'mysite.co.uk' remove this line, if you setup the next to match the correct document.domain
    // document.domain = 'mydomain.com'; // NOTE: reset/setup this with domain (like mysite.co.uk) if js error when WP is installed like on mysite.domain.com and phpBB on domain.com: js origin error can come out for example when WordPress is on subdomain install and phpBB on domain. The origin fix is needed: (do this also on phpBB overall_footer.html added code, it need to match)
    var wp_u_logged = ".$current_user->ID.";
    var phpBBuid2 = ".$phpBBuid2.";

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

      var w3all_lochash = /.*(#w3all_lochash)=([0-9]+).*/ig.exec(res);
      if(w3all_lochash !== null && w3all_lochash[2] != 0){
         jQuery('html, body').animate({ scrollTop: w3all_lochash[2]}, 400);
       } else {
         jQuery('html, body').animate({ scrollTop: ".$w3all_iframe_custom_top_gap."}, 400);
       }

 } // END w3all_ajaxup_from_phpbb(res){

   // array() of allowed domains

    var w3all_orig_domains = ['".$w3all_orig."','".$w3all_orig_www."','".$w3all_url_to_cms_clean."','".$w3all_url_to_cms_clean0."','https://localhost','http://localhost'];

 iFrameResize({
        log         : false,
        inPageLinks : true,
        targetOrigin: '".$w3all_url_to_cms."',
        checkOrigin : w3all_orig_domains,
     // heightCalculationMethod: 'documentElementOffset', // If iframe not resize correctly, un-comment (or change with one of others available resize methods)
     // see: https://github.com/davidjbradshaw/iframe-resizer#heightcalculationmethod

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
  // PUSH phpBB URLs //
   if(w3all_passed_url != ''){
    w3all_passed_url = window.btoa(unescape(encodeURIComponent(w3all_passed_url)));
    var w3all_passed_url_push = '".$w3allhomeurl."/".$wp_w3all_forum_folder_wp."/?".$w3all_iframe_custom_w3fancyurl."=' + w3all_passed_url;
    history.replaceState({w3all_passed_url: w3all_passed_url}, \"\", w3all_passed_url_push);
   }
  } // end // onMessage
,
scrollCallback: function(x,y){
return false;
}
});
</script>";
?>
</div>
<!-- END iframe div -->
<?php get_footer(); ?>
