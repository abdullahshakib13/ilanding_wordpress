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

// custom Hero Stats
// function register_stat_post_type() {
//     register_post_type('stats', array(
//         'labels'      => array(
//             'name'          => __('Stats'),
//             'singular_name' => __('Stat'),
//         ),
//         'public'      => true,
//         'supports'    => array('title', 'editor', 'custom-fields'),
//         'has_archive' => true,
//     ));
// }
// add_action('init', 'register_stat_post_type');

//  // Custom Testimonial
//  function custom_testimonial(){
//     register_post_type( 'testimonial',array(
//         'labels'=>array(
//         'name'=>('Testimonial'),
//         'singular_name'=>('Testimonial'),
//         'add_new'=>('Add New Testimonial'),
//         'add_new_item'=>('Add New Testimonial'),
//         'edit_item'=>('Edit Testimonial'),
//         'new_item'=>('New Testimonial'),
//         'view_item'=>('View Testimonial'),
//         'not_found'=>('Sorry, we couldnot find the Testimonial you are looking for'),
//         ),
//         'menu_icon'=>'dashicons-post-status',
//         'public'=>true,
//         'publicly_queryable'=>true,
//         'exclude_from_search'=>true,
//         'menu_position'=>5,
//         'has_archive'=>true,
//         'hierarchial'=>true,
//         'show_ui'=>true,
//         'capability_type'=>'post',
//         'taxonomies'=>array('category'),
//         'rewrite'=>array('slag'=>'stat'),
//         'supports'=>array('title','thumbnail','editor','excerpt'),

//     ));
//     add_theme_support('post-thumbnails');
// }
// add_action('init','custom_stats');


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

