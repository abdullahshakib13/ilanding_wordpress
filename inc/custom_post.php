<?php 
 // Custom Hero
 function custom_hero(){
    register_post_type( 'hero',array(
        'labels'=>array(
        'name'=>('Hero'),
        'singular_name'=>('Hero'),
        'add_new'=>('Add New Hero'),
        'add_new_item'=>('Add New Hero'),
        'edit_item'=>('Edit Hero'),
        'new_item'=>('New Hero'),
        'view_item'=>('View Hero'),
        'not_found'=>('Sorry, we couldnot find the Hero you are looking for'),
        ),
        'menu_icon'=>'dashicons-networking',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'taxonomies'=>array('category'),
        'rewrite'=>array('slug'=>'hero'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_hero');

// Custom About Us Post Type
function custom_about_us(){
    register_post_type('about_us', array(
        'labels' => array(
            'name' => 'About Us',
            'singular_name' => 'About Us',
            'add_new' => 'Add New About Us',
            'add_new_item' => 'Add New About Us',
            'edit_item' => 'Edit About Us',
            'new_item' => 'New About Us',
            'view_item' => 'View About Us',
            'not_found' => 'Sorry, we could not find the About Us you are looking for',
        ),
        'menu_icon' => 'dashicons-networking',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'has_archive' => false, // No archive for About Us pages
        'hierarchical' => false, // Not hierarchical like pages
        'show_ui' => true,
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'rewrite' => array('slug' => 'about-us'),
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
    ));
    add_theme_support('post-thumbnails');
}
add_action('init', 'custom_about_us');

// About Us Meta Boxes
// Add meta box for About Us details
function add_about_us_meta_boxes() {
    add_meta_box(
        'about_us_details',
        'About Us Details',
        'render_about_us_meta_box',
        'about_us',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_about_us_meta_boxes');

// Render the About Us meta box
function render_about_us_meta_box($post) {
    // Nonce field for security
    wp_nonce_field('about_us_nonce_action', 'about_us_nonce');

    // Retrieve meta values
    $contact_name = get_post_meta($post->ID, '_contact_name', true);
    $contact_role = get_post_meta($post->ID, '_contact_role', true);
    $contact_phone = get_post_meta($post->ID, '_contact_phone', true);
    $icon_class = get_post_meta($post->ID, '_icon_class', true);
    $features = get_post_meta($post->ID, '_about_us_features', true) ?: []; // Ensure it's an array

    ?>
    <h4>Features</h4>
    <div id="feature-list-wrapper">
        <?php foreach ($features as $index => $feature): ?>
            <div class="feature-item">
                <input type="text" name="about_us_features[]" value="<?php echo esc_attr($feature); ?>" style="width: 90%;" placeholder="Enter feature here" />
                <button type="button" class="remove-feature button button-secondary">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-feature" class="button button-primary">Add Feature</button>

    <script>
        (function($) {
            $(document).ready(function() {
                $('#add-feature').on('click', function() {
                    $('#feature-list-wrapper').append(`
                        <div class="feature-item">
                            <input type="text" name="about_us_features[]" style="width: 90%;" placeholder="Enter feature here" />
                            <button type="button" class="remove-feature button button-secondary">Remove</button>
                        </div>
                    `);
                });

                $('#feature-list-wrapper').on('click', '.remove-feature', function() {
                    $(this).closest('.feature-item').remove();
                });
            });
        })(jQuery);
    </script>

    <!-- Contact Info Fields -->
    <p>
        <label for="contact_name"><strong>Contact Name:</strong></label><br>
        <input type="text" id="contact_name" name="contact_name" value="<?php echo esc_attr($contact_name); ?>" style="width: 100%;" placeholder="Enter contact name" />
    </p>
    <p>
        <label for="contact_role"><strong>Role:</strong></label><br>
        <input type="text" id="contact_role" name="contact_role" value="<?php echo esc_attr($contact_role); ?>" style="width: 100%;" placeholder="Enter role (e.g., CEO & Founder)" />
    </p>
    <p>
        <label for="contact_phone"><strong>Phone:</strong></label><br>
        <input type="text" id="contact_phone" name="contact_phone" value="<?php echo esc_attr($contact_phone); ?>" style="width: 100%;" placeholder="Enter phone number (e.g., +123 456-789)" />
    </p>
    <p>
        <label for="icon_class"><strong>Icon Class:</strong></label><br>
        <input type="text" id="icon_class" name="icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;" placeholder="Enter CSS class for the icon (e.g., bi bi-check-circle-fill)" />
        <small>Use an icon class from a library like <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</small>
    </p>
    <?php
}

// Save the About Us meta box data
function save_about_us_meta_box_data($post_id) {
    // Verify nonce
    if (!isset($_POST['about_us_nonce']) || !wp_verify_nonce($_POST['about_us_nonce'], 'about_us_nonce_action')) {
        return;
    }

    // Prevent autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Features (array of feature strings)
    if (isset($_POST['about_us_features'])) {
        $features = array_map('sanitize_text_field', $_POST['about_us_features']);
        update_post_meta($post_id, '_about_us_features', $features);
    }

    // Save contact details
    if (isset($_POST['contact_name'])) {
        update_post_meta($post_id, '_contact_name', sanitize_text_field($_POST['contact_name']));
    }
    if (isset($_POST['contact_role'])) {
        update_post_meta($post_id, '_contact_role', sanitize_text_field($_POST['contact_role']));
    }
    if (isset($_POST['contact_phone'])) {
        update_post_meta($post_id, '_contact_phone', sanitize_text_field($_POST['contact_phone']));
    }
    if (isset($_POST['icon_class'])) {
        update_post_meta($post_id, '_icon_class', sanitize_text_field($_POST['icon_class']));
    }
}
add_action('save_post', 'save_about_us_meta_box_data');

// 
// Custom Features Post Type
function custom_features(){
    register_post_type('features', array(
        'labels' => array(
            'name' => 'Features',
            'singular_name' => 'Feature',
            'add_new' => 'Add New Features',
            'add_new_item' => 'Add New Features',
            'edit_item' => 'Edit Features',
            'new_item' => 'New Features',
            'view_item' => 'View Features',
            'not_found' => 'Sorry, we could not find the Features you are looking for',
        ),
        'menu_icon' => 'dashicons-networking',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'has_archive' => false, // No archive for About Us pages
        'hierarchical' => false, // Not hierarchical like pages
        'show_ui' => true,
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'rewrite' => array('slug' => 'features'),
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
    ));
    add_theme_support('post-thumbnails');
}
add_action('init', 'custom_Features');

// Meta box for Tab Title features
function create_tab_title_meta_box() {
    add_meta_box(
        'tab_title_meta_box', // Unique ID for the meta box
        'Tab Title', // Title of the meta box
        'display_tab_title_meta_box', // Callback function to display the meta box content
        'features', // Post type to display the meta box on
        'normal', // Position of the meta box (side or normal)
        'high' // Priority of the meta box
    );
}
add_action( 'add_meta_boxes', 'create_tab_title_meta_box' );

function display_tab_title_meta_box( $post ) {
    // Get the stored value
    $tab_title = get_post_meta( $post->ID, '_tab_title', true );
    ?>
    <label for="tab_title">Tab Title:</label>
    <input type="text" id="tab_title" name="tab_title" value="<?php echo esc_attr( $tab_title ); ?>" />
    <?php
}

function save_tab_title_meta_box( $post_id ) {
    // Check if the current user has permission to edit the post
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    // Check if the data was submitted
    if ( !isset( $_POST['tab_title'] ) ) {
        return $post_id;
    }

    // Sanitize the user input
    $tab_title = sanitize_text_field( $_POST['tab_title'] );

    // Update the meta field
    update_post_meta( $post_id, '_tab_title', $tab_title );
}
add_action( 'save_post', 'save_tab_title_meta_box' );


 // Custom Stats
 function custom_stats(){
    register_post_type( 'stats',array(
        'labels'=>array(
        'name'=>('Stats'),
        'singular_name'=>('Stat'),
        'add_new'=>('Add New Stat'),
        'add_new_item'=>('Add New Stat'),
        'edit_item'=>('Edit Stat'),
        'new_item'=>('New Stat'),
        'view_item'=>('View Stat'),
        'not_found'=>('Sorry, we couldnot find the stats you are looking for'),
        ),
        'menu_icon'=>'dashicons-post-status',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'taxonomies'=>array('category'),
        'rewrite'=>array('slag'=>'stat'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_stats');

// Add Meta Box for Stats Icons
function stats_icon_meta_box() {
    add_meta_box(
        'stats_icon',                  // Meta box ID
        'Stats Icon',                  // Title
        'render_stats_icon_meta_box', // Callback function to render the box
        'stats',                       // Post type (replace with your stats custom post type slug)
        'normal',                      // Context (normal, side, advanced)
        'high'                         // Priority
    );
}
add_action('add_meta_boxes', 'stats_icon_meta_box');



// Render Meta Box feature cards
function render_stats_icon_meta_box($post) {
    // Retrieve the saved value if available
    $icon_class = get_post_meta($post->ID, '_stats_icon_class', true);

    // Add a nonce field for security
    wp_nonce_field('save_stats_icon_meta', 'stats_icon_meta_nonce');

    ?>
    <p>
        <label for="stats_icon_class">Icon Class (e.g., "bi bi-award"):</label><br>
        <input type="text" id="stats_icon_class" name="stats_icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;">
        <small>Enter the CSS class for the icon. Use classes from a library like Bootstrap Icons.</small>
    </p>
    <?php
}


// Save Meta Box
function save_stats_icon_meta($post_id) {
    // Check nonce for security
    if (!isset($_POST['stats_icon_meta_nonce']) || !wp_verify_nonce($_POST['stats_icon_meta_nonce'], 'save_stats_icon_meta')) {
        return;
    }

    // Prevent auto-saves
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Ensure the user has permission to edit
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the icon class
    if (isset($_POST['stats_icon_class'])) {
        update_post_meta($post_id, '_stats_icon_class', sanitize_text_field($_POST['stats_icon_class']));
    }
}
add_action('save_post', 'save_stats_icon_meta');


// Custom Slider
function custom_slider(){
    register_post_type( 'slider',array(
        'labels'=>array(
        'name'=>('Slider'),
        'singular_name'=>('Slider'),
        'add_new'=>('Add New Slider'),
        'add_new_item'=>('Add New Slider'),
        'edit_item'=>('Edit Slider'),
        'new_item'=>('New Slider'),
        'view_item'=>('View Slider'),
        'not_found'=>('Sorry, we couldnot find the slider you are looking for'),
        ),
        'menu_icon'=>'dashicons-format-gallery',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'rewrite'=>array('slag'=>'slider'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_slider');


// Custom Testimonial
function custom_testimonial() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => ('Testimonial'),
            'singular_name' => ('Testimonial'),
            'add_new' => ('Add New Testimonial'),
            'add_new_item' => ('Add New Testimonial'),
            'edit_item' => ('Edit Testimonial'),
            'new_item' => ('New Testimonial'),
            'view_item' => ('View Testimonial'),
            'not_found' => ('Sorry, we could not find the Testimonial you are looking for'),
        ),
        'menu_icon' => 'dashicons-post-status',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'has_archive' => true,
        'hierarchial' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'rewrite' => array('slug' => 'stat'),
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
    ));
    add_theme_support('post-thumbnails');
}
add_action('init', 'custom_testimonial');

// Add Designation Field Meta Box
function add_designation_meta_box() {
    add_meta_box(
        'testimonial_designation', // ID of the meta box
        'Testimonial Designation', // Title of the meta box
        'render_designation_meta_box', // Callback function to display the meta box
        'testimonial', // Post type
        'normal', // Context
        'default' // Priority
    );
}
add_action('add_meta_boxes', 'add_designation_meta_box');

// Render the Designation Field in the Meta Box
function render_designation_meta_box($post) {
    // Retrieve the current value of the designation
    $designation = get_post_meta($post->ID, '_testimonial_designation', true);
    $star = get_post_meta($post->ID, '_testimonial_star', true);
    
    ?>
    <label for="testimonial_designation">Designation:</label>
    <input type="text" name="testimonial_designation" id="testimonial_designation" value="<?php echo esc_attr($designation); ?>" style="width: 100%;" />
    <label for="testimonial_star">Star Number:</label>
    <input type="number" name="testimonial_star" id="testimonial_star" value="<?php echo esc_attr($star); ?>" style="width: 100%;" />
    <?php
}

// Save the Designation Field Value
function save_testimonial_designation($post_id) {
    // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the designation value
    if (isset($_POST['testimonial_designation'])) {
        update_post_meta($post_id, '_testimonial_designation', sanitize_text_field($_POST['testimonial_designation']));
    }
    // Save the Star value
    if (isset($_POST['testimonial_star'])) {
        update_post_meta($post_id, '_testimonial_star', sanitize_text_field($_POST['testimonial_star']));
    }
}
add_action('save_post', 'save_testimonial_designation');

// Custom Counts Section
function custom_count() {
    register_post_type('count', array(
        'labels' => array(
            'name' => ('Count'),
            'singular_name' => ('Count'),
            'add_new' => ('Add New Count'),
            'add_new_item' => ('Add New Count'),
            'edit_item' => ('Edit Count'),
            'new_item' => ('New Count'),
            'view_item' => ('View Count'),
            'not_found' => ('Sorry, we could not find the Count you are looking for'),
        ),
        'menu_icon' => 'dashicons-post-status',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'has_archive' => true,
        'hierarchial' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'taxonomies' => array('category'),
        'rewrite' => array('slug' => 'count'),
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
    ));
    add_theme_support('post-thumbnails');
}
add_action('init', 'custom_count');

// Add Count Number Field Meta Box
function add_number_meta_box() {
    add_meta_box(
        'count_number', // ID of the meta box
        'Count Number', // Title of the meta box
        'render_number_meta_box', // Callback function to display the meta box
        'count', // Post type
        'normal', // Context
        'default' // Priority
    );
}
add_action('add_meta_boxes', 'add_number_meta_box');

// Render the Designation Field in the Meta Box
function render_number_meta_box($post) {
// Retrieve the current value of the designation
     $number = get_post_meta($post->ID, '_count_number', true);
    
   ?>
    <label for="count_number">Number:</label> 
     <input type="number" name="count_number" id="count_number" value="<?php echo esc_attr($number); ?>" style="width: 100%;" /> 
     <?php
 }

// Save the Designation Field Value
function save_count_number($post_id) {
     // Check if the current user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
         return;
   }

     // Save the Number value
     if (isset($_POST['count_number'])) {
         update_post_meta($post_id, '_count_number', sanitize_text_field($_POST['count_number']));
     }
 }
 add_action('save_post', 'save_count_number');

  // Custom Service
  function custom_service(){
    register_post_type( 'service',array(
        'labels'=>array(
        'name'=>('Services'),
        'singular_name'=>('Service'),
        'add_new'=>('Add New Service'),
        'add_new_item'=>('Add New Service'),
        'edit_item'=>('Edit Service'),
        'new_item'=>('New Service'),
        'view_item'=>('View Service'),
        'not_found'=>('Sorry, we couldnot find the service you are looking for'),
        ),
        'menu_icon'=>'dashicons-networking',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'taxonomies'=>array('category'),
        'rewrite'=>array('slug'=>'service'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_service');

// Add a meta box
function add_service_icon_metabox() {
    add_meta_box(
        'service_icon_metabox',      // Meta box ID
        'Service Icon',              // Title
        'render_service_icon_metabox', // Callback function
        'service',            // Post types where it should appear
        'normal',                      // Context
        'default' 
    );
}
add_action('add_meta_boxes', 'add_service_icon_metabox');

// Render the meta box
function render_service_icon_metabox($post) {
    // Retrieve current value of the meta key
    $service_icon = get_post_meta($post->ID, '_service_icon', true);
    
    // Add a nonce field for security
    wp_nonce_field('save_service_icon_metabox', 'service_icon_metabox_nonce');
    
    // Input field for the icon (font-awesome class, image URL, etc.)
    ?>
    <p>
    <label for="service_icon">Enter Icon:</label> 
    <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($service_icon); ?>" style="width: 100%; margin-top: 5px;" />
    </p>
    <?php
}

// Save the meta box data
function save_service_icon_metabox($post_id) {
    // Verify nonce
    if (!isset($_POST['service_icon_metabox_nonce']) || !wp_verify_nonce($_POST['service_icon_metabox_nonce'], 'save_service_icon_metabox')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the input
    if (isset($_POST['service_icon'])) {
        $service_icon = sanitize_text_field($_POST['service_icon']);
        update_post_meta($post_id, '_service_icon', $service_icon);
    } else {
        delete_post_meta($post_id, '_service_icon');
    }
}
add_action('save_post', 'save_service_icon_metabox');

// 
  // Custom Service
  function custom_service_details(){
    register_post_type( 'service_details',array(
        'labels'=>array(
        'name'=>('Service Details'),
        'singular_name'=>('Service Details'),
        'add_new'=>('Add New Service Details'),
        'add_new_item'=>('Add New Service Details'),
        'edit_item'=>('Edit Service Details'),
        'new_item'=>('New Service Details'),
        'view_item'=>('View Service Details'),
        'not_found'=>('Sorry, we couldnot find the Service Details you are looking for'),
        ),
        'menu_icon'=>'dashicons-networking',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'taxonomies'=>array('category'),
        'rewrite'=>array('slug'=>'service_details'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_service_details');

// 
// Features Card
function custom_features_card(){
    register_post_type( 'features_card',array(
        'labels'=>array(
        'name'=>('Features Card'),
        'singular_name'=>('Feature Card'),
        'add_new'=>('Add New Feature Card'),
        'add_new_item'=>('Add New Feature Card'),
        'edit_item'=>('Edit Feature Card'),
        'new_item'=>('New Feature Card'),
        'view_item'=>('View Feature Card'),
        'not_found'=>('Sorry, we couldnot find the Feature Card you are looking for'),
        ),
        'menu_icon'=>'dashicons-awards',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'rewrite'=>array('slug'=>'slider'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_features_card');

// Add Meta Box
function feature_box_meta_boxes() {
    add_meta_box(
        'feature_box_details',           // Meta box ID
        'Feature Box Details',           // Meta box title
        'render_feature_box_meta_box',   // Callback function to render the box
        'features_card',                   // Post type
        'normal',                        // Context (normal, side, or advanced)
        'high'                           // Priority
    );
}
add_action('add_meta_boxes', 'feature_box_meta_boxes');


// Render Meta Box feature cards
function render_feature_box_meta_box($post) {
    // Retrieve current values for the fields (if they exist)
    $icon_class = get_post_meta($post->ID, '_feature_icon_class', true);
    $background_color = get_post_meta($post->ID, '_feature_background_color', true);
    // $animation_delay = get_post_meta($post->ID, '_feature_animation_delay', true);

    // Security nonce for saving
    wp_nonce_field('save_feature_box_meta', 'feature_box_meta_nonce');

    ?>
    <p>
        <label for="feature_icon_class">Icon Class (e.g., "bi bi-award"):</label><br>
        <input type="text" id="feature_icon_class" name="feature_icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="feature_background_color">Background Color (e.g., "orange"):</label><br>
        <input type="text" id="feature_background_color" name="feature_background_color" value="<?php echo esc_attr($background_color); ?>" style="width: 100%;">
    </p>
    <!-- <p>
        <label for="feature_animation_delay">Animation Delay (in ms, e.g., "100"):</label><br>
        <input type="number" id="feature_animation_delay" name="feature_animation_delay" value="<?php //echo esc_attr($animation_delay); ?>" style="width: 100%;">
    </p> -->
    <?php
}

// Save Meta Box
function save_feature_box_meta($post_id) {
    // Check for nonce security
    if (!isset($_POST['feature_box_meta_nonce']) || !wp_verify_nonce($_POST['feature_box_meta_nonce'], 'save_feature_box_meta')) {
        return;
    }

    // Prevent auto-save from overwriting
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Ensure user has permission to edit
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the icon class
    if (isset($_POST['feature_icon_class'])) {
        update_post_meta($post_id, '_feature_icon_class', sanitize_text_field($_POST['feature_icon_class']));
    }

    // Sanitize and save the background color
    if (isset($_POST['feature_background_color'])) {
        update_post_meta($post_id, '_feature_background_color', sanitize_text_field($_POST['feature_background_color']));
    }

}
add_action('save_post', 'save_feature_box_meta');
add_action('wp_head', function() {
    if (is_singular('feature_box')) {
        $icon_class = get_post_meta(get_the_ID(), '_feature_icon_class', true);
        error_log('Icon Class: ' . $icon_class);
    }
});


// === Features2 Custom Post Type ===
function custom_features2() {
    register_post_type('features2', array(
        'labels' => array(
            'name'               => 'Features 2',
            'singular_name'      => 'Feature 2',
            'add_new'            => 'Add New Feature 2',
            'add_new_item'       => 'Add New Feature 2',
            'edit_item'          => 'Edit Feature 2',
            'new_item'           => 'New Feature 2',
            'view_item'          => 'View Feature 2',
            'not_found'          => 'Sorry, we couldn’t find the Feature 2 section you’re looking for.',
        ),
        'menu_icon'           => 'dashicons-awards',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'menu_position'       => 5,
        'has_archive'         => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'capability_type'     => 'post',
        'rewrite'             => array('slug' => 'features2'),
        'supports'            => array('title', 'thumbnail', 'editor', 'excerpt'),
    ));

    add_theme_support('post-thumbnails');
}
add_action('init', 'custom_features2');

// === Add Meta Box for Features2 Icon ===
function features2_icon_meta_box() {
    add_meta_box(
        'features2_icon',
        'Features2 Icon',
        'render_features2_icon_meta_box',
        'features2',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'features2_icon_meta_box');

// === Render Meta Box for Features2 Icon ===
function render_features2_icon_meta_box($post) {
    $icon_class = get_post_meta($post->ID, '_features2_icon_class', true);
    wp_nonce_field('save_features2_icon_meta', 'features2_icon_meta_nonce');
    ?>
    <p>
        <label for="features2_icon_class">Icon Class:</label><br>
        <input type="text" id="features2_icon_class" name="features2_icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;">
        <small>Enter the CSS class for the icon. Use classes from a library like Bootstrap Icons.</small>
    </p>
    <?php
}

// === Save Meta Box Data ===
function save_features2_icon_meta($post_id) {
    if (!isset($_POST['features2_icon_meta_nonce']) || !wp_verify_nonce($_POST['features2_icon_meta_nonce'], 'save_features2_icon_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['features2_icon_class'])) {
        update_post_meta($post_id, '_features2_icon_class', sanitize_text_field($_POST['features2_icon_class']));
    }
}
add_action('save_post', 'save_features2_icon_meta');

// Features FAQ
function custom_faq(){
    register_post_type( 'faq',array(
        'labels'=>array(
        'name'=>('FAQ'),
        'singular_name'=>('FAQ'),
        'add_new'=>('Add New FAQ'),
        'add_new_item'=>('Add New FAQ'),
        'edit_item'=>('Edit FAQ'),
        'new_item'=>('New FAQ'),
        'view_item'=>('View FAQ'),
        'not_found'=>('Sorry, we couldnot find the FAQ you are looking for'),
        ),
        'menu_icon'=>'dashicons-awards',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>true,
        'show_ui'=>true,
        'capability_type'=>'post',
        'rewrite'=>array('slug'=>'slider'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_faq');

// FAQ Icon Meta Box
function faq_icon_meta_box() {
    add_meta_box(
        'faq_icon_meta',
        'FAQ Icon',
        'faq_icon_meta_callback',
        'faq',
        'side'
    );
}
add_action('add_meta_boxes', 'faq_icon_meta_box');

function faq_icon_meta_callback($post) {
    $icon_class = get_post_meta($post->ID, '_faq_icon_class', true);
    ?>
    <label for="faq_icon_class">Icon Class (e.g., bi-chevron-right):</label>
    <input type="text" name="faq_icon_class" id="faq_icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;" />
    <?php
}

function save_faq_icon_meta($post_id) {
    if (array_key_exists('faq_icon_class', $_POST)) {
        update_post_meta($post_id, '_faq_icon_class', sanitize_text_field($_POST['faq_icon_class']));
    }
}
add_action('save_post', 'save_faq_icon_meta');








