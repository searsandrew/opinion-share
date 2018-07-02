<?php /*
Plugin Name: Opinion Share
Plugin URI:  https://github.com/searsandrew/opinion-share
Description: Adds a page template and shortcode to Wordpress that asks for visitor opinion, then sends them to either 'Share' a review, or 'Give Feedback'.
Version:     1.0.20
Author:      Andrew Sears
Author URI:  http://www.mayfifteenth.com
*/
$dir = plugin_dir_path( __FILE__ );
require_once($dir.'inc/shortcode.php');
require_once($dir.'inc/admin-opinionshare.php');
require_once($dir.'inc/page-templater.php');

function cfp_opinion_scripts(){
	wp_enqueue_script( 'opinionsharejs', '/wp-content/plugins/opinion-share/js/opinion-share.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'slidebarsjs', '/wp-content/plugins/opinion-share/js/slidebars.min.js', array('jquery'), '0.10.3', true );
	wp_enqueue_style( 'opinionsharecss', '/wp-content/plugins/opinion-share/css/opinionshare.css', false, '1.0.0', 'all');
	wp_enqueue_style( 'slidebarscss', '/wp-content/plugins/opinion-share/css/slidebars.min.css', false, '0.10.3', 'all');
}
add_action( 'wp_enqueue_scripts', 'cfp_opinion_scripts' );

function cfp_widgets_init() {
	register_sidebar( array(
		'name' => 'Customer Review',
		'id' => 'sidebar-review',
		'description' => 'Sidebar used for Customer Review call-to-action. Use any widget for review, or use included Widget.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="panel panel-default"><div class="panel-body">',
		'after_widget' => '</div></div></aside>',
		'before_title' => '<h3 class="widget-title drop-margin">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'cfp_widgets_init' );