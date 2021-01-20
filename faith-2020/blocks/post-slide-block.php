<?php 
$block_id = 'post-slide-' . $block['id'];

?>
<div id="<?php echo $block_id; ?>" class="fc-post-slide-block">
  <div class="post-slide-title">
    <div class="container"><?php the_field('section_title'); ?></div>
  </div>
  <div class="post-slide-wrapper layout-scrollbar">
    <div class="post-slides">
      <?php 
      // determine what is supposed to be shown
      $show = get_field('show_in_swim_lane');

      if ($show == 'custom') {
        // custom rows
        if ( have_rows('swim_lane_slides') ) {
          while ( have_rows('swim_lane_slides') ) {
            the_row(); 
            the_swimlane_item(get_sub_field('swim_lane_slide'));
          }
        }
        if (get_field('customize_view_all_button')) {
          ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
            <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
          </a><?php
        }
      } elseif ($show == 'popular') {

        // load up the most popular posts for a post type
        $post_type = get_field('type_to_show');
        $items = get_posts(array(
          'post_type' => $post_type,
          'posts_per_page' => 15,
          'meta_key' => 'fc_view_count',
          'orderby' => 'meta_value_num',
          'order' => 'ASC'
        ));
        foreach ($items as $item) {
          the_swimlane_item($item);
        }
        if (get_field('customize_view_all_button')) {
          ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
            <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
          </a><?php
        } elseif (count($items) == 15) {
          ?><a class="post-slide view-all" href="<?php echo site_url('/search/'); ?>?f=<?php echo $post_type; ?>">
            <div class="view-all-btn">View All</div>
          </a><?php
        }
      } elseif ($show == 'latest') {

        // load up the latest for a post type
        $post_type = get_field('type_to_show');
        $items = get_posts(array(
          'post_type' => $post_type,
          'posts_per_page' => 15,
          'orderby' => 'date',
          'order' => 'ASC'
        ));
        foreach ($items as $item) {
          the_swimlane_item($item);
        }
        if (get_field('customize_view_all_button')) {
          ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
            <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
          </a><?php
        } elseif (count($items) == 15) {
          ?><a class="post-slide view-all" href="<?php echo site_url('/search/'); ?>?f=<?php echo $post_type; ?>">
            <div class="view-all-btn">View All</div>
          </a><?php
        }
      } elseif ($show == 'category') {

        // load up the latest for a category and selected post types
        $post_types = get_field('types_to_show');
        $items = get_posts(array(
          'post_type' => $post_types,
          'cat' => get_field('category'),
          'posts_per_page' => 15,
          'orderby' => 'date',
          'order' => 'DESC'
        ));
        foreach ($items as $item) {
          the_swimlane_item($item);
        }
        if (get_field('customize_view_all_button')) {
          ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
            <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
          </a><?php
        } elseif (count($items) == 15) {
          ?><a class="post-slide view-all" href="<?php echo site_url('/search/'); ?>?cat=<?php echo get_field('category'); ?>">
            <div class="view-all-btn">View All</div>
          </a><?php
        }
      } elseif ($show == 'popCat') {

        // load up the most popular posts for selected category and post types
        $post_types = get_field('type_to_show');
        $items = get_posts(array(
          'post_type' => $post_type,
          'cat' => get_field('category'),
          'posts_per_page' => 15,
          'meta_key' => 'fc_view_count',
          'orderby' => 'meta_value_num',
          'order' => 'ASC'
        ));
        foreach ($items as $item) {
          the_swimlane_item($item);
        }
        if (get_field('customize_view_all_button')) {
          ?><a class="post-slide view-all" href="<?php the_field('view_all_link'); ?>">
            <div class="view-all-btn"><?php the_field('view_all_label'); ?></div>
          </a><?php
        } elseif (count($items) == 15) {
          ?><a class="post-slide view-all" href="<?php echo site_url('/search/'); ?>?cat=<?php echo get_field('category'); ?>">
            <div class="view-all-btn">View All</div>
          </a><?php
        }
      }
      // this little guy here is to ensure spacing at the end when scrolling ?>
      <div class="endcap"></div>
    </div>
  </div>
  <div class="post-more-button"></div>
</div>