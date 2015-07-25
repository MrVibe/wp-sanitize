<?php
/*
Plugin Name: WP Sanitize
Plugin URI: http://www.vibethemes.com/
Description: A super-simple plugin to optimize your blog
Version: 1.0
Author: VibeThemes
Author URI: http://www.vibethemes.com
License: GPL2
*/

require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/admin.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/functions.php' );


add_action('plugins_loaded','wp_sanitize_translations');
function wp_sanitize_translations(){
    $locale = apply_filters("plugin_locale", get_locale(), 'wp-sanitize');
    $lang_dir = dirname( __FILE__ ) . '/languages/';
    $mofile        = sprintf( '%1$s-%2$s.mo', 'wp-sanitize', $locale );
    $mofile_local  = $lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

    if ( file_exists( $mofile_global ) ) {
        load_textdomain( 'wp-sanitize', $mofile_global );
    } else {
        load_textdomain( 'wp-sanitize', $mofile_local );
    }   
}
