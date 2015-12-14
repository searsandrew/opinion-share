<?php /*
Plugin Name: Opinion Share
Plugin URI:  http://www.centreforge.us/opinion-share
Description: Adds a page template and shortcode to Wordpress that asks for visitor opinion, then sends them to either 'Share' a review, or 'Give Feedback'.
Version:     1.0.20
Author:      Andrew Sears
Author URI:  http://www.mayfifteenth.com
*/
$dir = plugin_dir_path( __FILE__ );
require_once($dir.'inc/shortcode.php');
require_once($dir.'inc/admin-opinionshare.php');

class PageTemplater {
	protected $plugin_slug;
	private static $instance;
	protected $templates;
	public static function get_instance(){
		if(null == self::$instance){
			self::$instance = new PageTemplater();
		} 
		return self::$instance;
	} 
	private function __construct(){
		$this->templates = array();
		add_filter(
			'page_attributes_dropdown_pages_args',
			 array( $this, 'register_project_templates' ) 
		);
		add_filter(
			'wp_insert_post_data', 
			array( $this, 'register_project_templates' ) 
		);
		add_filter(
			'template_include', 
			array( $this, 'view_project_template') 
		);
		$this->templates = array(
			'page-opinionshare.php' => 'Opinion Share Page',
		);
	} 
	public function register_project_templates($atts){
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		} 
		wp_cache_delete( $cache_key , 'themes');
		$templates = array_merge( $templates, $this->templates );
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
		return $atts;
	} 
	public function view_project_template($template){
		global $post;
		if (!isset($this->templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
		return $template;
	} 
	$file = plugin_dir_path(__FILE__). get_post_meta( 
		$post->ID, '_wp_page_template', true 
	);
	if( file_exists( $file ) ) {
		return $file;
	} 
	else { echo $file; }
		return $template;
	} 
} 
add_action('plugins_loaded', array('PageTemplater', 'get_instance'));

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