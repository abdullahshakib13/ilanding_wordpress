<?php 
    query_posts('post_type=faq&post_status=publish&post_per_page=-1&order=ASC&paged='.get_query_var('post')); 
    if(have_posts()){
        while(have_posts()){
            the_post();     
?>
<div class="faq-item ">
    <h3><?php the_title(); ?></h3>
    <div class="faq-content" >
        <p><?php the_content(); ?></p>
    </div>
    <i class="faq-toggle <?php echo get_post_meta($post->ID, '_faq_icon_class', true); ?>"></i>
</div><!-- End Faq item-->
<?php 
     };
    };
?>
