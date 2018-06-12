<?php
/**
 * Created by PhpStorm.
 * User: circdominic
 * Date: 3/2/18
 * Time: 10:40 AM
 */

?>

<div class="bg-white">

		<!-- ============ OUR WORK START ============ -->

		<section id="featured">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 text-center" style="padding:30px 0;">
						<h5>Recent Projects</h5>
					</div>
				</div>
				<div class="row">
					<!-- Latest Post 1 -->
					<?php $loop = new WP_Query(array('post_type' => 'project','tax_query' => array(
    array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => 'featured',
    )
), 'posts_per_page' => 4, 'orderby'=> 'ASC')); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="col-sm-6 col-md-3 featured">
        <?php
        $project_id = $loop->ID;
        $postTitle = get_the_title();
        $post_image = get_the_post_thumbnail_url($post->ID, 'share-pick', null, array(
            'class' => 'thumb img-responsive',
        ) );
        $post_img = wp_get_attachment_image_url( $post->ID, 'share-pick', null, array(
            'class' => 'thumb img-responsive',
        ) );
        $source_image = $post_image; // let's assume this image has the size 100x100px
        $width = 600; // note, how this exceeds the original image size
        $height = 400; // some pixel less than the original
        $crop = true; // if this would be false, You would get a 90x90px image. For users of prior
        // Aqua Resizer users, You would have get a 100x90 image here with $crop = true
        $resized_image = aq_resize($source_image, $width, $height, $crop);
        //$img = wp_get_attachment_image($review['image_id'], 'share-pick', null, array(
        //	'class' => 'thumb img-responsive',
        //));
        ?>
        <a href="<?php echo get_permalink($project_id); ?>" data-id="<?php echo $post->ID; ?><?php //echo $term_id; ?>">
            <div class="image-holder">
                <img class="img-responsive" src="<?= $post_image; ?>" />
                <div class="hover-overlay"><?= $postTitle; ?></div>
            </div>
        </a>
    </div>
<?php endwhile; ?>
</div>


<div class="row" style="padding:30px 0;">
    <div class="col-sm-12 text-center">
        <a href="/portfolio/" class="btn btn-primary">View My Portfolio</a>
    </div>
</div>
</div>
</section>

<div class="pvvl">
    <div class="pvvl flex-center flex-column center">
        <h2 class="em-100 lh1 type-mlrg ls-title uppercase dark-blue">Contact Me Today<br></h2>
        <p class="em-200 medium-blue type-h4"></p>

    </div>
</div>
</div>