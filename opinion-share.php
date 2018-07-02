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
require_once($dir.'inc/templater.php');

add_action('wp_head', 'cfp_do_action_sidebars', 10, 1);
add_action('setup_bars', 'cfp_setup_sidebars', 15, 1);

function cfp_setup_sidebars($options){
	print_r($options); ?>
	<div id="osRightBar" class="sidenav sidenavRight">
		<a href="javascript:void(0)" class="closebtn" onclick="closeRightNav()">&times;</a>
		<?php if($options['cfp_opinionshare_gformchk_0'] == 1 && isset($options['cfp_opinionshare_gform_0'])){
			$gformid = $options['cfp_opinionshare_gform_0'];
			gravity_form($gformid, true, true, false, '', true);
		} ?>
	</div>

	<div id="osLeftBar" class="sidenav sidenavLeft">
		<a href="javascript:void(0)" class="closebtn" onclick="closeLeftNav()">&times;</a>
		<h3 class="text-center text-slidebar-title" style="line-height: 34px;"><?= strtoupper($options['cfp_opinionshare_ltitle']); ?></h3>
		<?php echo $options['opinionshare_ldesc'] != ''?'<p class="text-slidebar-desc">'.$options['opinionshare_ldesc'].'</p>':''; ?>
	</div>
<?php
};

function cfp_do_action_sidebars() {
	$options = get_option('cfp_opinionshare_options');
	do_action('setup_bars', $options);
}

function cfp_opinion_scripts(){
	wp_enqueue_script( 'opinionsharejs', '/wp-content/plugins/opinion-share/js/opinion-share.js', array('jquery'), '1.0.0', true );
//	wp_enqueue_script( 'slidebarsjs', '/wp-content/plugins/opinion-share/js/slidebars.min.js', array('jquery'), '0.10.3', true );
	wp_enqueue_style( 'opinionsharecss', '/wp-content/plugins/opinion-share/css/opinionshare.css', false, '1.0.0', 'all');
//	wp_enqueue_style( 'slidebarscss', '/wp-content/plugins/opinion-share/css/slidebars.min.css', false, '0.10.3', 'all');
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