<?php
/*
Template Name: The Blog
*/

get_header('two'); ?>

    <!-- ============ CONTENT START ============ -->
    <section id="rooms-content2">
        <div class="fullwidthbanner-container" style="width:100%; height:50%;">
            <div class="row">
                <div class="col-xs-12" style="width: 100%; height:500px; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                    <?php
                    $postThumbID = get_post_thumbnail_id( get_the_ID() );
                    $image_attributes = wp_get_attachment_image_src( $postThumbID, 'full' );
                    if ( $image_attributes ) : ?>
                        <img class="img-responsive" src="<?php echo $image_attributes[0]; ?>" width="100%" style="margin-top:-350px;	" />
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="container" style="padding-top:60px;">
            <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-sm-12 text-center">
                    <h1><?php echo the_title(); ?></h1>
                    <hr>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php print the_content(); ?>
                    </div>
                </div>
                <div class="row">
                    <?php $loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1, 'orderby'=> 'ASC')); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <div class="col-md-4">
                        <div class="latest-post" style="padding:10px;">

                            <?php
                            //$postTitle = get_the_title();
                            $postDate = get_the_date();
                            ?>
                            <div><a href="<?php print  get_permalink($post->ID) ?>"><strong><?php echo the_title(); ?></strong></a></div>
                             <div><?= $postDate; ?></div>

                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
        </div><!-- End Container -->

    </section>
<?php endwhile; ?>
    <!-- ============ CONTENT END ============ -->



<?php get_footer(); ?>