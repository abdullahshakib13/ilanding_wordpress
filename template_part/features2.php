
  <!-- Left Column -->
  <div class="col-lg-4">
    <?php
    // Query for the first three posts (left column)
    $left_query = new WP_Query(array(
      'post_type'      => 'features2',
      'post_status'    => 'publish',
      'posts_per_page' => 3,
      'orderby'        => 'date',
      'order'          => 'ASC',
      'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    ));

    if ($left_query->have_posts()) :
      while ($left_query->have_posts()) : $left_query->the_post();
        $icon_class = get_post_meta(get_the_ID(), '_features2_icon_class', true); // Retrieve the icon class
    ?>
        <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
          <div class="d-flex align-items-center justify-content-end gap-4">
            <div class="feature-content">
              <h3><?php the_title(); ?></h3>
              <p><?php the_content(); ?></p>
            </div>
            <div class="feature-icon flex-shrink-0">
              <i class="<?php echo esc_attr($icon_class); ?>"></i>
            </div>
          </div>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>

  <!-- Middle Column (Image) -->
  <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
    <div class="phone-mockup text-center">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/phone-app-screen.webp" alt="Phone Mockup" class="img-fluid">
    </div>
  </div>

  <!-- Right Column -->
  <div class="col-lg-4">
    <?php
    // Query for the next three posts (right column)
    $right_query = new WP_Query(array(
      'post_type'      => 'features2',
      'post_status'    => 'publish',
      'posts_per_page' => 3,
      'orderby'        => 'date',
      'order'          => 'ASC',
      'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
      'offset'         => 3, // Skip the first 3 posts for the right column
    ));

    if ($right_query->have_posts()) :
      while ($right_query->have_posts()) : $right_query->the_post();
        $icon_class = get_post_meta(get_the_ID(), '_features2_icon_class', true); // Retrieve the icon class
    ?>
        <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="200">
          <div class="d-flex align-items-center gap-4">
            <div class="feature-icon flex-shrink-0">
              <i class="<?php echo esc_attr($icon_class); ?>"></i>
            </div>
            <div class="feature-content">
              <h3><?php the_title(); ?></h3>
              <p><?php the_content(); ?></p>
            </div>
          </div>
        </div>
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>

