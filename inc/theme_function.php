<?php 

    function shakib_customizer_register($wp_customize){
        // footer section
        $wp_customize->add_section('shakib_footer_option',array(
            'title'=> __('Footer Option','shakib'),
            'description'=>'if you interested to change or update your footer position you can do it',
        ));
        $wp_customize->add_setting('shakib_copyright_section',array(
            'default'=>'© Copyright iLanding All Rights Reserved by Shakib',
        ));
        $wp_customize->add_control('shakib_copyright_section',array(
            'label'=>'copyright Text',
            'description'=>"you can update your copyright text from here",
            'setting'=>'shakib_copyright_section',
            'section'=>'shakib_footer_option',
        ));
    }
    add_action('customize_register','shakib_customizer_register');