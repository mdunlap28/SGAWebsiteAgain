<?php

new add_links_to_pages;

class add_links_to_pages{


	function add_links_to_pages(){
		$this->__construct();
	}
	
	function __construct(){ 
	
		if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php')) {
		
			if (function_exists('wp_enqueue_script')) {
				wp_enqueue_script( 'ALTP_js', ALTP_url.'/js/altp.js', '', 1.0  );
			}

		}	
		
		add_action( 'admin_init', array( &$this, 'add_links_to_pages_add_meta_boxes' ) );
		add_action( 'save_post', array( &$this, 'add_links_to_pages_meta_box_save_data' ), 1, 2 );
		add_action( 'widgets_init', create_function('', 'return register_widget("altp_Widget");') );
	
	}	

	function add_links_to_pages_add_meta_boxes() {
	
	    add_meta_box( 
	        'add_links_to_pages_meta_box',
	        __( 'Add links'),
	        array( &$this, 'add_links_to_pages_meta_box' ),
	        'page' ,
	        'side',
	        'high'
	    );	
	    
	    add_meta_box( 
	        'add_links_to_pages_meta_box',
	        __( 'Add links'),
	        array( &$this, 'add_links_to_pages_meta_box' ),
	        'post' ,
	        'side',
	        'high'
	    );		    	
	
	}
	
	function add_links_to_pages_meta_box(){
	
		global $post; ?>
		
		<style type="text/css">
			#add_links_to_pages_meta_box label, #add_links_to_pages_meta_box select{
   	 			clear: both;
			    float: left;
			    font-size: 12px;
			    margin: 5px 0 7px;
			    width: 100%;				
			}
			#add_links_to_pages_meta_box .inside p{
				font-size: 10px;
			}
			#add_links_to_pages_meta_box .altp_remove{
				height: 16px;
				width:16px;
				background: url('<?php echo ALTP_url . '/img/delete.png'; ?>') no-repeat transparent;
				float:left;
				margin-right: 10px;
				cursor: pointer;
			}
			#add_links_to_pages_meta_box .altp_link_container{
				float:left;
				clear:left;
				width:100%;
				margin: 10px 0 0;
			}
		</style>	
		
		<label>Link URL</label>
		<input type='text' id='altp_url' size='20' value="http://"/>	
		<p>The url of the destination link.</p>				
		
		<label>Open in new window?</label>
		<select id="altp_window">
			<option value="_blank" >true</option>
			<option value="" >false</option>
		</select>		
		<p>Whether or not to have the link open in a new window/tab when clicked.</p>
		
		<label>Link Name</label>
		<input type='text' id='altp_name' size='15' value=""/>	
		<p>The text displayed to the visitor.</p>	
		
		<label>Link Description</label>
		<textarea style="width:100%;" rows="3" id="altp_desc"></textarea>
		<p>Add an optional description for the link.</p>	
		
		<input type="button" class="button" value="Add link" onClick="addLink();" />
		
		<br style="clear:both">		
		
		<div id="altp_links"><?php echo html_entity_decode( get_post_meta($post->ID, 'altp_links_html', true) ); ?></div>	
		
		<input type="hidden" name="altp_links_html" id="altp_links_html" value="<?php echo get_post_meta($post->ID, 'altp_links_html', true); ?>"/>
		
		<script>addRemoveDiv();</script>
		
		<br style="clear:both">	
		
	<?php }
	
	function add_links_to_pages_meta_box_save_data( $post_id ){
	
		
		// verify if this is an auto save routine. 
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		
		//$altp_meta_data['altp_links_html'] = $_POST['altp_links_html'] ;
				
	    add_post_meta($post_id, "altp_links_html", htmlentities( $_POST['altp_links_html'] ), true); update_post_meta($post_id, "altp_links_html", htmlentities( $_POST['altp_links_html'] ));	
	
	}
	
}

class altp_Widget extends WP_Widget {
    
    function altp_Widget() {
    	$widget_ops = array('classname' => 'altp_widget', 'description' => 'Display the links you have added to a page.' );
    	$this->WP_Widget('altp_widget', 'Add links to page', $widget_ops);
    }
    function widget($args, $instance) {
    	global $post;
    	if(get_post_meta($post->ID, 'altp_links_html', true) != ''){
	    	extract($args, EXTR_SKIP);
	    	echo $before_widget;
	    	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	    	if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
	    	echo html_entity_decode( get_post_meta($post->ID, 'altp_links_html', true) );
	    	echo $after_widget;
    	}
    }
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	$instance['title'] = strip_tags($new_instance['title']);
    	return $instance;
    }
    function form($instance) {
    	$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    	$title = strip_tags($instance['title']);
    	?>
    	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
    	<?php
    }
}

//register_widget('altp_Widget');

?>