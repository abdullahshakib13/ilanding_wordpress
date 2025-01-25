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

          <!-- <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-box blue">
              <i class="bi bi-patch-check"></i>
              <h4>Explicabo consectetur</h4>
              <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
            </div>
          </div> -->
          <!-- End Feature Borx-->

          <!-- <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="feature-box green">
              <i class="bi bi-sunrise"></i>
              <h4>Ullamco laboris</h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
            </div>
          </div> -->
          <!-- End Feature Borx-->

          <!-- <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="feature-box red">
              <i class="bi bi-shield-check"></i>
              <h4>Labore consequatur</h4>
              <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
            </div>
          </div> -->
          <!-- End Feature Borx-->