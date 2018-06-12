<?php
/* Default template for all secondary page content */

get_header();

	global $post;
	$imageUrl = wp_get_attachment_url( get_post_thumbnail_id() );
	?>
	<div class="fullwidthbanner-container">
		<div class="row">
			<div class="col-xs-12 hero-banner" style="background: url('<?= $imageUrl; ?>');height:600px; background-size:cover;">
			</div>
		</div>
	</div> <!-- /non_slider_wrapper-->


	<section class="page-content single-project padding-bottom section-block">
		<div class="limit-width">
			<div class="row">
				<div class="col-sm-12 text-center">

	<!-- ============ CONTENT START ============ -->
		<?php while ( have_posts() ) : the_post(); ?>
					<h1 class="ptm"><?php echo the_title(); ?></h1>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6"><?php print the_content(); ?></div>
				<div class="col-md-6">
					<h4>
						Project details go here
					</h4>
					<?php //the_post_thumbnail(); ?>
				</div>
			</div>
		</div> <!-- End Container -->
	</section>

	<!-- ============ CONTENT END ============ -->
<?php endwhile; ?>

<?php get_footer(); ?>