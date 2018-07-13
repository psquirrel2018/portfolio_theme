<?php
/* Template Name: Secondary Template */
 
get_header();

?>

<!-- ============ CONTENT START ============ -->
<section id="rooms-content2">
	<div class="fullwidthbanner-container ph-100" style="width:100%; height:100%;">
		<div class="row">
			<div class="col-xs-12" style="width: 100%; max-height:400px; float: left; margin-right: -100%;margin-top:50px; position: relative; opacity: 1; display: block; z-index: 2;">
				<?php
				$postThumbID = get_post_thumbnail_id( get_the_ID() );
				$image_attributes = wp_get_attachment_image_src( $postThumbID, 'full' );
				if ( $image_attributes ) : ?>
					<img class="img-responsive" src="<?php echo $image_attributes[0]; ?>" width="100%" style="" />
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container-fluid ph-100" style="padding-top:60px;">
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-sm-12 text-center">
					<h1><?php echo the_title(); ?></h1>
					<hr>
				</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-8"><?php print the_content(); ?></div>
			<div class="col-xs-12 col-md-4"> <?php $sidebar_image = get_post_meta(); ?>
				<img class="img-responsive" src="<?= $sidebar_image; ?>" /></div>
		</div> <!-- End Container -->
	</div>
</section>
<?php endwhile; ?>
		<!-- ============ CONTENT END ============ -->

 
<?php get_footer(); ?>