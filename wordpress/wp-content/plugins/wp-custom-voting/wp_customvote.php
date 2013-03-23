<?php  
/* 
Plugin Name: WP Custom Voting
Plugin URI: http://dmitritech.com
Description: This plugin is meant for admin to bring the feature of VOTING to their posts or pages. Admin can set the button label before and after voting both for pages and posts. All votes are IP tracked, so same user can't vote twice for the same post or page buttons. The admin can choose the postion of the votting buttons on top , bottom or both of the page or post. The site visitor can also view the total votes along with the button same as in facebook.  
Author: Binish Prabhakar and Vivek Pillai 
Author URI: http://wordpressnutsandbolts.blogspot.in/
Version: 1.0
*/

// define contastant
define('WP_CUSTOM_VOTE','wp-custom-voting');
define('WP_CUSTOM_VOTE_PATH',plugins_url(WP_CUSTOM_VOTE));
define('SITE_ADMIN_URL',get_admin_url());
	
// add WPCV menu in admin settings
add_action( 'admin_menu', 'wpcv_admin_menu' );
function wpcv_admin_menu() {	
	global $wpdb;
	add_menu_page('Voting Options', 'WP Custom Vote', 'manage_options', 'wp_customvote', 'wpcv_admin', WP_CUSTOM_VOTE_PATH.'/images/icon.png');
}
		
// add admin option
function wpcv_admin(){
	$wpcv_label             = get_option('wpcv_label');
	$wpcv_label_color       = get_option('wpcv_label_color');
	$wpcv_label_voted       = get_option('wpcv_label_voted');
	$wpcv_label_color_voted = get_option('wpcv_label_color_voted');
	$wpcv_pagetop           = get_option('wpcv_pagetop');
	$wpcv_pagebottom        = get_option('wpcv_pagebottom');
	$wpcv_postonly          = get_option('wpcv_postonly');
?>

<div class="wrap">
  <div class="wpcv-icon"><br>
  </div>
  <h2>WP Custom Vote Button</h2>
  <div class="wpcv-left">
    <?php if($_POST['process_wpcv'] == "process") { ?><div class="updated below-h2" id="message"><p>Plugin Options Updated Successfully</p></div><?php } ?>
    <form method="post">
      <input type="hidden" name="process_wpcv" value="process" />
      <div class="metabox-holder" style="width: 100%;float:left;">
        <div class="postbox">
          <h3>WP Custom Vote Button Options:</h3>
          <p>
          <div class="wpcv-textarea">
            <table border="0">
              <tr>
                <td>Vote Button label</td>
                <td>:</td>
                <td><input type="text" value="<?php  echo $wpcv_label; ?>" name="wpcv_label"/></td>
              </tr>
              <tr>
                <td>Voted Button label</td>
                <td>:</td>
                <td><input type="text" value="<?php  echo $wpcv_label_voted; ?>" name="wpcv_label_voted"/></td>
              </tr>
              <tr>
                <td valign="top">Vote label color</td>
                <td valign="top">:</td>
                <td valign="top"><input type="text" value="<?php  echo $wpcv_label_color; ?>" name="wpcv_label_color" class="color" /></td>
              </tr>
              <tr>
                <td valign="top">Voted label color</td>
                <td valign="top">:</td>
                <td valign="top"><input type="text" value="<?php  echo $wpcv_label_color_voted; ?>" name="wpcv_label_color_voted" class="color" /></td>
              </tr>
              <tr>
                <td>Add Button in Posts/Pages Top</td>
                <td>:</td>
                <td><input type="checkbox" name="wpcv_pagetop" value="1" <?php if($wpcv_pagetop) { ?> checked="checked"  <?php } ?> /></td>
              </tr>
              <tr>
                <td>Add Button in Posts/Pages Bottom</td>
                <td>:</td>
                <td><input type="checkbox" name="wpcv_pagebottom" value="1" <?php if($wpcv_pagebottom) { ?> checked="checked"  <?php } ?>  /></td>
              </tr>
              <tr>
                <td>Add Button only in Posts</td>
                <td>:</td>
                <td><input type="checkbox" name="wpcv_postonly" value="1" <?php if($wpcv_postonly) { ?> checked="checked"  <?php } ?>  /></td>
              </tr>
            </table>
          </div>
          </p>
        </div>
      </div>
      <div class="metabox-holder" style="width: 100%;float:left;">
        <div class="postbox">
          <h3>Save Changes:</h3>
          <p>
          <div class="wpcv-textarea">
            <table border="0">
              <tr>
                <td>Save the changes</td>
              </tr>
              <tr>
                <td><input type="submit" value="Save Changes " class="button-primary" name="submit"></td>
              </tr>
            </table>
          </div>
          </p>
        </div>
      </div>
    </form>
  </div>
  <div class="wpcv-right">
    <div class="metabox-holder" style="width: 100%;float:left;">
      <div class="postbox">
        <h3>Developer Info:</h3>
        <p>
        <div class="alert-textarea" style="text-align:center;"><a href="http://dmitritech.com/" target="_blank" title="dmitri tech solution"><img src="<?php echo WP_CUSTOM_VOTE_PATH; ?>/images/dmitri-logo.png" alt="dmitri tech solution" /></a></div>
        </p>
      </div>
    </div>
    <div class="metabox-holder" style="width: 100%;float:left;">
      <div class="postbox">
        <h3>The Wordpress Development Company:</h3>
        <p>
        <div class="alert-textarea" style="text-align:center;"> <a href="http://www.hirewordpressguru.com/" target="_blank" title="Hire Wordpress Guru - A wordpress development Company"><img src="<?php echo WP_CUSTOM_VOTE_PATH; ?>/images/hire-wordpress-guru.jpg" alt="Hire Wordpress Guru" /></a> </div>
        </p>
      </div>
    </div>
    <div class="metabox-holder" style="width: 100%;float:left;">
      <div class="postbox">
        <h3>Join with us:</h3>
        <p>
        <div class="alert-textarea" style="text-align:center;">
          <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fdmitritechs&amp;width=280&amp;height=500&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:500px;" allowTransparency="true"></iframe>
        </div>
        </p>
      </div>
    </div>
  </div>
</div>
<?php 
}

