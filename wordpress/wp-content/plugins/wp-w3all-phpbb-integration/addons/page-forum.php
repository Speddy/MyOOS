<?php 
/*
 Template Name: Forum
 Template Post Type: page
 * The default template to display content for WP_w3all embedded phpBB
 * @package WordPress
 * @subpackage wp_w3all
 * @V5 JS -> https://www.axew3.com/w3/2018/12/phpbb-wordpress-template-integration-iframe-v5/
 */
// axew3.com //

// START MAY DO NOT MODIFY

// for compatibility with all the rest if the case switch these vars
if( isset($_GET["f"]) ){
	$_GET["forum_id"] = $_GET["f"];
}
if( isset($_GET["t"]) ){
	$_GET["topic_id"] = $_GET["t"];
}

$w3forum_id = isset($_GET["forum_id"]) ? $_GET["forum_id"] : '';
$w3topic_id = isset($_GET["topic_id"]) ? $_GET["topic_id"] : ''; 
$w3post_id  = isset($_GET["post_id"]) ? $_GET["post_id"] : ''; // p reserved // may used for htaccess "strong" and consistent, V1 code redirect trick
$w3mode     = isset($_GET["mode"]) ? $_GET["mode"] : '';
$w3phpbbuid = isset($_GET["u"]) ? $_GET["u"] : '';
$w3phpbbsid = isset($_GET["sid"]) ? $_GET["sid"] : '';
$w3phpbbwatch = isset($_GET["watch"]) ? $_GET["watch"] : '';
$w3phpbbunwatch = isset($_GET["unwatch"]) ? $_GET["unwatch"] : '';
$w3phpbb_start  = isset($_GET["start"]) ? $_GET["start"] : '';
$w3iu = isset($_GET["i"]) ? $_GET["i"] : ''; 
$w3iu_folder = isset($_GET["folder"]) ? $_GET["folder"] : '';

global $w3all_iframe_custom_w3fancyurl,$w3all_url_to_cms,$w3all_iframe_phpbb_link_yn,$w3all_iframe_custom_top_gap,$w3cookie_domain,$wp_w3all_forum_folder_wp;
$w3allhomeurl = get_home_url();
$current_user = wp_get_current_user();
$w3all_url_to_cms_clean = $w3all_url_to_cms;
$w3all_url_to_cms_clean0 = strpos($w3all_url_to_cms_clean, 'https://') !== false ? str_replace('https://', 'http://', $w3all_url_to_cms_clean) : str_replace('http://', 'https://', $w3all_url_to_cms_clean);

if( preg_match('/[^0-9]/',$w3phpbbuid) OR preg_match('/[^a-z]/',$w3phpbbwatch) OR preg_match('/[^a-z]/',$w3phpbbunwatch) OR preg_match('/[^A-Za-z]/',$w3iu_folder) OR preg_match('/[^A-Za-z]/',$w3iu) OR preg_match('/[^0-9]/',$w3phpbb_start) OR preg_match('/[^0-9]/',$w3topic_id) OR preg_match('/[^0-9]/',$w3forum_id) OR preg_match('/[^0-9]/',$w3post_id) OR preg_match('/[^0-9A-Za-z]/',$w3mode) OR preg_match('/[^0-9A-Za-z]/',$w3phpbbsid) ){

	die("Something goes wrong with your URL request, <a href=\"$w3allhomeurl\">please leave this page</a>.");
}

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

// build and pass links x iframe //
// Old way: from 1.9.4 substantially execute only when links from widgets
if ( !empty($w3forum_id) && empty($w3topic_id) && empty($w3phpbb_start) && empty($w3post_id) ){
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewforum.php?f=". $w3forum_id ."";
} elseif ( !empty($w3forum_id) && !empty($w3phpbb_start) && empty($w3topic_id) ) {
	   $w3all_url_to_cms = $w3all_url_to_cms . "/viewforum.php?f=". $w3forum_id ."&amp;start=".$w3phpbb_start."";
} elseif ( !empty($w3forum_id) && !empty($w3topic_id) && empty($w3post_id) && empty($w3phpbb_start) ) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewtopic.php?f=". $w3forum_id ."&amp;t=".$w3topic_id."";
} elseif ( !empty($w3forum_id) && !empty($w3topic_id) && !empty($w3post_id) ) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewtopic.php?f=". $w3forum_id ."&amp;t=".$w3topic_id."&amp;p=".$w3post_id."#p".$w3post_id."";
} elseif ( !empty($w3forum_id) && empty($w3topic_id) && !empty($w3post_id) ) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewtopic.php?f=". $w3forum_id ."&amp;p=".$w3post_id."#p".$w3post_id."";
} elseif ( !empty($w3forum_id) && !empty($w3topic_id) && !empty($w3phpbb_start) ) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewtopic.php?f=". $w3forum_id ."&amp;t=".$w3topic_id."&amp;start=".$w3phpbb_start."";
} elseif ( empty($w3forum_id) && !empty($w3post_id) && empty($w3iu) ) { 
    $w3all_url_to_cms = $w3all_url_to_cms . "/viewtopic.php?p=".$w3post_id."#p".$w3post_id."";
} elseif (stristr($w3mode, "ucp")) { // custom to ucp 
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php";
} elseif (stristr($w3mode, "register")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?mode=register";
} elseif (stristr($w3mode, "sendpassword")) {
   $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?mode=sendpassword";
} elseif (stristr($w3mode, "login")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?mode=login";
} elseif (stristr($w3mode, "logout")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?mode=logout&amp;sid=". $w3phpbbsid ."";
} elseif (stristr($w3mode, "memberlist")) { // custom to memberlist 
    $w3all_url_to_cms = $w3all_url_to_cms . "/memberlist.php";
} elseif (stristr($w3mode, "viewprofile")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/memberlist.php?mode=viewprofile&amp;u=". $w3phpbbuid ."";
} elseif (stristr($w3mode, "contactadmin")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/memberlist.php?mode=contactadmin";
} elseif (stristr($w3mode, "team")) {
    $w3all_url_to_cms = $w3all_url_to_cms . "/memberlist.php?mode=team";
} elseif (stristr($w3iu, "pm") && $w3iu_folder == 'inbox') {
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?i=pm&folder=inbox";
} elseif (stristr($w3mode, "view") && $w3iu == 'pm') { 
    $w3all_url_to_cms = $w3all_url_to_cms . "/ucp.php?i=pm&mode=view&f=0&p=".$w3post_id."";
} else {
	// nothing 
}

