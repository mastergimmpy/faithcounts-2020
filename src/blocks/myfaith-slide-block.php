<?php 
$block_id = 'post-slide-' . $block['id'];
?>
<div id="<?php echo $block_id; ?>" class="fc-post-slide-block">
  <div class="post-slide-title"><?php the_field('section_title'); ?></div>
    <div class="post-slide-wrapper layout-scrollbar">
      <div class="post-slides">
      <?php 
      if ( have_rows('swim_lane_slides') ) {
        while ( have_rows('swim_lane_slides') ) {
          the_row(); 
          $postobject = get_sub_field('swim_lane_slide');
          $post_title = $postobject->post_title;
          $postURL = get_permalink($postobject->ID);  
          $slide_image_array = get_field('headshot_image',$postobject->ID);
          $slide_image = get_image_url($slide_image_array, 'myfaith-slide');
          $slide_text = get_field('religious_affilitaion',$postobject->ID); ?> 
          <a href="<?php echo $postURL; ?>" class="post-slide portrait-slide shortened">
            <div class="slide-image lazy portrait-image" data-bg="url(<?php echo $slide_image; ?>)"><div class="spacer"></div></div>
            <div class="slide-overlay" style="background-image: linear-gradient(transparent , #F7F7F7);"></div>
            <div class="text-position">
              <div class="slide-name"><?php echo $post_title; ?></div>
              <div class="slide-description">"I am <?php echo $slide_text; ?>."</div>
            </div>
          </a>
        <?php
        }
      }
      if (get_field('customize_view_all_button')) {
        ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
          <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
        </a><?php
      } elseif ($postCount == 15) {
        ?><a class="post-slide" href="#">
        <div class="view-all-btn">View All</div>
        </a><?php
      } ?>
      <div class="endcap"></div>
    </div>
  </div>
  <div class="post-more-button"></div>
</div>