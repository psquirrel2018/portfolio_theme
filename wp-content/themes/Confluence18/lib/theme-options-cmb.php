<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class cws_Admin {

    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'cws_theme_options';

    /**
     * Options page metabox id
     * @var string
     */
    private $metabox_id = 'cws_theme_option_metabox';

    /**
     * Options Page title
     * @var string
     */
    protected $title = '';

    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';

    /**
     * Holds an instance of the object
     *
     * @var Myprefix_Admin
     **/
    private static $instance = null;

    /**
     * Constructor
     * @since 0.1.0
     */
    private function __construct() {
        // Set our title
        $this->title = __( 'Site Options', 'cws_theme' );
    }

    /**
     * Returns the running object
     *
     * @return Myprefix_Admin
     **/
    public static function get_instance() {
        if( is_null( self::$instance ) ) {
            self::$instance = new cws_Admin();
            self::$instance->hooks();
        }
        return self::$instance;
    }

    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
        add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
    }


    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->key, $this->key );
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

        // Include CMB CSS in the head to avoid FOUC
        add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
    }

    /**
     * Admin page markup. Mostly handled by CMB2
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb2-options-page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
        </div>
        <?php
    }

    /**
     * Add the options metabox to the array of metaboxes
     * @since  0.1.0
     */
    function add_options_page_metabox() {

        // hook in our save notices
        add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

        $cmb = new_cmb2_box( array(
            'id'         => $this->metabox_id,
            'hookup'     => false,
            'cmb_styles' => false,
            'show_on'    => array(
                // These are important, don't remove
                'key'   => 'options-page',
                'value' => array( $this->key, )
            ),
        ) );

        // Set our CMB2 fields

        // LOGO file uploaders
        $cmb->add_field( array(
            'name'    => 'Site Logo',
            'desc'    => 'Upload an image or enter an URL.',
            'id'      => 'cws_theme_logo',
            'type'    => 'file',
            // Optionally hide the text input for the url:
            'options' => array(
                'url' => false,
            ),
        ) );

        //Phone Numbers

        $cmb->add_field( array(
            'name'    => 'Main Phone',
            'desc'    => 'Main Phone number you want displayed on the site',
            'id'      => 'cws_theme_phone',
            'type'    => 'text',
            // Optionally hide the text input for the url:
            'options' => array(
                'url' => false,
            ),
        ) );

        //Email addresses

        $cmb->add_field( array(
            'name'    => 'Main Email',
            'desc'    => 'Main Email Address you want the site to use.',
            'id'      => 'cws_theme_email',
            'type'    => 'text',
            // Optionally hide the text input for the url:
            'options' => array(
                'url' => false,
            ),
        ) );

        //address

        $cmb->add_field( array(
            'name'    => 'Main Address',
            'desc'    => 'Main Address you want the site to use.',
            'id'      => 'cws_theme_address',
            'type'    => 'wysiwyg',
            'options' => array('textarea_rows' => 5,),
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Facebook URL', 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_facebookurl',
            'type' => 'text_url',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Twitter URL', 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_twitterurl',
            'type' => 'text_url',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Google+ URL', 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_googleplusurl',
            'type' => 'text_url',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Linkedin URL', 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_linkedinurl',
            'type' => 'text_url',
        ) );
        $cmb->add_field( array(
            'name' => esc_html__( 'Instagram URL', 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_instagramurl',
            'type' => 'text_url',
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( 'Google Analytics ID', 'cmb2' ),
            'desc' => esc_html__( 'example: UA-XXXXX-Y', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_ga_code',
            'type' => 'text_url',
        ) );
        $cmb->add_field( array(
            'name' => esc_html__( 'Copyright text', 'cmb2' ),
            'desc' => esc_html__( '&copy; 2018 Brendan Caffrey Photography', 'cmb2' ),
            'id'   => $prefix . 'cws_theme_copyright',
            'type' => 'text',
            // Optionally hide the text input for the url:
            'options' => array(
                'url' => false,
            ),
        ) );
    }

    /**
     * Register settings notices for display
     *
     * @since  0.1.0
     * @param  int   $object_id Option key
     * @param  array $updated   Array of updated fields
     * @return void
     */
    public function settings_notices( $object_id, $updated ) {
        if ( $object_id !== $this->key || empty( $updated ) ) {
            return;
        }

        add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'cws' ), 'updated' );
        settings_errors( $this->key . '-notices' );
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {
        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
            return $this->{$field};
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}

/**
 * Helper function to get/return the Myprefix_Admin object
 * @since  0.1.0
 * @return Myprefix_Admin object
 */
function cws_admin() {
    return cws_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function cws_theme_get_option( $key = '' ) {
    return cmb2_get_option( cws_admin()->key, $key );
}

// Get it started
cws_admin();