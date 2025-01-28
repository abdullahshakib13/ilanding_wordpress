<?php
              query_posts('post_type=count&post_status=publish&post_per_page=3&order=ASC&paged='.get_query_var('post')); 
              if(have_posts()){
                while(have_posts()){
                    the_post();
            ?>
             <div class="col-lg-3 col-md-6">
                
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo get_post_meta($post->ID, '_count_number', true); ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?php the_title(); ?></p>
            </div>
            
          </div><!-- End Stats Item -->
          <?php 
                };
            };
            ?>

          <!-- <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div> -->
          <!-- End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div> -->
          <!-- End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div> -->
          <!-- End Stats Item -->