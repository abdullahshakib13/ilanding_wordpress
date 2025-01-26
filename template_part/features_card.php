<?php 
    query_posts('post_type=features_card&post_status=publish&post_per_page=-1&order=ASC&paged='.get_query_var('post')); 
    if(have_posts()){
        while(have_posts()){
            the_post();
            $icon_class = get_post_meta(get_the_ID(), '_feature_icon_class', true);
            $background_color = get_post_meta(get_the_ID(), '_feature_background_color', true);
  ?>
<div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="feature-box <?php echo esc_attr($background_color); ?>">
              <i class="<?php echo esc_attr($icon_class); ?>"></i>
              <h4><?php the_title(); ?></h4>
              <p><?php the_content(); ?></p>
            </div>
          </div><!-- End Feature Borx-->
          <?php 
        };
      };
            ?>

          