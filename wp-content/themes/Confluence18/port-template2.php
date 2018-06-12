<?php

/* Template Name: Port Template2*/

get_header('two');
global $post;
//$imageUrl = wp_get_attachment_url( get_post_thumbnail_id() );
?>

<section class="page-content single-project padding-bottom section-block" style="margin-top:80px;">
    <div class="ph-100">
        <div class="row">
            <div class="col-xs-12"> <?//php the_title(); ?></div>
        </div>

        <div id="portfolio" class="row mt-30">
            <!-- Start projects Loop -->
            <?php
            $allCats = get_terms('category',[
                'hide_empty' => true,
            ]);
            $groupTerms = array();
            foreach ( $allCats as $allCatsTerm ) {
                $groupTerms[strtolower($allCatsTerm->name)] = $allCatsTerm->term_id;
            }

            /*
            Query the post
            */
            $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby'=>'menu_order','order'=>'ASC' );
            $loop = new WP_Query( $args );
            $portfolioResults = $loop->get_posts();
            //$desc = get_post_meta($post->ID. '_brendan_portfolio_desc');
            foreach ($portfolioResults as $portfolioItem):
                $descDeets = get_post_meta($portfolioItem->ID, '_brendan_portfolio_desc', true);
                $workThumbId = str_replace(' ', '', $portfolioItem->post_title);
                $workThumbId = htmlentities($workThumbId);
                $terms = get_the_terms( $portfolioItem, 'category' );
                $tax = '';
                if( $terms && ! is_wp_error( $terms ) ) :
                    $links = array();
                    $links2 = array();
                    foreach ( $terms as $term ) {
                        $termName = $term->name;
                        $categoryTermName = $term->name;
                        $termName = str_replace('&amp; ', '', $termName);
                        $termName = str_replace('&', '-', $termName);
                        $termName = str_replace(' ', '-', $termName);
                        //$termName = strtolower($termName);
                        $links[] = $termName;
                        $links2[] = $categoryTermName;
                    }

                endif;
                //$desc = get_post_meta($portfolioItem, '_brendan_portfolio_desc', true);
                $title = get_the_title($portfolioItem);
                $project_image = get_the_post_thumbnail_url($portfolioItem, 'full');

                //$terms = get_the_terms( $post->ID, 'project_categories' );
                $original_image = $project_image; // let's assume this image has the size 100x100px
                $width = 410; // note, how this exceeds the original image size
                $height = 267; // some pixel less than the original
                $crop = true; // if this would be false, You would get a 90x90px image. For users of prior
                // Aqua Resizer users, You would have get a 100x90 image here with $crop = true
                $new_image = aq_resize($original_image, $width, $height, $crop);
                $taxID = null;
                if( array_key_exists( $tax, $groupTerms ) ){
                    $taxID = $groupTerms[$tax];
                }
                ?>

                <?php echo '<div class="project col-sm-6 col-md-4 mb-30 all project-item '. implode(' ', $links) .'">';?>
                <a href="<?= get_the_post_thumbnail_url($portfolioItem->ID, 'full'); ?>" class="galleryItem" data-group="<?= implode(', ', $links); ?>" title="<?= $title;?>" data-desc="<?= $descDeets; ?>">
                    <?php echo '<img class="img-responsive" src="'. $original_image. '">'; ?>
                    <div class="hover-overlay"><?= $title; ?> <br />Category: <?= implode(', ', $links2); ?></div>
                </a>
                <?php echo '</div>' ?>
            <?php endforeach; ?>
            <?php
            //get post meta
           /* $workPostMetas = get_post_meta( $portfolioItem->ID, 'brendan_portfolio_group', true );
            //echo '<pre>' . print_r($workPostMetas, true) . '</pre>';
            if (is_array($workPostMetas) || is_object($workPostMetas))
            {
                foreach ($workPostMetas as $workPostMeta) {
                    $img = '';
                    $imgUrl = '';
                    if ( isset( $workPostMeta['image_id'] ) ) {
                        $img = wp_get_attachment_image($workPostMeta['image_id'], 'share-pick', null, array(
                            'class' => 'thumb  img-responsive',
                        ));
                    }
                    if ( isset( $workPostMeta['image_id'] ) ) {
                        $imgUrl = wp_get_attachment_url($workPostMeta['image_id']);
                    }?>
                    <?php //add another anchor tag and do the same thing for the above ?>
                    <a href="<?= $imgUrl; ?>" class="lightbox"  data-lightbox-gallery="gallery-<?= $workThumbId; ?>"></a>
                    <?php
                } //end nested foreach
            } // end if array */ ?>
        </div>



    </div>

    <div class="section-space"></div>

</section> <!-- /.page-content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
