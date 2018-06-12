<?php

/* Template Name: Project Template2*/

get_header('three');
global $post;
//$imageUrl = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<section id="rooms-content2">

    <div class="fullwidthbanner-container ph-100" style="width:100%; height:100%;">
        <div class="row">
            <div class="col-xs-12" style="width: 100%; height:400px; float: left; margin-right: -100%;margin-top:50px; position: relative; opacity: 1; display: block; z-index: 2;">
                <?php
                $postThumbID = get_post_thumbnail_id( get_the_ID() );
                $image_attributes = wp_get_attachment_image_src( $postThumbID, 'full' );
                if ( $image_attributes ) : ?>
                    <img class="img-responsive" src="<?php echo $image_attributes[0]; ?>" width="100%" style="" />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="page-content single-project padding-bottom section-block" style="padding-top:60px;">
    <div class="ph-100">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1><?php echo the_title(); ?></h1>
                <hr>
            </div>
        </div>
        <div id="projects" class="row mt-30">
            <!-- Start projects Loop -->
            <?php

            $allCats = get_terms('project_category',[
                'hide_empty' => true,
            ]);
            $groupTerms = array();
            foreach ( $allCats as $allCatsTerm ) {
                $groupTerms[strtolower($allCatsTerm->name)] = $allCatsTerm->term_id;
            }

            /*
            Query the post
            */
            $args = array( 'post_type' => 'project', 'posts_per_page' => -1, 'orderby'=>'date','order'=>'DESC' );
            $loop = new WP_Query( $args );
            $portfolioResults = $loop->get_posts();
            foreach ($portfolioResults as $portfolioItem):
                /*
                Pull category for each unique post using the ID
                */
                $workThumbId = str_replace(' ', '', $portfolioItem->post_title);
                $workThumbId = htmlentities($workThumbId);
                $terms = get_the_terms( $portfolioItem, 'project_category' );
                $tax = '';
                if ( $terms && ! is_wp_error( $terms ) ) :
                    $links = array();
                    foreach ( $terms as $term ) {
                        $links[] = $term->name;
                    }
                    $search = array(' ', '&', 'amp;');
                    $replace = array('-', 'and','');

                    $tax_links = join( " ", str_replace($search, $replace, $links));
                    $tax = strtolower($tax_links);

                endif;
                $title = get_the_title($portfolioItem);
                //$project_page_image = get_post_meta($portfolioItem->ID, '_brendan_portfolio_project_page_image', true);
                //$project_image = get_the_post_thumbnail_url($portfolioItem, 'full');
                $project_image2 = get_the_post_thumbnail_url($portfolioItem, 'full');
                $project_image = get_post_meta($portfolioItem->ID, '_brendan_portfolio_project_page_image', true);

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

                <?php echo '<div class="project col-sm-6 col-md-3 all project-item '. $tax .'">';?>
                <!--<a href="<?//= get_the_post_thumbnail_url($portfolioItem->ID, 'full'); ?>" class="galleryItem" data-group="<?//= $taxID; ?>">-->
                <a href="<?= get_the_permalink($portfolioItem->ID); ?>" class="">
                    <?php echo '<img class="img-responsive" src="'. $project_image. '">'; ?>
                </a>
                <h4><?= $title; ?></h4>
                <?php echo '</div>' ?> <!-- End individual project col -->
            <?php endforeach; ?>

        </div><!-- End Project Details Row -->



    </div>

    <div class="section-space"></div>

</section> <!-- /.page-content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
