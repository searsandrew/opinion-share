<?php get_header();
$options = get_option('cfp_opinionshare_options'); ?>
<div id="sb-site">
	<div class="container">
		<?php while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>

		<div class="row">
			<div class="col-sm-12">
				<h3 class="opinion-share opinion-share-title text-center"><?= $options['cfp_opinionshare_template'] != ''?$options['cfp_opinionshare_template']:'Would you reccomend us to your family and friends?'; ?></h3>
				<div class="row">
					<div class="col-sm-6">
						<button type="button" class="btn btn-md btn-default btn-block" onclick="openLeftNav()">Yes</button>
					</div><div class="col-sm-6">
						<button type="button" class="btn btn-md' btn-default btn-block" onclick="openRightNav()">No</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php get_footer(); ?>