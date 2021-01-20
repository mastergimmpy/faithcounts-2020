<?php 
$block_id = 'series-slide-' . $block['id'];

?>
<div class="fc-post-slide-block series-block">
  <?php 
  $postsArray = get_field('swim_lane_slides');
  $postCount = count($postsArray);
  ?>
  <div class="post-slide-title">
    <div class="container"><?php the_field('section_title'); ?></div>
  </div>
  <div class="post-slide-wrapper layout-scrollbar">
    <div class="post-slides">
      <?php 
      if ( have_rows('swim_lane_slides') ) {
        while ( have_rows('swim_lane_slides') ) {
          the_row(); 
          $postobject = get_sub_field('swim_lane_slide');
          $post_title = $postobject->post_title;
          $postURL = get_permalink($postobject->ID);  
          $slide_image = get_the_post_thumbnail_url( $postobject->ID, 'series-slider' ); ?>
          <a href="<?php echo $postURL; ?>" class="post-slide series-slide">
            <div class="slide-image lazy series-image" data-bg="url(<?php echo $slide_image; ?>)"></div>
            <div class="slide-title"><?php echo $post_title; ?></div>
          </a>

        <?php
        }
      }
      if (get_field('customize_view_all_button')) {
        ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
          <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
        </a><?php
      } elseif ($postCount == 15) {
        ?><a class="post-slide view-all" href="#">
            <div class="view-all-btn">View All</div>
        </a><?php
      } ?>
      <div class="endcap"></div>
    </div>
  </div>
  <div class="post-more-button"></div>
</div>