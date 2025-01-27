<?php 
    function shakib_widgets_register(){
        register_sidebar(array(
            'name'=> __('Footer 1','shakib'),
            'id'=> 'footer-1',
            'description'=> __('Appears in the Sidebar in blog page and also other page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Footer 2','shakib'),
            'id'=> 'footer-2',
            'description'=> __('Appears in the Sidebar in blog page and also other page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Footer 3','shakib'),
            'id'=> 'footer-3',
            'description'=> __('Appears in the Sidebar in blog page and also other page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Footer 4','shakib'),
            'id'=> 'footer-4',
            'description'=> __('Appears in the Sidebar in blog page and also other page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Footer 5','shakib'),
            'id'=> 'footer-5',
            'description'=> __('Appears in the Sidebar in blog page and also other page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Contact Info','shakib'),
            'id'=> 'contact-info',
            'description'=> __('Appears in the page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));
        register_sidebar(array(
            'name'=> __('Contact Form','shakib'),
            'id'=> 'contact-form',
            'description'=> __('Appears in the page','shakib'),
            'before_widget'=> '<div class="child_sidebar">',
            'after_widget'=> '</div>',
            'before_title'=>'<h2 class="title">',
            'after_title'=> '</h2>',
        ));

    }
    add_action('widgets_init','shakib_widgets_register');