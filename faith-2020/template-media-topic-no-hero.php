<?php
/**
 * Template Name: Media Center Topic No Header
 */
get_header('new'); 
if (have_posts()) : while (have_posts()) : the_post(); ?>
<main>
  <?php
  $image_right = get_image_url(get_field('main_image'), 'topic-hero');
  ?>
  <!-- <div class="fc-hero image-front">
    <div class="container">
        <div class="hero-text-side">
          <div class="hero-upper-text"><?php the_field('hero_upper_text'); ?></div>
          <h1 class="hero-title"><?php the_title(); ?></h1>
          
        </div>  
    </div>
  </div> -->
  <?php the_content(); ?>
  <?php $headshot_image = get_image_url(get_field('headshot_image', 'contact_info'), 'headshot'); ?>
  <div class="fc-contact-cta end-of-page">
    <div class="container">
      <div class="headshot-image" style="background-image:url(<?php echo $headshot_image; ?>);"><div class="spacer"></div></div>
      <div class="cta-text">
        <div class="post-slide-title"><?php the_field('cta_title', 'contact_info'); ?></div>
        <p class="strong uppercase"><?php the_field('cta_description', 'contact_info'); ?></p>
        <p class="uppercase">
          <?php the_field('contact_name', 'contact_info'); ?><br>
          <?php the_field('contact_position', 'contact_info'); ?><br>
          Phone: <a href="tel:<?php the_field('contact_phone', 'contact_info'); ?>"><?php the_field('contact_phone', 'contact_info'); ?></a><br>
          <a href="mailto:<?php the_field('contact_email', 'contact_info'); ?>"><?php the_field('contact_email', 'contact_info'); ?></a>
        </p>
      </div>
    </div>
  </div>
</main>
<?php 
endwhile; endif;
get_footer();