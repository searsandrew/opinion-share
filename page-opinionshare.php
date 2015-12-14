<?php get_header();
$options = get_option('cfp_opinionshare_options'); ?>
<div id="sb-site" style="margin-top:150px;">
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $setpage = $options['cfp_opinionshare_template'] != ''?$options['cfp_opinionshare_template']:'page';
			get_template_part('content', $setpage); ?>
		<?php endwhile; // end of the loop. ?>
	</div>
</div>
	<div class="sb-slidebar sb-left sb-width-wide <?= $options['cfp_opinionshare_layout_0'] == 2?'sb-style-overlay':''; ?>">
	
		<div class="inContainer">
			<button class="sb-close btn btn-danger pull-left">X</button>
			<h3 class="text-center text-slidebar-title" style="line-height: 34px;"><?= strtoupper($options['cfp_opinionshare_ltitle']); ?></h3>
			<?php echo $options['opinionshare_ldesc'] != ''?'<p class="text-slidebar-desc">'.$options['opinionshare_ldesc'].'</p>':''; ?>
			<div class="clearfix"></div>
			<?php dynamic_sidebar('sidebar-review'); ?>
		</div>
	</div>
	<div class="sb-slidebar sb-right sb-width-wide <?= $options['cfp_opinionshare_layout_0'] == 2?'sb-style-overlay':''; ?>">
		<div class="row">
			<div class="col-sm-12">
				<?php if($options['cfp_opinionshare_gformchk_0'] == 1){
					$gformid = $options['cfp_opinionshare_gform_0'];
					gravity_form($gformid, true, true, false, '', true);
				} ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>