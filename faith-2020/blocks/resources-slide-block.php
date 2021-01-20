<?php 
$block_id = 'post-slide-' . $block['id'];

?>
<div id="<?php echo $block_id; ?>" class="fc-post-slide-block resources-block">
  <?php 
  $postsArray = get_field('swim_lane_slides');
  $postCount = count($postsArray);
  ?>
  <div class="post-slide-title"><div class="container"><?php the_field('section_title'); ?> <?php if ($postCount == 15) { ?><a href="#" class="title-view">View All</a><?php } ?></div></div>
    <div class="post-slide-wrapper layout-scrollbar">
      <div class="post-slides">
      <?php 
      if ( have_rows('swim_lane_slides') ) {
        while ( have_rows('swim_lane_slides') ) {
          the_row(); 
          $postobject = get_sub_field('swim_lane_slide');
          $post_title = $postobject->post_title;
          $postURL = get_permalink($postobject->ID);  
          $slide_image = get_the_post_thumbnail_url( $postobject->ID, 'sharable-slider' );
          $post_type = $postobject->post_type;
          $post_icon = '';
          $linked = '';
          if ($post_type == 'videos') {
            $post_icon = 'video-icon';
          } elseif ($post_type == 'podcasts') {
            $post_icon = 'mic-icon';
          } elseif ($post_type == 'post') {
            $post_icon = 'reading-icon';
          } elseif ($post_type == 'downloads') {
            $post_icon = 'download-icon';
          } ?> 
          <a href="<?php echo $postURL; ?>" <?php if ($post_type == 'downloads') {
            echo 'download';
          } ?> class="post-slide resources">
            <div class="slide-image lazy resources-image <?php echo $post_icon; ?>" data-bg="url(<?php echo $slide_image; ?>)"></div>
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