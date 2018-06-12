<?php
/**
 * The Template for displaying all single portfolio post type.
 *
 * @package larson
 */

get_header();
global $post;

//$portfolioName = get_post_meta($post->ID, '_brendan_portfolio_name', true);
//$portfolioDescription = get_post_meta($post->ID, '_brendan_portfolio_wysiwyg', true);
//$portfolioGallery = get_post_meta($post->ID, 'brendan_portfolio_group', true);

?>

    <!-- ============ CONTENT START ============ -->

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">

                    <h1><?//= $portfolioName; ?></h1>
                    <!-- Gallery Start -->
                    <div class="fotorama" data-nav="thumbs" data-loop="true">
                        <?php

                        /*foreach ( (array) $portfolioGallery as $portfolioPic ) {
                            $portfolioImg = '';

                            if ( isset( $portfolioPic['pic_id'] ) ) {
                                        $portfolioImg = wp_get_attachment_image( $portfolioPic['pic_id'], 'share-pick', null, array(
                                                                'class' => 'thumb img-responsive',
                                                          ) );
                                } */?>
                        <!-- Slide container -->
                        <?//= $portfolioImg; ?>

                        <?php// }  ?>
                    </div>
                    <!-- Gallery End -->
                    <p><?//= $portfolioDescription; ?></p>

                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </section>


    <!-- ============ CONTENT END ============ -->

<?php get_footer(); ?>