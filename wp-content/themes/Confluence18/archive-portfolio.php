<?php

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
            <div class="col-xs-12"> <h1 class="title dark-version"><?php the_title(); ?></h1></div>
        </div>
        <div id="filters" class="row">
            <div id="project-page" class="container col-xs-12">
                <ul class="nav navbar-nav navbar-left" id="filters">
                    <?php
                    $terms2 = get_terms('category');
                    $count = count($terms2);
                    echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">All</a></li>';
                    if ( $count > 0 ){
                        foreach ( $terms2 as $term ) {
                            $termname = strtolower($term->name);
                            $termname = str_replace(' ', '-', $termname);
                            echo '<li style="list-style:inline;"><a href="javascript:void(0)" title="" class="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="projects" class="row">
            <!-- Start projects Loop -->
            <?php
            /*
            Query the post
            */
            $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby'=>'menu_order','order'=>'ASC' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
                /*
                Pull category for each unique post using the ID
                */
                $terms = get_the_terms( $post, 'category' );
                $tax = '';
                if ( $terms && ! is_wp_error( $terms ) ) :
                    $links = array();
                    foreach ( $terms as $term ) {
                        $links[] = $term->name;
                    }
                    $tax_links = join( " ", str_replace(' ', '-', $links));
                    $tax = strtolower($tax_links);

                endif;
                $title = get_the_title();
                $project_image = get_the_post_thumbnail_url($Post->ID, 'full');

                //$terms = get_the_terms( $post->ID, 'project_categories' );
                $original_image = $project_image; // let's assume this image has the size 100x100px
                $width = 360; // note, how this exceeds the original image size
                $height = 240; // some pixel less than the original
                $crop = true; // if this would be false, You would get a 90x90px image. For users of prior
                // Aqua Resizer users, You would have get a 100x90 image here with $crop = true
                $new_image = aq_resize($original_image, $width, $height, $crop);


                ?>
                <?php echo '<div class="project col-sm-6 col-md-4 all project-item '. $tax .'">';?>
                <a title="<?= $title; ?>" href="<?php print  get_permalink($post->ID) ?>">
                    <?php echo '<img class="img-responsive" src="'. $original_image. '">'; ?></a>
                <h4><?= $title; ?></h4>


                <?php echo '</div>' ?> <!-- End individual project col -->
            <?php endwhile; ?>
        </div><!-- End Project Details Row -->


        <div class="row">
            <div class="col-sm-6 col-md-4 project-item building <?= $taxCat; ?>" style="margin: 0;min-height:220px;">
                <article class="project-entry-1 wow fadeInCdb" data-wow-duration="0.7s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 0.7s; animation-delay: 0.4s; animation-name: fadeInCdb;">
                    <h2>tax=<?= $taxCat; ?></h2>
                    <!--<a href="<?//= $workUrl; ?>">-->
                    <div class="image-holder">
                        <a href="<?= get_the_post_thumbnail_url($workPost->ID, 'full'); ?>" class="lightbox" data-lightbox-gallery="gallery-<?= $workThumbId; ?>">
                            <img src="<?= get_the_post_thumbnail_url($workPost->ID, 'full') ?>" class="img-responsive">
                        </a>
                        <h2 class="project-title"><?= $workCategory; ?></h2>
                        <span class="project-overlay"></span>
                    </div>
                    <!--</a>-->
                </article>
            </div>
            <?php
            //get post meta
            $workPostMetas = get_post_meta( $workPost->ID, 'brendan_portfolio_group', true );
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
            } // end if array ?>

        </div>

    </div>

    <div class="section-space"></div>

</section> <!-- /.page-content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
