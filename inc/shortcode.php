<?php /* ** Shortcode for Button Selet ** */
function cfp_bs_opinionselect($atts, $content = null) {
	extract(shortcode_atts(array(
		"question" => 'Would you reccomend us to your family and friends?',
		"leftbutton" => 'Yes',
		"leftcolor" => 'default',
		"leftsize" => 'md',
		"rightbutton" => 'No',
		"rightcolor" => 'default',
		"rightsize" => 'md'
		), $atts));
	return '<div class="row">
		<div class="col-sm-12">
			<h3 class="opinion-share opinion-share-title text-center">'.$question.'</h3>
			<div class="row">
				<div class="col-sm-6">
					<button id="yesBtn" type="button" class="sb-toggle-left btn btn-'.$leftsize.' btn-'.$leftcolor.' btn-block">'.$leftbutton.'</button>
				</div><div class="col-sm-6">
					<button id="noBtn" type="button" class="sb-toggle-right btn btn-'.$rightsize.' btn-'.$rightcolor.' btn-block">'.$rightbutton.'</button>
				</div>
			</div>
		</div>
	</div>';
}
add_shortcode('opinion', 'cfp_bs_opinionselect'); ?>