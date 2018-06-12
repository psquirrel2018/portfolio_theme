<?php
add_action('admin_init', 'register_myheader_settings');

function register_myheader_settings() {
    register_setting('my-own-theme-options-for-header', 'my_favicon_icon');
    register_setting('my-own-theme-options-for-header', 'banner_default_img');
    register_setting('my-own-theme-options-for-header', 'logo_image');
    register_setting('my-own-theme-options-for-header', 'ph_contact');
    register_setting('my-own-theme-options-for-header', 'map_url');
    register_setting('my-own-theme-options-for-header', 'book_now_url');
}

function header_section_options_page() {
    ?>

    <div class="wrap">
        <h2>Header Section</h2>
        <?php settings_errors(); ?> 
        <form method="post" action="options.php">
            <?php settings_fields('my-own-theme-options-for-header'); ?>
            <?php do_settings_sections('my-own-theme-options-for-header'); ?>
            <?php include('bootstrap_theme_includes.php'); ?>
            <br />
            <div class="row">

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Header Options</h3>
                        </div>

                        <div class="panel-body">



                            <label style="width: 100%;" for="upload_image">Default Banner Image</label>
                            <?php echo my_image_uploader('banner_default_img', 'Upload Image'); ?>

                            <br />
                            <br />
                            <label style="width: 100%;" for="upload_image">Logo Image</label>
                            <?php echo my_image_uploader('logo_image', 'Upload Image'); ?>

                            <br />
                            <br />

                            <label style="width: 100%;" for="upload_image">Favicon Icon</label>                            
                            <?php echo my_image_uploader('my_favicon_icon', 'Upload Image'); ?>

                            <br />
                            <br />

                            <label for="ph_contact">Contact</label>
                            <input id="ph_contact" type="text" name="ph_contact" value="<?php echo get_option('ph_contact'); ?>" class="form-control" />

                            <br />
                            
                            <label for="map_url">Map Url</label>
                            <input id="map_url" type="text" name="map_url" value="<?php echo get_option('map_url'); ?>" class="form-control" />

                            <br />
                            
                            <label for="book_now_url">Book Now Url</label>
                            <input id="book_now_url" type="text" name="book_now_url" value="<?php echo get_option('book_now_url'); ?>" class="form-control" />

                            <br />


                        </div>


                    </div>
                </div>

                <?php include 'option_page_sidebar.php'; ?>

            </div>

            <?php submit_button(); ?>

        </form>
    </div>
    <?php
}

/* My Theme Option */
?>
