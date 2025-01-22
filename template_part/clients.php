<section id="slider_area">
    <div class="owl-carousel owl-theme">
      <?php query_posts('post_type=slider&post_status=publish&order=ASC&paged='.get_query_var('post')); 
          if(have_posts()){
              while(have_posts()){
                  the_post();
          ?>
              <div class="swiper-slide">
                  <?php echo the_post_thumbnail('slider'); ?>
              </div> 
          <?php 
                  }
              }
          ?>
    </div>
</section> 

