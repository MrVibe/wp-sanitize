<?php
/**
 *  Admin Area of WP Sanitize
 *
 * @author 		VibeThemes
 * @category 	Admin
 * @package 	WP Sanitize
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class wp_sanitize_admin{

	var $version = '1.0';
	var $defaults;
	function __construct(){
		$this->init();
		add_option('wpsanitize', $defaults, '', 'yes');
		add_action( 'admin_menu',array($this, 'wp_sanitize_options'));
		add_action('admin_init',array($this,'setting'));
	}

	function init(){
		$defaults = array(
		    'rds_link'          => 1,
		    'wlwmanifest_link'  => 1,
		    'wp_generator'      => 1,
		    'rds_link'          => 1,
		    'wptexturize'       => 1,
		    'wp_filter_kses'    => 1
		);
	}
	function setting(){
		register_setting( 'wps_options', 'wpsanitize');
	}
	function wp_sanitize_options () {
		add_options_page( __( 'WP Sanitize' ), __( 'WP Sanitize' ), 'manage_options', 'wp_sanitize', array($this,'options_page'));
	}

	function get(){
		$this->option = get_option('wpsanitize');
	}

	function tabs(){
		$tabs = array(
			'general' => __('General','wp-sanitize'),
			'protection' => __('Protection','wp-sanitize'),
			'spam' => __('Spam','wp-sanitize'),
			'security'=> __('Security','wp-sanitize'),
			'credits'=>__('Credits','wp-sanitize')
			);
		$current = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
	    echo '<div id="icon-themes" class="icon32"><br></div>';
	    echo '<h2 class="nav-tab-wrapper">';
	    foreach( $tabs as $tab => $name ){
	        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
	        echo "<a class='nav-tab$class' href='?page=wp_sanitize&tab=$tab'>$name</a>";

	    }
	    echo '</h2>';
	    if(isset($_POST['save'])){
	    	$this->save();
	    }
	}
	function options_page(){
		$this->tabs();
		$current = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
		include_once 'views/'.$current.'.php';
	}

	function save(){
		print_r($_POST);
	}
	function execute(){

		// Reset to defaults
		if (isset($_POST['reset-wpsanitize'])) {
		    update_option('wpsanitize', $this->defaults);
		    $this->msg =  '<div class="updated" id="message"><p><strong>Settings Reset to Default</strong></p></div>';
		}
		if (isset($_POST['wps-optimizedb'])) {
		    wps_optimize_database ();
		    $this->msg =  '<div class="updated" id="message"><p><strong>Database Optimized</strong></p></div>';

		}

		if ($this->option['rds_link']==1) {
		    remove_action('wp_head', 'rsd_link');
		}

		if ($this->option['wlwmanifest_link']==1) {
		    remove_action('wp_head', 'wlwmanifest_link');
		}
		if ($this->opt['wp_generator']==1) {
		    remove_action('wp_head', 'wp_generator');
		}
		if ($this->option['wptexturize']==1) {
		    remove_filter('the_content', 'wptexturize');
		    remove_filter('comment_text', 'wptexturize');
		}
		if ($this->option['wp_filter_kses']==1) {
		    remove_filter('pre_user_description', 'wp_filter_kses');
		}
	}
}	

new wp_sanitize_admin;	

