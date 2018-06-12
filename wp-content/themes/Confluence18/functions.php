<?php
//require_once( dirname(__FILE__) . '/lib/theme-options-cmb.php');
require_once( dirname(__FILE__) . '/lib/front-page-functions.php');
require_once( dirname(__FILE__) . '/lib/slider-functions.php');
require_once( dirname(__FILE__) . '/lib/post-functions.php');
//require_once( dirname(__FILE__) . '/lib/review-functions.php');
require_once( dirname(__FILE__) . '/lib/portfolio-functions.php');
require_once( dirname(__FILE__) . '/lib/theme-options-cmb.php');
require_once( dirname(__FILE__) . '/lib/widgets.php');
require_once( dirname(__FILE__) . '/lib/aq_resizer.php');
require_once( dirname(__FILE__) . '/lib/wp_bootstrap_navwalker.php');
/* include the option page */
//include("functions/theme_option_page.php");
/* end of include the option page */

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'confluence18' ),
) );

////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
   
add_action( 'wp_enqueue_scripts', 'confluence18_scripts');
 function confluence18_scripts(){
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	 	wp_enqueue_script('imagesloaded.pkgd.min', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '1.0.0', true );
	 	wp_enqueue_script('isotope.pkgd.min', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '1.0.0', true );
	 	wp_enqueue_script('jquery.superslides.min', get_template_directory_uri() . '/js/jquery.superslides.min.js', array(), '1.0.0', true );
	 	wp_enqueue_script('owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '1.0.0', true );
	 	wp_enqueue_script('fotorama', get_template_directory_uri() . '/js/fotorama.js', array(), '1.0.0', true );
	 	wp_enqueue_script('mfp', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array(), '1.0.0', true );
	 	wp_enqueue_script('settings', get_template_directory_uri() . '/js/settings.js', array(), '1.0.0', true );
}
   
function confluence18_theme_styles() {
   		wp_register_style('bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1', 'all' );
		//wp_register_style('fotorama', get_template_directory_uri() .'/css/fotorama.css', array(), '1', 'all' );
    	wp_register_style('animate',  get_template_directory_uri() .'/css/animate.css', array(), null, 'all' );
    	wp_register_style('font-awesome.min', get_template_directory_uri() .'/css/font-awesome.min.css', array(), null, 'all' );
		wp_register_style('owl-carousel', get_template_directory_uri() .'/css/owl.carousel.css', array(), null, 'all' );
		wp_register_style('superslides', get_template_directory_uri() .'/css/superslides.css', array(), null, 'all' );
		//wp_register_style('nivo-css', get_template_directory_uri() .'/css/nivo-lightbox.css', array(), null, 'all' );
		wp_register_style('mfp-css', get_template_directory_uri() .'/css/magnific-popup.css', array(), null, 'all' );
        wp_enqueue_style('css_googleapis','https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');
		wp_register_style('old', get_template_directory_uri() .'/css/oldstyles.css', array(), null, 'all' );
		wp_register_style('helpers', get_template_directory_uri() .'/css/helpers.css', array(), null, 'all' );
		wp_register_style('styles', get_stylesheet_uri(), array(), null, 'all' );
    	wp_enqueue_style( 'bootstrap.min.css' );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'supperslides' );
		wp_enqueue_style( 'css_googleapis' );
    	wp_enqueue_style( 'animate' );
    	wp_enqueue_style( 'nivo-css' );
    	wp_enqueue_style( 'mfp-css' );
	  	wp_enqueue_style( 'old' );
	  	wp_enqueue_style( 'helpers' );
    	wp_enqueue_style( 'font-awesome.min' );
		wp_enqueue_style( 'styles' );
}
add_action( 'wp_enqueue_scripts', 'confluence18_theme_styles' );

add_image_size( 'gallery-thumb', 186, 318, true );

function brendan_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
    global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

// add title tag support
add_theme_support( 'title-tag' );

//Functions for the portfolio custom post types

add_filter('excerpt_length', 'my_excerpt_length');
 
function my_excerpt_length($length) {
 
    return 100;
}
 
add_filter('excerpt_more', 'new_excerpt_more'); 
 
function new_excerpt_more($text){ 
 
    return ' '; 
 
}

function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyADYs4rQ5IKqs3sU49JoR-bCWy_U4En4fE');
}

add_action('acf/init', 'my_acf_init');
 
function portfolio_thumbnail_url($pid){
    $image_id = get_post_thumbnail_id($pid); 
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot'); 
    return  $image_url[0]; 
}


//Adding logo before the nav
add_action ('before_nav', 'logo');
//add_action ('after_nav', 'custom_banner_function');


//Creating Custom Post types for Projects
function setup_projects_cpt(){
    $labels = array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Project' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Project' ),
        'new_item' => __( 'New Project' ),
        'view' => __( 'View Project' ),
        'view_item' => __( 'View Project' ),
        'search_items' => __( 'Search Projects' ),
        'not_found' => __( 'No projects found' ),
        'not_found_in_trash' => __( 'No projects found in Trash' ),
        'parent' => __( 'Parent Project' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes')
    );
    register_post_type('project', $args);
}
add_action('init', 'setup_projects_cpt');

