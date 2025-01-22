<section id="slider_area">
    <div class="owl-carousel owl-theme">
    <?php query_posts('post_type=slider&post_status=publish&post_per_page=3&order=ASC&paged='.get_query_var('post')); 
        if(have_posts()){
            while(have_posts()){
                the_post();
        ?>
            <div>
                <?php echo the_post_thumbnail('slider'); ?>
            </div> 
        <?php 
                }
            }
        ?>
    </div>
</section> 

<!-- <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
          <section id="slider_area">
    <div class="owl-carousel owl-theme">
    <?php 
    //query_posts('post_type=slider&post_status=publish&post_per_page=3&order=ASC&paged='.get_query_var('post')); 
      //  if(have_posts()){
        //    while(have_posts()){
          //      the_post();
        ?>
            <div>
                
            </div> 
            <div class="swiper-slide">
              <img src="<?php //echo the_post_thumbnail('slider'); ?>" class="img-fluid" alt="">
            </div>
        <?php 
                //}
            //}
        ?>
    </div>
</section>
</div>
          <div class="swiper-pagination"></div> -->
            
            <!-- <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div> -->
          
       

          <!-- Owl Carousel -->
<!-- <section id="slider_area">
    <div class="owl-carousel owl-theme">
    <?php //query_posts('post_type=slider&post_status=publish&post_per_page=3&order=ASC&paged='.get_query_var('post')); 
        //if(have_posts()){
           // while(have_posts()){
               // the_post();
        ?>
            <div>
                <?php// echo the_post_thumbnail('slider'); ?>
            </div> 
        <?php 
                //}
            //}
        ?>
    </div>
</section> -->
<!-- Owl Carousel -->