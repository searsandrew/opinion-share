<?php get_header();
$options = get_option('cfp_opinionshare_options');
if (has_post_thumbnail( $child->ID )){
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $child->ID ), 'single-post-thumbnail' ); } ?>
<div id="sb-site" style="background-image: url(<?= $image[0]; ?>'); background-attachment: fixed; background-position-y: 0.25px;">
	<div class="container">
		<?php while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>

		<div class="row">
			<div class="col-sm-12 os-question">
				<h3 class="opinion-share opinion-share-title text-center"><?= $options['cfp_opinionshare_template'] != ''?$options['cfp_opinionshare_template']:'Would you reccomend us to your family and friends?'; ?></h3>
				<div class="row ps-answers">
					<div class="col-sm-6 os-answer os-answer-yes">
						<button type="button" class="btn btn-md btn-default btn-block" onclick="openLeftNav()">Yes</button>
					</div><div class="col-sm-6 os-answer os-answer-no">
						<button type="button" class="btn btn-md' btn-default btn-block" onclick="openRightNav()">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($options['cfp_opinionshare_css'] != ''){
	echo '<style type="text/css">
		'.$options['cfp_opinionshare_css'].'
	</style>';
}
get_footer(); ?>