function projects_taxonomy() {
    $labels = array(
        'name' => __( 'Category' ),
        'singular_name' => __( 'Category' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Skills' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' )
    );

    register_taxonomy('project_category','project',array(
        'hierarchical' => true,
        'labels' => $labels
    ));
    flush_rewrite_rules( false );
}
add_action( 'init', 'projects_taxonomy');

//Creating Custom Post types for Portfolio items
function setup_portfolio_cpt(){
    $labels = array(
        'name' => __( 'Portfolio' ),
        'singular_name' => __( 'Portfolio Item' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Portfolio Item' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Portfolio Item' ),
        'new_item' => __( 'New Portfolio Item' ),
        'view' => __( 'View Portfolio Item' ),
        'view_item' => __( 'View Portfolio Item' ),
        'search_items' => __( 'Search Portfolio Items' ),
        'not_found' => __( 'No Portfolio Items found' ),
        'not_found_in_trash' => __( 'No Portfolio items found in Trash' ),
        'parent' => __( 'Parent Portfolio Item' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes')
    );
    register_post_type('portfolio', $args);
}
add_action('init', 'setup_portfolio_cpt');

function portfolio_taxonomy() {
    $labels = array(
        'name' => __( 'Category' ),
        'singular_name' => __( 'Category' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Skills' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' )
    );

    register_taxonomy('category','portfolio',array(
        'hierarchical' => true,
        'labels' => $labels
    ));
    flush_rewrite_rules( false );
}
add_action( 'init', 'portfolio_taxonomy');

//Creating Custom Post types for Portfolio items
function setup_portfolio_gallery_cpt(){
    $labels = array(
        'name' => __( 'Portfolio Gallery' ),
        'singular_name' => __( 'Portfolio Gallery Item' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Portfolio Gallery Item' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Portfolio Gallery Item' ),
        'new_item' => __( 'New Portfolio Item' ),
        'view' => __( 'View Portfolio Gallery Item' ),
        'view_item' => __( 'View Portfolio Gallery Item' ),
        'search_items' => __( 'Search Portfolio Gallery Items' ),
        'not_found' => __( 'No Portfolio Gallery Items found' ),
        'not_found_in_trash' => __( 'No Portfolio Gallery items found in Trash' ),
        'parent' => __( 'Parent Portfolio Gallery Item' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'thumbnail', 'page-attributes')
    );
    register_post_type('portfolio_gallery', $args);
}
add_action('init', 'setup_portfolio_gallery_cpt');

function portfolio_gallery_taxonomy() {
    $labels = array(
        'name' => __( 'Media Category' ),
        'singular_name' => __( 'Media Category' ),
        'search_items' =>  __( 'Search Media Categories' ),
        'all_items' => __( 'All Media Categories' ),
        'parent_item' => __( 'Parent Media Category' ),
        'parent_item_colon' => __( 'Parent Media Category:' ),
        'edit_item' => __( 'Edit Media Category' ),
        'update_item' => __( 'Update Media Category' ),
        'add_new_item' => __( 'Add New Media Category' ),
        'new_item_name' => __( 'New Media Category Name' )
    );

    register_taxonomy('attachment_category','portfolio_gallery_taxonomy',array(
        'hierarchical' => true,
        'labels' => $labels
    ));
    flush_rewrite_rules( false );
}
add_action( 'init', 'portfolio_gallery_taxonomy');

//Creating Custom Post types for the homepage slider
function setup_slides_cpt(){
	$labels = array(
		'name' => _x('slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'all_items' => __('All Slides'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' => __('No Slides Found'),
		'not_found_in_trash' => __('No Slides found in the trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Slides'
		);
	$args = array(
		'labels' => $labels,
		'description' => 'The homepage slides',
		'rewrite' => array('slug' => 'slides'),
		'public' => true,
		'menu_position' => 5,
		'supports' => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
		'has_archive' => true,
		'taxonomies' => array(''),
		'menu_icon' => 'dashicons-images-alt2',
		);
	register_post_type('slides', $args);
}
add_action('init', 'setup_slides_cpt');

//Adding Featured Image Support to all Custom Post Types
add_theme_support( 'post-thumbnails', array( 'project', 'portfolio', 'post', 'page' ) ); // support for these post types

$args = array(
    'header-text' => array(
        'site-title',
        'site-description',
    ),
    'size' => 'full',
);
add_theme_support( 'site-logo', $args );

function remove_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
    // unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     //unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     //unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'remove_default_widgets', 11);


// Remove meta generator (WP version) from site and feed
if ( ! function_exists( 'mywp_remove_version' ) ) {
 
function mywp_remove_version() {
		return '';
}
add_filter('the_generator', 'mywp_remove_version');
}
 
// Clean header from unneeded links
if ( ! function_exists( 'mywp_head_cleanup' ) ) {
 
function mywp_head_cleanup() {
		remove_action('wp_head', 'feed_links', 2);  // Remove Post and Comment Feeds
		remove_action('wp_head', 'feed_links_extra', 3);  // Remove category feeds
		remove_action('wp_head', 'rsd_link'); // Disable link to Really Simple Discovery service
		remove_action('wp_head', 'wlwmanifest_link'); // Remove link to the Windows Live Writer manifest file.
		/*remove_action( 'wp_head', 'index_rel_link' ); */ // canonic link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);  // Remove relation links for the posts adjacent to the current post.
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);


add_action('init', 'mywp_head_cleanup');
} }

