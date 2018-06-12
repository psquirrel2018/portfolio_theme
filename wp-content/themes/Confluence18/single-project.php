<?php
/**
 * The Template for displaying all single projects post type.
 *
 * @package Brendan
 */

get_header();
global $post;
//$projectDetails = get_post_meta($post->ID, '_brendan_portfolio_desc', true);
?>

	<!-- ============ CONTENT START ============ -->
	<section id="rooms-content2">
	<div class="fullwidthbanner-container ph-100" style="width:100%; height:100%;">
		<div class="row">
			<div class="col-xs-12" style="width: 100%; height:400px; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
				<?php
				$postThumbID = get_post_thumbnail_id( get_the_ID() );
				$image_attributes = wp_get_attachment_image_src( $postThumbID, 'full' );
				if ( $image_attributes ) : ?>
					<img class="img-responsive" src="<?php echo $image_attributes[0]; ?>" width="100%" style="margin-top:50px;	" />
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="container-fluid ph-100" style="padding-top:60px;">
<?php while ( have_posts() ) : the_post(); ?>
	<div class="row">
		<div class="col-xs-12 text-center">
		<h1><?php echo the_title(); ?></h1>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-sm-8">
			<?php print the_content(); ?>
		</div>
		<div class="col-xs-12 col-md-4 gallery-right-col ">
			<div class="right-col-details">
				<?php
				echo do_shortcode(
					$projectDetails = get_post_meta($post->ID, '_brendan_portfolio_desc', true)
				); ?>
			</div>

			<div class="photos_gallery">
				<ul style="margin-bottom:60px;">
					<?php
					$images = get_field('gallery');
					if ($images):
						foreach ($images as $image):
							$url = $image['url'];
							$type = $image['type'];
							//$icon = $image['icon'];
							?>
							<li class="projectGalleryItem">
								<a class="galleryImage" rel="gallery1" href="<?php echo $url; ?>">
									<img src="<?php echo $image['sizes']['gallery-thumb']; ?>" alt="<?php echo basename($image['sizes']['medium']); ?>" />
								</a>
							</li>
							<?php
						endforeach;
					endif;
					?>
				</ul>
			</div>
		</div>
	</div>

	</div>
	</section>
<?php endwhile; ?>
	<!-- ============ CONTENT END ============ -->


<?php get_footer();