<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'yourprefix_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function yourprefix_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_brendan_frontpage_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Homepage Custom Fields', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
        'show_on' => array('key' => 'page-template', 'value' => 'front-page.php'),
		//'show_on_cb' => '_brendan_frontpage_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

    $cmb_demo->add_field( array(
        'name' => __( 'REQUIRED - Slider Post ID', 'cmb2' ),
        'desc' => __( 'Enter the post id of the Slider to use on the homepage', 'cmb2' ),
        'id'   => $prefix . 'slider_id',
        'type' => 'text',
    ) );
	
	// Intro & Welcome Copy

	$cmb_demo->add_field( array(
		'name' => __( 'Intro Copy', 'cmb2' ),
		'desc' => __( 'This is the: Welcome To... copy', 'cmb2' ),
		'id'   => $prefix . 'welcome_intro',
		'type' => 'text',
		// 'repeatable' => true,
	) );
	
	$cmb_demo->add_field( array(
		'name'       => __( 'Welcome Title', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'welcome_title',
		'type'       => 'text',
		//'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );
	
	$cmb_demo->add_field( array(
		'name' => __( 'Front page welcome image', 'cmb2' ),
		'desc' => __( 'Upload an image or enter a URL.  This will be the image that shows up next to the Welcome Message - 1400x900', 'cmb2' ),
		'id'   => $prefix . 'welcome_image',
		'type' => 'file',
	) );


	$cmb_demo->add_field( array(
        'name'    => __( 'Welcome and SEO Copy wysiwyg', 'cmb2' ),
        'desc'    => __( 'field description (optional)', 'cmb2' ),
        'id'      => $prefix . 'welcome_wysiwyg',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 5, ),
    ) );

    $cmb_demo->add_field( array(
        'name'    => __( 'Optional Extra Homepage Content', 'cmb2' ),
        'desc'    => __( ' (optional)', 'cmb2' ),
        'id'      => $prefix . 'welcome_wysiwyg_optional'
        //'type'    => 'wysiwyg',
        //'options' => array( 'textarea_rows' => 5, ),
    ) );

    $cmb_demo->add_field( array(
        'name'       => __( 'Welcome Title2', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'welcome_title2',
        'type'       => 'text',
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only
        // 'repeatable'      => true,
    ) );

    $cmb_demo->add_field( array(
        'name' => __( 'Front page welcome image2', 'cmb2' ),
        'desc' => __( 'Upload an image or enter a URL.  This will be the image that shows up next to the Welcome Message - 1400x900', 'cmb2' ),
        'id'   => $prefix . 'welcome_image2',
        'type' => 'file',
    ) );


    $cmb_demo->add_field( array(
        'name'    => __( 'Welcome and SEO Copy wysiwyg2', 'cmb2' ),
        'desc'    => __( 'field description (optional)', 'cmb2' ),
        'id'      => $prefix . 'welcome_wysiwyg2',
        'type'    => 'wysiwyg',
        'options' => array( 'textarea_rows' => 5, ),
    ) );

    $cmb_demo->add_field( array(
        'name' => __( 'OPTIONAL - Offers Post ID', 'cmb2' ),
        'desc' => __( 'OPTIONAL - Enter the post id of the Offers data', 'cmb2' ),
        'id'   => $prefix . 'offer_id',
        'type' => 'text',
    ) );
    $cmb_demo->add_field( array(
        'name' => __('Required if Offers are enabled - Offers/Products Page URL', 'cmb2' ),
        'desc' => __( 'Enter the page url where all the products can be seen', 'cmb2' ),
        'id'   => $prefix . 'offersUrl',
        'type' => 'text_url',
    ) );

    $cmb_demo->add_field( array(
        'name' => __('OPTIONAL - Reviews Post ID', 'cmb2' ),
        'desc' => __( 'Enter the post id of the Reviews data', 'cmb2' ),
        'id'   => $prefix . 'review_id',
        'type' => 'text',
    ) );

    $cmb_demo->add_field( array(
        'name' => __('Required if Reviews are enabled - Reviews Page URL', 'cmb2' ),
        'desc' => __( 'OPTIONAL - Enter the page url where all the reviews can be read', 'cmb2' ),
        'id'   => $prefix . 'reviewsUrl',
        'type' => 'text_url',
    ) );

    $cmb_demo->add_field( array(
        'name' => __( 'MAP address ', 'cmb2' ),
        'desc' => __( 'get from, Google', 'cmb2' ),
        'id'   => $prefix . 'address',
        'type' => 'text',
    ) );


    $cmb_demo->add_field( array(
        'name' => __( 'MAP Longitude ', 'cmb2' ),
        'desc' => __( 'get from, Google', 'cmb2' ),
        'id'   => $prefix . 'long',
        'type' => 'text',
    ) );

    $cmb_demo->add_field( array(
        'name' => __( 'MAP Latitude ', 'cmb2' ),
        'desc' => __( 'get from, Google', 'cmb2' ),
        'id'   => $prefix . 'lat',
        'type' => 'text',
    ) );

    $cmb_demo->add_field( array(
        'name' => __( 'Gravity Form ID ', 'cmb2' ),
        'desc' => __( 'get from, Google', 'cmb2' ),
        'id'   => $prefix . 'gf_id',
        'type' => 'text',
    ) );
}