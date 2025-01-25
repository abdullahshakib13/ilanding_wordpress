<?php 
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
        'rewrite'=>array('slag'=>'service'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_service');

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
    ?>
    <label for="testimonial_designation">Designation:</label>
    <input type="text" name="testimonial_designation" id="testimonial_designation" value="<?php echo esc_attr($designation); ?>" style="width: 100%;" />
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
}
add_action('save_post', 'save_testimonial_designation');


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
        'rewrite'=>array('slag'=>'slider'),
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

    // Sanitize and save the animation delay
    // if (isset($_POST['feature_animation_delay'])) {
    //     update_post_meta($post_id, '_feature_animation_delay', intval($_POST['feature_animation_delay']));
    // }
}
add_action('save_post', 'save_feature_box_meta');
add_action('wp_head', function() {
    if (is_singular('feature_box')) {
        $icon_class = get_post_meta(get_the_ID(), '_feature_icon_class', true);
        error_log('Icon Class: ' . $icon_class);
    }
});


//========== 
// function register_feature_boxes_cpt() {
//     $labels = array(
//         'name'                  => _x('Feature Boxes', 'Post type general name', 'textdomain'),
//         'singular_name'         => _x('Feature Box', 'Post type singular name', 'textdomain'),
//         'menu_name'             => _x('Feature Boxes', 'Admin Menu text', 'textdomain'),
//         'name_admin_bar'        => _x('Feature Box', 'Add New on Toolbar', 'textdomain'),
//         'add_new'               => __('Add New', 'textdomain'),
//         'add_new_item'          => __('Add New Feature Box', 'textdomain'),
//         'edit_item'             => __('Edit Feature Box', 'textdomain'),
//         'new_item'              => __('New Feature Box', 'textdomain'),
//         'view_item'             => __('View Feature Box', 'textdomain'),
//         'all_items'             => __('All Feature Boxes', 'textdomain'),
//         'search_items'          => __('Search Feature Boxes', 'textdomain'),
//         'not_found'             => __('No feature boxes found.', 'textdomain'),
//         'not_found_in_trash'    => __('No feature boxes found in Trash.', 'textdomain'),
//     );

//     $args = array(
//         'labels'             => $labels,
//         'public'             => true,
//         'menu_icon'          => 'dashicons-awards',
//         'supports'           => array('title', 'editor', 'custom-fields'),
//         'has_archive'        => true,
//         'rewrite'            => array('slug' => 'feature-boxes'),
//     );

//     register_post_type('feature_box', $args);
// }
// add_action('init', 'register_feature_boxes_cpt');

// =========

// === Features2
function custom_features2(){
    register_post_type( 'features2',array(
        'labels'=>array(
        'name'=>('Features 2'),
        'singular_name'=>('Feature 2'),
        'add_new'=>('Add New Feature 2'),
        'add_new_item'=>('Add New Feature 2'),
        'edit_item'=>('Edit Feature 2'),
        'new_item'=>('New Feature 2'),
        'view_item'=>('View Feature 2'),
        'not_found'=>('Sorry, we couldnot find the Feature 2 Section you are looking for'),
        ),
        'menu_icon'=>'dashicons-awards',
        'public'=>true,
        'publicly_queryable'=>true,
        'exclude_from_search'=>true,
        'menu_position'=>5,
        'has_archive'=>true,
        'hierarchial'=>false,
        'show_ui'=>true,
        'capability_type'=>'post',
        'rewrite'=>array('slug'=>'features2'),
        'supports'=>array('title','thumbnail','editor','excerpt'),

    ));
    add_theme_support('post-thumbnails');
}
add_action('init','custom_features2');

// Add Meta Box for Features2 Icon
function features2_icon_meta_box() {
    add_meta_box(
        'features2_icon',                  // Meta box ID
        'Features2 Icon',                  // Title
        'render_features2_icon_meta_box', // Callback function to render the box
        'features2',                       // Post type (replace with your stats custom post type slug)
        'normal',                          // Context (normal, side, advanced)
        'high'                             // Priority
    );
}
add_action('add_meta_boxes', 'features2_icon_meta_box');

// Render Meta Box for Features2 Icon
function render_features2_icon_meta_box($post) {
    // Retrieve the saved value if available
    $icon_class = get_post_meta($post->ID, '_features2_icon_class', true);

    // Add a nonce field for security
    wp_nonce_field('save_features2_icon_meta', 'features2_icon_meta_nonce');

    ?>
    <p>
        <label for="features2_icon_class">Icon Class (e.g., "bi bi-award"):</label><br>
        <input type="text" id="features2_icon_class" name="features2_icon_class" value="<?php echo esc_attr($icon_class); ?>" style="width: 100%;">
        <small>Enter the CSS class for the icon. Use classes from a library like Bootstrap Icons.</small>
    </p>
    <?php
}

// Save Meta Box Data
function save_features2_icon_meta($post_id) {
    // Check nonce for security
    if (!isset($_POST['features2_icon_meta_nonce']) || !wp_verify_nonce($_POST['features2_icon_meta_nonce'], 'save_features2_icon_meta')) {
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
    if (isset($_POST['features2_icon_class'])) {
        update_post_meta($post_id, '_features2_icon_class', sanitize_text_field($_POST['features2_icon_class']));
    }
}
add_action('save_post', 'save_features2_icon_meta');