// security switch
$w3all_url_to_cms0 = $w3all_url_to_cms;

if( isset($_GET["w3"]) && empty($w3forum_id) ){ // default
 $phpbb_url = trim(base64_decode($_GET["w3"]));
 $w3all_url_to_cms = $w3all_url_to_cms . '/' . $phpbb_url;
	 if( preg_match('/[^-0-9A-Za-z\._#\:\?\/=&%]/ui',$phpbb_url) ){
    $w3all_url_to_cms = $w3all_url_to_cms0;
   }
} elseif ( isset($_GET[$w3all_iframe_custom_w3fancyurl]) && empty($w3forum_id) ){ //fancy
 $phpbb_url = trim(base64_decode($_GET[$w3all_iframe_custom_w3fancyurl]));
 $w3all_url_to_cms = $w3all_url_to_cms . '/' . $phpbb_url;
	 if( preg_match('/[^-0-9A-Za-z\._#\:\?\/=&%]/ui',$phpbb_url) ){
    $w3all_url_to_cms = $w3all_url_to_cms0;
   }
}

// assure that passed url is correctly all decoded // may something else need to added in certain conditions
$w3all_url_to_cms = str_replace(array("%2F", "%23", "%2E"), array("/", "#", "."), $w3all_url_to_cms);

// bug -> https://wordpress.org/support/topic/problem-using-iframe-feature-with-https/
if( strlen($w3all_url_to_cms) == strlen(get_option( 'w3all_url_to_cms' )) OR strlen($w3all_url_to_cms) == strlen(get_option( 'w3all_url_to_cms' )) + 1 )
{
 $w3all_url_to_cms .= (substr($w3all_url_to_cms, -1) == '/' ? '' : '/index.php');
}

function w3all_enqueue_scripts() { 
 wp_enqueue_script("jquery");
}

