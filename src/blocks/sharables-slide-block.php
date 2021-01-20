<?php 
$block_id = 'post-slide-' . $block['id'];

?>
<div id="<?php echo $block_id; ?>" class="fc-post-slide-block sharable-block">
  <?php 
  $postsArray = get_field('swim_lane_slides');
  $postCount = count($postsArray);
  ?>
<div class="post-slide-title"><div class="container"><?php the_field('section_title'); ?></div></div>
  <div class="post-slide-wrapper layout-scrollbar">
    <div class="post-slides">
      <?php 
      if (get_field('show_in_swim_lane') == 'custom') {
        if ( have_rows('swim_lane_slides') ) {
          while ( have_rows('swim_lane_slides') ) {
            the_row(); 
            $postobject = get_sub_field('swim_lane_slide');
            $post_title = $postobject->post_title;
            $postURL = get_permalink($postobject->ID);  
            $slide_image = get_field('image',$postobject->ID );
            $image = get_image_url($slide_image, 'sharable-large'); ?>
            <a href="<?php echo $postURL; ?>" class="post-slide sharableLaunch" data-sharablesrc="<?php echo $image; ?>">
              <div class="slide-image lazy sharables-image" data-bg="url(<?php echo $image; ?>)"></div>
            </a>
          <?php
          }
        }
      } else {
        $items = get_posts(array(
          'post_type' => 'sharables',
          'posts_per_page' => 15,
          'orderby' => 'date',
        ));
        foreach ($items as $item) {
          $post_title = $item->post_title;
          $postURL = get_permalink($item->ID);  
          $slide_image = get_field('image',$item->ID );
          $image = get_image_url($slide_image, 'sharable-large'); ?>
            <a href="<?php echo $postURL; ?>" class="post-slide sharableLaunch" data-sharablesrc="<?php echo $image; ?>">
              <div class="slide-image lazy sharables-image" data-bg="url(<?php echo $image; ?>)"></div>
            </a>
          <?php
        }
      }
      if (get_field('customize_view_all_button')) {
        ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
          <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
        </a><?php
      } elseif ($postCount == 15) {
        ?><a class="post-slide view-all" href="#"><div class="view-all-btn">View All</div></a><?php
      } ?>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="post-more-button"></div>
</div>