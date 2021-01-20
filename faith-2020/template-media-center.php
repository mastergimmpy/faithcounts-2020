<?php
/**
 * Template Name: Media Center
 */
get_header('new'); 
if (have_posts()) : while (have_posts()) : the_post(); ?>
<main>
  <div class="fc-hero no-image">
    <div class="container">
        <div class="hero-text-side">
          <div class="hero-upper-text"><?php the_field('hero_upper_text'); ?></div>
          <h1 class="hero-title"><?php the_title(); ?></h1>
         <!-- <div class="hero-image-side" style="background-image:url(<?php echo $image_right; ?>"></div> -->
          <?php the_field('hero_description'); ?>
        </div>
    </div>
  </div>
  <div class="fc-icon-text-block">
    <div id="mediaSlider" class="container layout-scrollbar">
      <?php
      if ( have_rows('media_center_topic_pages') ) {
        while ( have_rows('media_center_topic_pages') ) {
          the_row(); 
          $postobject = get_sub_field('topic_page');
          $postURL = get_permalink($postobject->ID);
          $postImgArray = get_field('thumbnail_main_image',$postobject->ID);
          $postImg = get_image_url($postImgArray, 'logo-block'); ?>
          <a href="<?php echo $postURL; ?>" class="icon-text-block">
              <img src="<?php echo $postImg; ?>" class="icon-image" />
              <div class="text-position">
                  <div class="slide-name"><?php echo $postobject->post_title; ?></div>
                  <div class="slide-description"><?php the_field('thumbnail_description',$postobject->ID); ?></div>
              </div>
          </a>
          <?php
        }
      }
      ?>
    </div>
  </div>
  <?php the_content(); ?>
</main>
<?php 
endwhile; endif;
get_footer();