<?php /* register menu item */
function cfp_opinionshare_admin_menu_setup(){
add_submenu_page(
	'options-general.php',
	'Opinion Share Settings',
	'Opinion Share',
	'manage_options',
	'cfp_opinionshare',
	'cfp_opinion_share_admin_page_screen'
	);
}
add_action('admin_menu', 'cfp_opinionshare_admin_menu_setup'); //menu setup

/* display page content */
function cfp_opinion_share_admin_page_screen() {
	global $submenu;
	// access page settings 
	$page_data = array();	
	foreach($submenu['options-general.php'] as $i => $menu_item) {
	if($submenu['options-general.php'][$i][2] == 'cfp_opinionshare')
	$page_data = $submenu['options-general.php'][$i];
}
// output ?>
<div class="wrap">
	<?php screen_icon();?>
	<h2><?php echo $page_data[3];?></h2>
	<form id="cfp_opinionshare_options" action="options.php" method="post">
	<?php settings_fields('cfp_opinionshare_options');
	do_settings_sections('cfp_opinionshare'); 
	submit_button('Save options', 'primary', 'cfp_opinionshare_options_submit'); ?>
	</form>
</div>
<?php }
/* settings link in plugin management screen */
function cfp_opinionshare_settings_link($actions, $file) {
	if(false !== strpos($file, 'opinion-share'))
	$actions['settings'] = '<a href="options-general.php?page=cfp_opinionshare">Settings</a>';
	return $actions; 
}
add_filter('plugin_action_links', 'cfp_opinionshare_settings_link', 2, 2);


/* register settings */
function cfp_opinionshare_settings_init(){
	register_setting(
		'cfp_opinionshare_options',
		'cfp_opinionshare_options',
		'cfp_opinionshare_options_validate'
	);
	
	add_settings_section(
		'cfp_opinionshare_general',
		'General Options', 
		'cfp_opinionshare_general_desc',
		'cfp_opinionshare'
	);
	
	add_settings_section(
		'cfp_opinionshare_left',
		'"Happy" Options', 
		'cfp_opinionshare_left_desc',
		'cfp_opinionshare'
	);
	
	add_settings_section(
		'cfp_opinionshare_right',
		'"Unhappy" Options', 
		'cfp_opinionshare_right_desc',
		'cfp_opinionshare'
	);
	
	add_settings_field(
		'cfp_opinionshare_layout_id',
		'Layout Type', 
		'cfp_opinionshare_layout_field',
		'cfp_opinionshare',
		'cfp_opinionshare_general'
	);
	
	add_settings_field(
		'cfp_opinionshare_template_id',
		'Content Template', 
		'cfp_opinionshare_template_field',
		'cfp_opinionshare',
		'cfp_opinionshare_general'
	);
	
	add_settings_field(
		'cfp_opinionshare_ltitle_id',
		'Panel Title', 
		'cfp_opinionshare_ltitle_field',
		'cfp_opinionshare',
		'cfp_opinionshare_left'
	);
	
	add_settings_field(
		'cfp_opinionshare_ldesc_id',
		'Panel Description', 
		'cfp_opinionshare_ldesc_field',
		'cfp_opinionshare',
		'cfp_opinionshare_left'
	);
	
	add_settings_field(
		'cfp_opinionshare_gformchk_id',
		'Gravity Forms', 
		'cfp_opinionshare_gformchk_field',
		'cfp_opinionshare',
		'cfp_opinionshare_right'
	);
	
	add_settings_field(
		'cfp_opinionshare_gform_id',
		'Feedback Form', 
		'cfp_opinionshare_gform_field',
		'cfp_opinionshare',
		'cfp_opinionshare_right'
	);
}
add_action('admin_init', 'cfp_opinionshare_settings_init');

/* validate input */
function cfp_opinionshare_options_validate($input){
	global $allowedposttags, $allowedrichhtml;
	if(isset($input['authorbox_template']))
	$input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
	return $input;
}

/* description text */
function cfp_opinionshare_general_desc(){
	echo '<p>These options control the general look and feel of the Opinion Share plugin.</p>';
}

