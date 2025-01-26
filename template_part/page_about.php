<?php 
query_posts('post_type=about_us&post_status=publish&posts_per_page=3&order=ASC&paged='.get_query_var('paged', 1)); 
if(have_posts()){
    while(have_posts()){
        the_post();
?>
<div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
    <span class="about-meta">MORE ABOUT US</span>
    <h2 class="about-title"><?php the_title(); ?></h2>
    <p class="about-description"><?php the_content(); ?></p>

    <?php 
    // Fetch the features
    $features = get_post_meta(get_the_ID(), '_about_us_features', true); 
    if ($features) { ?>
    <div class="row feature-list-wrapper">
      <div class="col-md-6">
        <ul class="feature-list">
        <?php 
            foreach (array_slice($features, 0, 3) as $feature) { ?>
            <li><i class="<?php echo  get_post_meta($post->ID, '_icon_class', true); ?>"></i> <?php echo esc_html($feature); ?></li>
        <?php }; ?>
        </ul>
      </div>
      <div class="col-md-6">
        <ul class="feature-list">
        <?php 
            foreach (array_slice($features, 3) as $feature) { ?>
            <li><i class="<?php echo  get_post_meta($post->ID, '_icon_class', true); ?>"></i> <?php echo esc_html($feature); ?></li>
        <?php }; ?>
        </ul>
      </div>
    </div>
<?php }; ?>
    <div class="info-wrapper">
      <div class="row gy-4">
        <div class="col-lg-5">
          <div class="profile d-flex align-items-center gap-3">
            <img src="<?php echo get_template_directory_uri(); ?>/img/avatar-1.webp" alt="CEO Profile" class="profile-image">
            <div>
              <h4 class="profile-name"><?php echo get_post_meta($post->ID, '_contact_name', true); ?></h4>
              <p class="profile-position"><?php echo get_post_meta($post->ID, '_contact_role', true); ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="contact-info d-flex align-items-center gap-2">
            <i class="bi bi-telephone-fill"></i>
            <div>
              <p class="contact-label">Call us anytime</p>
              <p class="contact-number"><?php echo get_post_meta($post->ID, '_contact_phone', true); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>      
  </div>
  <?php 
    }}
  ?>
          
  <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
    <div class="image-wrapper">
      <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about-5.webp" alt="Business Meeting" class="img-fluid main-image rounded-4">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about-2.webp" alt="Team Discussion" class="img-fluid small-image rounded-4">
      </div>
      <div class="experience-badge floating">
        <h3>15+ <span>Years</span></h3>
        <p>Of experience in business service</p>
      </div>
    </div>
  </div>