function wp_w3all_add_ajax() {
	global $w3all_url_to_cms, $wp_w3all_forum_folder_wp,$w3all_iframe_phpbb_link_yn, $w3allhomeurl;
	
	if ($w3all_iframe_phpbb_link_yn > 0){
		$w3all_url_to_phpbb_ib = $w3allhomeurl . "/" . $wp_w3all_forum_folder_wp . "/?i=pm&folder=inbox";
	} else {
	        $w3all_url_to_phpbb_ib = $w3all_url_to_cms . "/ucp.php?i=pm&folder=inbox";
         }
 
$s = "<script type=\"text/javascript\" src=\"".plugins_url()."/wp-w3all-phpbb-integration/addons/resizer/iframeResizer.min.js\"></script>
<script type=\"text/javascript\">
// pre loader js code for iframe content 
jQuery( document ).ready(function() {
 jQuery('#w3_toogle_wrap_loader').attr( \"class\", \"w3_wrap_loader\" );
});
jQuery(window).load(function() {
 jQuery('#w3_toogle_wrap_loader').attr( \"class\", \"w3_no_wrap_loader\" );
});
function w3all_ajaxup_from_phpbb_do(res){
jQuery(document).ready(function($) {
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

var boardU = '".get_option( 'w3all_url_to_cms' )."';
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
.w3_no_wrap_loader{
display:none;
}
.w3_wrap_loader{
position:fixed;
top:0%;
bottom:0%;
left:0%;
right:0%;
background: rgba(0,0,0,1);
z-index: 99999;
opacity:90;
-webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
width:100%;
display:flex;
align-items: center;
text-align:center;
pointer-events: none;
}
.w3_loader {
height: 8px;
width: 30%;
position: relative; left: 50%;
transform: translateX(-50%);
overflow: hidden;
background-color: #ddd;
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
background-color: #2980b9;
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
</style>";
	echo $s;
}

 function w3all_wp_fpfooter() {
    echo"
    <script> 
    jQuery('#w3_toogle_wrap_loader').addClass('w3_no_wrap_loader').removeClass('w3_wrap_loader');
    </script>
    ";
  } 

add_action('wp_head','wp_w3all_add_ajax');
add_action('wp_enqueue_scripts', 'w3all_enqueue_scripts');
add_action('wp_footer', 'w3all_wp_fpfooter', 100);
// END MAY DO NOT MODIFY

// START a default WordPress page

get_header(); 
?>
 
<!-- START iframe div -->
<div id="w3_toogle_wrap_loader" class="w3_no_wrap_loader"><div class="w3_loader"></div></div>
<div class="">
<noscript><h3>It seem that your browser have Javascript disabled: you can't load the forum page at this Url. Please enable Javascript on your browser or <a href="<?php echo $w3all_url_to_cms;?>">visit the forum here</a>.<br /><br /></h3></noscript>
<iframe id="w3all_phpbb_iframe" style="width:1px;min-width:100%;*width:100%;border:0;" scrolling="no" src="<?php echo $w3all_url_to_cms; ?>"></iframe>
<?php
		echo "<script type=\"text/javascript\">
		document.domain = '".$document_domain."'; // NOTE: for domains like 'mysite.co.uk' remove this line, if you setup the next to match the correct document.domain
		// document.domain = 'mydomain.com'; // NOTE: reset/setup this with domain (like mysite.co.uk) if js error when WP is installed like on mysite.domain.com and phpBB on domain.com: js origin error can come out for example when WordPress is on subdomain install and phpBB on domain. The origin fix is needed: (do this also on phpBB overall_footer.html added code, it need to match)
    var wp_u_logged = ".$current_user->ID.";
		
 function w3all_ajaxup_from_phpbb(res){
			var w3all_phpbb_u_logged  = /#w3all_phpbb_u_logged=1/ig.exec(res);
			var w3phpbb_uid = res.split('#w3all_uidck=');
			
			
	// if( w3phpbb_uid[1] != 2 && wp_u_logged != 1 ){
	// to be removed: leaved for those that do not update overall_footer.html js
	 if( wp_u_logged != 1 && typeof w3phpbb_uid[1] != 'undefined' && w3phpbb_uid[1] != 2 ){ // exclude default phpBB install admin id2 not linked, or get loop with id1 wp on page-forum

			 if( w3all_phpbb_u_logged == null && wp_u_logged > 0 || wp_u_logged == 0 && res.indexOf('#w3all_phpbb_u_logged=1') > -1 ){
			 document.location.replace('".$w3allhomeurl."/index.php/".$wp_w3all_forum_folder_wp."/');
       }
       if(wp_u_logged == 0 && res.indexOf('#w3all_phpbb_u_logged=1') > -1){
       document.location.replace('".$w3allhomeurl."/index.php/".$wp_w3all_forum_folder_wp."/');
       } 
       
    }
    
    // to be removed // for the not fixed overall_footer js code with last added uid var
    if( typeof w3phpbb_uid[1] == 'undefined' ){ 

			 if( w3all_phpbb_u_logged == null && wp_u_logged > 0 || wp_u_logged == 0 && res.indexOf('#w3all_phpbb_u_logged=1') > -1 ){
			 document.location.replace('".$w3allhomeurl."/index.php/".$wp_w3all_forum_folder_wp."/');
       }
       if(wp_u_logged == 0 && res.indexOf('#w3all_phpbb_u_logged=1') > -1){
       document.location.replace('".$w3allhomeurl."/index.php/".$wp_w3all_forum_folder_wp."/');
       } 
       
    }
    
    

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
//,
//scrollCallback: function(x,y){
//return false;
//}
});

 jQuery( window ).load(function() { // wrapped here, or won't push correctly 
  jQuery('#w3_toogle_wrap_loader').css({'display':'none'});
  //var w3all_landed_url = '".$w3all_url_to_cms."';
  //var w3all_landed_url_clean = w3allNormalize_phpBBUrl_onParent(w3all_landed_url);
  // PUSH phpBB URL when wp page land and load first time //
  //var w3all_passedurl = window.btoa(unescape(encodeURIComponent(w3all_landed_url_clean)));
  //var w3all_passedurl_push = '".$w3allhomeurl."/".$wp_w3all_forum_folder_wp."/?".$w3all_iframe_custom_w3fancyurl."=' + w3all_passedurl;
  //history.replaceState({w3all_passedurl: w3all_passedurl_push}, \"\", w3all_passedurl_push);
 })
</script>";
?>
</div>
<!-- END iframe div -->
<?php get_footer(); ?>