// processing the form
if($_POST['process_wpcv'] == "process") { 
	if($_REQUEST['wpcv_label']){ 
	  update_option('wpcv_label',$_REQUEST['wpcv_label']);
	} 
	
	if($_REQUEST['wpcv_label_voted']){
	  update_option('wpcv_label_voted',$_REQUEST['wpcv_label_voted']);
	} 
	
	if($_REQUEST['wpcv_label_color']){
	   update_option('wpcv_label_color',$_REQUEST['wpcv_label_color']);
	}
	if($_REQUEST['wpcv_label_color_voted']){
	  update_option('wpcv_label_color_voted',$_REQUEST['wpcv_label_color_voted']);
	}
	
	if($_REQUEST['wpcv_pagetop']){
	  update_option('wpcv_pagetop',$_REQUEST['wpcv_pagetop']);
	}else{
	 update_option('wpcv_pagetop',0);
     }
	 
	if($_REQUEST['wpcv_pagebottom']) {
	  update_option('wpcv_pagebottom',$_REQUEST['wpcv_pagebottom']);
	}else{ 
	  update_option('wpcv_pagebottom',0); 
    }
	
	if($_REQUEST['wpcv_postonly']){ 
	  update_option('wpcv_postonly',$_REQUEST['wpcv_postonly']);
	  $ok=true;
    }else{ 
	  update_option('wpcv_postonly',0); 
	  $ok=true;
	}
} 

