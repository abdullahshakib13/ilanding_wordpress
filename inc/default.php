<?php 

// Theme Title
add_theme_support('title-tag');

// Thumbnail Image Area
add_theme_support( 'post-thumbnails', array('page','post',));
add_image_size( 'service', 1200, 300, true);
add_image_size( 'slider', 400, 200, true);
add_image_size( 'project', 400, 200, true);
add_image_size( 'post-thumbnails', 1600, 350, true);

function my_theme_setup(){
    add_theme_support('post-thumbnails');
    add_theme_support( 'post-formats', array( 'aside', 'gallery','image','audio','video' ) );
}
add_action('after_setup_theme','my_theme_setup');