/* description text */
function cfp_opinionshare_left_desc(){
	echo '<p>Use the <a href="/wp-admin/widgets.php">Widgets</a> page to add content for the "Happy" panel. There is an included widget that is made for Social Share sites, or you can use any widget of your choice.</p>';
}

/* description text */
function cfp_opinionshare_right_desc(){
	echo '<p>These options control what goes into the right panel in the instance when a visitor selects they were unhappy with their service.</p>';
}

/* filed output */
function cfp_opinionshare_layout_field() {
	$options = get_option('cfp_opinionshare_options');
	echo '<select name="cfp_opinionshare_options[cfp_opinionshare_layout_0]">
		<option value="1" '.selected( $options['cfp_opinionshare_layout_0'], 1, false).'>Page Slide</option>
		<option value="2" '.selected( $options['cfp_opinionshare_layout_0'], 2, false).'>Page Overlay</option>
	</select>';
}

/* filed output */
function cfp_opinionshare_template_field() {
	$options = get_option('cfp_opinionshare_options');
	echo '<input type="text" name="cfp_opinionshare_options[cfp_opinionshare_template]" value="'.$options['cfp_opinionshare_template'].'" class="regular-text" />
	<p class="description" id="template-description">Leave this blank to use the standard page content template. Defaults to \'content-page\'.</p>';
}

/* filed output */
function cfp_opinionshare_gformchk_field() {
	$options = get_option('cfp_opinionshare_options');
	echo '<input type="checkbox" name="cfp_opinionshare_options[cfp_opinionshare_gformchk_0]" '.checked( $options['cfp_opinionshare_gformchk_0'], 1, false).' value="1"> Use <a href="http://www.gravityforms.com/" target="_new">Gravity Forms</a>';
}

/* filed output */
function cfp_opinionshare_ltitle_field() {
	$options = get_option('cfp_opinionshare_options');
	echo '<input type="text" name="cfp_opinionshare_options[cfp_opinionshare_ltitle]" value="'.$options['cfp_opinionshare_ltitle'].'" class="regular-text" />';
}

/* filed output */
function cfp_opinionshare_ldesc_field() {
	$options = get_option('cfp_opinionshare_options');
	$authorbox = (isset($options['opinionshare_ldesc'])) ? $options['opinionshare_ldesc'] : '';
	$authorbox = esc_textarea($authorbox); //sanitise output
	$settings = array('textarea_name' => 'cfp_opinionshare_options[opinionshare_ldesc]', 'editor_height' => '150px');
	wp_editor($authorbox,'left_desc_editor', $settings);
}

/* filed output */
function cfp_opinionshare_gform_field() {
	$options = get_option('cfp_opinionshare_options');
	if($options['cfp_opinionshare_gformchk_0'] == 1){
		if(class_exists("GFForms")){
			GFForms::include_addon_framework();
			$forms = GFAPI::get_forms(); $i = 0; $f = 0;
			if(count($forms) != 0){
				echo '<select name="cfp_opinionshare_options[cfp_opinionshare_gform_0]">';
				foreach($forms as $form) { 
					// echo '<pre>';
					// print_r($form);
					// echo '</pre>';
					// echo $form[title].' - '.$form[id].'<br/>';
					echo '<option value="'.$form[id].'" '.selected($options['cfp_opinionshare_gform_0'], $form[id], false).'>'.$form[title].'</option>';
				}
				echo '</select>';
			} else {
				echo 'No Forms Found';
			}
		} else{
			echo '<p><span class="dashicons dashicons-warning"></span> <strong class="red">Please install Gravity Forms</strong></p><p>Opinion Share uses Gravity Forms to provide feedback as to why your customer was unhappy with their service. Please install <a href="http://www.gravityforms.com/">Gravity Forms</a>.';
		}
	} else {
		$authorbox = (isset($options['authorbox_template'])) ? $options['authorbox_template'] : '';
		$authorbox = esc_textarea($authorbox); //sanitise output
		$settings = array('textarea_name' => 'cfp_opinionshare_options[authorbox_template]');
		wp_editor($authorbox,'right_editor', $settings);
	}
}