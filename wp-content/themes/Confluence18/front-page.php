<?php
/*
Template Name: Front Page
*/
/**
 * @author Scott Taylor
 * @package larson
 * @subpackage Customizations
 */
get_header();

global $post;
$intro = get_post_meta($post->ID, '_brendan_frontpage_welcome_intro', true);
$welcome = get_post_meta($post->ID, '_brendan_frontpage_welcome_title', true);
$welcome_copy = get_post_meta($post->ID, '_brendan_frontpage_welcome_wysiwyg', true);
$welcome_image = get_post_meta($post->ID, '_brendan_frontpage_welcome_image', true);
$welcome2 = get_post_meta($post->ID, '_brendan_frontpage_welcome_title2', true);
$welcome_copy2 = get_post_meta($post->ID, '_brendan_frontpage_welcome_wysiwyg2', true);
$welcome_image2 = get_post_meta($post->ID, '_brendan_frontpage_welcome_image2', true);
$offer_id = get_post_meta($post->ID, '_brendan_frontpage_offer_id', true);
$review_id = get_post_meta($post->ID, '_brendan_frontpage_review_id', true);
$reviewsUrl = get_post_meta($post->ID, '_brendan_frontpage_reviewsUrl', true);
$offersUrl = get_post_meta($post->ID, '_brendan_frontpage_offersUrl', true);
$slider_id = get_post_meta($post->ID, '_brendan_frontpage_slider_id', true);
$contact_form_id = get_post_meta($post->ID, '_brendan_frontpage_gf_id', true);

?>

	<div class="banner flex-column center full-height">
		<div id="slider">
			<ul class="slides-container">
				<?php $hpSlider = get_post_meta( $slider_id, 'brendan_slides_group', true );
				foreach ( (array) $hpSlider as $slide ) {
					$img = $title = $secondaryTitle = $cta = $ctaUrl = '';
					if ( isset( $slide['message'] ) )
						$title = esc_html( $slide['message'] );
					if ( isset( $slide['secondary-message'] ) )
						$secondaryTitle = esc_html( $slide['secondary-message'] );
					if ( isset( $slide['cta'] ) )
						$cta = esc_html( $slide['cta'] );
					if ( isset( $slide['cta-url'] ) )
						$ctaUrl = esc_html( $slide['cta-url'] );
					if ( isset( $slide['image_id'] ) ) {
						$img = wp_get_attachment_image( $slide['image_id'], 'share-pick', null, array(
							'class' => 'thumb img-responsive',
						) );
					} ?>
					<!-- Slide container -->
					<li>
						<?= $img; ?>
						<div class="tint2">
							<div class="content text-center">
								<h1><?= $title; ?></h1>
								<h5><?= $secondaryTitle; ?></h5>
								<?php if($ctaUrl) { ?>
								<p><a href="<?= $ctaUrl; ?>" class="btn btn-primary"><?= $cta; ?></a></p>
								<?php } ?>
							</div>
						</div>
					</li>
				<?php }  ?>
			</ul>

			<nav class="slides-navigation" style="z-index:10000;">
				<a href="#" class="prev"><i class="fa fa-angle-left" style="font-size:1.25em;"></i></a>
				<a href="#" class="next"><i class="fa fa-angle-right" style="font-size:1.25em;"></i></a>
			</nav>
		</div>
	</div>


<?php get_footer(); ?>