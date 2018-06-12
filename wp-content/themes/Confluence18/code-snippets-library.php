<?php
/*
Template Name: Snippet Library
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
                        <img class="img-responsive" src="<?php echo $image_attributes[0]; ?>" width="100%" style="margin-top:-200px;	" />
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
                <div class="col-md-12"><?php $loop = new WP_Query(array('post_type' => 'code-snippets', 'posts_per_page' => -1, 'orderby'=> 'ASC')); ?>
                    <ul>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="latest-post">
                            <?php
                            $postTitle = get_the_title();
                            $post_image = the_post_thumbnail('medium');
                            $post_img = wp_get_attachment_image( $post->ID, 'share-pick', null, array(
                                'class' => 'thumb img-responsive',
                            ) );
                            $source_image = $post_image; // let's assume this image has the size 100x100px
                            $width = 600; // note, how this exceeds the original image size
                            $height = 400; // some pixel less than the original
                            $crop = true; // if this would be false, You would get a 90x90px image. For users of prior
                            // Aqua Resizer users, You would have get a 100x90 image here with $crop = true
                            $resized_image = aq_resize($source_image, $width, $height, $crop);
                            ?>

                            <li><a href="<?php print  get_permalink($post->ID) ?>"><h4><?= $postTitle; ?></h4></a></li>

                        </div>
                    <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div> <!-- End Container -->
    </section>
<?php endwhile; ?>
    <!-- ============ CONTENT END ============ -->



<?php get_footer(); ?>