//add admin script
add_action('wp_print_scripts', 'wpcv_admin_script');
function wpcv_admin_script(){
	if(is_admin() && $_GET['page'] == 'wp_customvote'){
		wp_enqueue_script("jquery");			
		wp_enqueue_script('wp-color-picker');
		wp_register_script('wpcv-admin-script',WP_CUSTOM_VOTE_PATH.'/js/admin-script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('wpcv-admin-script');
	}
}

// add admin style
add_action('admin_print_styles', 'wpcv_admin_css');
function wpcv_admin_css(){
	wp_register_style('wpcv-admin-style', WP_CUSTOM_VOTE_PATH .'/css/admin-style.css');
	wp_enqueue_style('wpcv-admin-style');
	
	wp_enqueue_style('wp-color-picker');
}		
		
// add jquery script in head tag
add_action('wp_head', 'wpcv_script');	
function wpcv_script(){
	    wp_enqueue_script('jquery');
		
		wp_register_script('wpcv-admin-script-user',WP_CUSTOM_VOTE_PATH.'/js/script.js', array('jquery'));
		wp_localize_script('wpcv-admin-script-user', 'WPCVajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		wp_enqueue_script('wpcv-admin-script-user');	
} 	


//add script at footer
add_action('wp_footer', 'wpcv_script_footer');	
function wpcv_script_footer (){
    if(get_option('wpcv_label_voted')!=''){
		$label_voted= get_option('wpcv_label_voted');
	}else{
		$label_voted= 'Voted';
    }
	
	if(get_option('wpcv_label_color')!=''){
		$label_color= get_option('wpcv_label_color');
	}else{
		$label_color=  '#fff';
	}
	
	if(get_option('wpcv_label_color_voted')!=''){
		$label_color_voted= get_option('wpcv_label_color_voted');
	}else{
		$label_color_voted= '#fff';
	}
?>
<style type="text/javascript">
	 .wpcvbutton a {
	   color: #<?php echo $label_color; ?> !important;
	 }
	 .wpcvbutton span.wpcvbuttonvoted {
		color: #<?php echo $label_color_voted; ?> !important;
	 }
    </style>
<?php 
}
		
// add plugin style to site
add_action( 'wp_enqueue_scripts', 'wpcv_styles' );
function wpcv_styles(){
	wp_register_style( 'wpcv-custom-style', WP_CUSTOM_VOTE_PATH .'/css/style.css');
	wp_enqueue_style( 'wpcv-custom-style' );  
}

// put button in content 
add_filter('the_content', 'wpcv_content_formatting');
function wpcv_content_formatting($content){
	if(get_option('wpcv_label')!=''){
		$label= get_option('wpcv_label');
	}else{
		$label= 'Vote It';
	}
	
	if(get_option('wpcv_label_voted')!=''){
		$label_voted= get_option('wpcv_label_voted');
	}else{ 
		$label_voted= 'Voted';
	}	
		
	$wpcv_pagetop    = get_option('wpcv_pagetop');
	$wpcv_pagebottom = get_option('wpcv_pagebottom');
	$wpcv_postonly   = get_option('wpcv_postonly');
	
	global $post;
	$ip = $_SERVER['REMOTE_ADDR']; 
	$id = $post->ID;
		
	$end_of_tut      = '<div style="width: 100%; float: left;">';
	$currentwpcvotes = get_post_meta($id, 'wpcvotes', true);
	$wpcvoters       = get_post_meta($id, 'wpcvoters', true);
	$wpcvoters       = explode(",", $wpcvoters);
	
	foreach($wpcvoters as $wpcvoter) {
		if($wpcvoter == $ip){
			 $wpc_alreadyVoted = true;
		}
	}
	
	if(!$currentwpcvotes){
	  $currentwpcvotes = 0;
	}
	
	$end_of_tut.='<div class="wpcvbutton wpcvbutton'.$id.'"><span>'.$currentwpcvotes.'</span>';
	
	if($ip && !$wpc_alreadyVoted){
	   $end_of_tut.= '<a post="'.$id.'" user="'.$ip.'">'.$label.'</a>';
	}
	
	if($ip && $wpc_alreadyVoted){
	  $end_of_tut.= '<span class="wpcvbuttonvoted">'.$label_voted.'</span>';
	}
	
	$end_of_tut.='</div>';
	
	$end_of_tut.='</div>';
	
	if($wpcv_pagetop && $wpcv_pagebottom){
		$wpcv_content = $end_of_tut.$content.$end_of_tut;
	}elseif($wpcv_pagetop){
		$wpcv_content = $end_of_tut.$content;
	}elseif($wpcv_pagebottom){
		$wpcv_content = $content.$end_of_tut;
	}else{
	    $wpcv_content = $content;
	}
	
	if($wpcv_postonly){
		if(get_post_type( $id ) == 'post'){
			return $wpcv_content;
		}else{
			return $content;
		}
	}else{
	   return $wpcv_content;
	}
}

// creating Ajax call for WordPress  
add_action( 'wp_ajax_nopriv_ProcessWPCV', 'ProcessWPCV' );  
add_action( 'wp_ajax_ProcessWPCV', 'ProcessWPCV' );  
function ProcessWPCV(){
	header('Content-type: application/json');
	
	$ip           = $_SERVER['REMOTE_ADDR']; 
	$currentvotes = get_post_meta($_POST['post'], 'wpcvotes', true);
	$currentvotes = $currentvotes + 1;
	
	$voters = get_post_meta($_POST['post'], 'wpcvoters', true);
	if(!$voters) $voters = $ip; else $voters = $voters.",".$ip;
	
	update_post_meta($_POST['post'], 'wpcvotes', $currentvotes);
	update_post_meta($_POST['post'], 'wpcvoters', $voters);
	
	$arr = array("vote" => $currentvotes,'label' => get_option('wpcv_label_voted'));
	echo json_encode($arr);
	die();
}
?>
