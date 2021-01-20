<?php

/*
 * Init necessary things for site
 */
function faith_site_init() {
  add_image_size('home-hero', 1440, 570, true);
  add_image_size('post-slider', 411, 200, true);
  add_image_size('series-slider', 250, 250, true);
  add_image_size('sharable-slider', 411, 411, true);
  add_image_size('sharable-large', 701, 701, true);
  add_image_size('video-hero', 1147, 649, true);
  add_image_size('logo-block', 400, 400, true);
  add_image_size('headshot', 200, 200, true);
  add_image_size('topic-hero', 700, 560, true);
  add_image_size('headshot-image', 414, 414, true);
  add_image_size('myfaith-slide', 360, 500, true);
  add_image_size('portrait-slide', 360, 649, true);
  add_image_size('signature', 264, 82, true);
  add_image_size('podcast-main', 1100, 275, true);
  add_image_size('podcast-thumb', 680, 381, true);

  register_nav_menus( array(
    'main'  => __( 'Main Menu' ),
    'media-center-menu' => __( 'Media Center' )
  ));

  register_post_type('videos', array(
		'label' => __('Videos'),
		'singular_label' => __('Video'),
		'show_in_rest' => true,
		'labels' => array(
			'add_new' => 'Add New Video',
			'add_new_item' => 'Add New Video',
			'edit_item' => 'Edit Video',
			'new_item' => 'New Video',
			'view_item' => 'View Video',
      'not_found' => 'No videos found',
      'archives' => 'Videos',
		),
		'public' => true,
    'show_in_nav_menus' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-video-alt3',
		'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));
  
  register_post_type('sharables', array(
		'label' => __('Sharables'),
		'singular_label' => __('Sharable'),
		'show_in_rest' => true,
		'labels' => array(
			'add_new' => 'Add New Sharable',
			'add_new_item' => 'Add New Sharable',
			'edit_item' => 'Edit Sharable',
			'new_item' => 'New Sharable',
			'view_item' => 'View Sharable',
      'not_found' => 'No sharables found',
      'archives' => 'Sharables',
		),
		'public' => true,
    'show_in_nav_menus' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-share',
		'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));
  
  register_post_type('podcasts', array(
		'label' => __('Podcasts'),
		'singular_label' => __('Podcast'),
		'labels' => array(
			'add_new' => 'Add New Podcast',
			'add_new_item' => 'Add New Podcast',
			'edit_item' => 'Edit Podcast',
			'new_item' => 'New Podcast',
			'view_item' => 'View Podcast',
      'not_found' => 'No podcasts found',
      'archives' => 'Podcasts',
		),
		'public' => true,
    'publicly_queryable' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-controls-volumeon',
    'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));

  register_post_type('downloads', array(
		'label' => __('Downloads'),
		'singular_label' => __('Download'),
		'labels' => array(
			'add_new' => 'Add New Download',
			'add_new_item' => 'Add New Download',
			'edit_item' => 'Edit Download',
			'new_item' => 'New Download',
			'view_item' => 'View Download',
      'not_found' => 'No downloads found',
      'archives' => 'Downloads',
		),
		'public' => true,
    'publicly_queryable' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-download',
    'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));

  register_post_type('portraits', array(
		'label' => __('Portraits'),
		'singular_label' => __('Portrait'),
		'labels' => array(
			'add_new' => 'Add New Portrait',
			'add_new_item' => 'Add New Portrait',
			'edit_item' => 'Edit Portrait',
			'new_item' => 'New Portrait',
			'view_item' => 'View Portrait',
			'not_found' => 'No portraits found',
      'archives' => 'Portraits',
		),
    'public' => true,
    'show_in_nav_menus' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-groups',
    'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));


  register_post_type('myfaith', array(
		'label' => __('#MyFaith'),
		'singular_label' => __('#MyFaith'),
		'labels' => array(
			'add_new' => 'Add New Entry',
			'add_new_item' => 'Add New Entry',
			'edit_item' => 'Edit Entry',
			'new_item' => 'New Entry',
			'view_item' => 'View Entry',
			'not_found' => 'No entries found',
		),
		'public' => true,
    'publicly_queryable' => true,
		'show_ui' => true, // UI in admin panel
		'capability_type' => 'post',
		'menu_position' => 5,
		'menu_icon' => 'dashicons-format-status',
    'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'thumbnail', 'revisions'),
    'taxonomies' => array('category')
  ));
}
add_action('init', 'faith_site_init');

if (!isset($content_width)) {
  $content_width = 1440;
}

/*
 * Queue up stylesheet and scripts. Everything bundled into two files via webpack.
 */
function webpack_scripts() {
  if (!is_admin()) {
    wp_deregister_script('wp-embed');
  }
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,700&display=swap', array(), null);
  wp_enqueue_style( 'webpack-css', get_stylesheet_directory_uri() . '/main.7c4421305e1e290ef368.css', array(), null);
  wp_enqueue_script( 'webpack-js', get_template_directory_uri() . '/main.7c4421305e1e290ef368.js', array(), null, true );
  wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/jquery-3.5.1.min.js', array( 'jQuery' ), '3.5.1', true);
  wp_localize_script( 'webpack-js', 'fcWp', array(
    'baseUrl' => site_url(),
		// 'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
	) );
  
}
add_action('wp_enqueue_scripts', 'webpack_scripts');

/*
 * Queue up block stylesheet and scripts for editors. Everything bundled into two files via webpack.
 */
function block_webpack_scripts() {
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap', array(), null);
  wp_enqueue_style( 'editor-css', get_stylesheet_directory_uri() . '/editor.7c4421305e1e290ef368.css', array(), null);
  wp_enqueue_script( 'editor-js', get_template_directory_uri() . '/editor.7c4421305e1e290ef368.js', array(), null, true );
}
add_action('admin_init', 'block_webpack_scripts');


/**
 * Used for saving the ACF settings to json files. This will work in the build system
 * And will be replaced with the appropriate folder based on gulp's settings.
 **/
function webpack_acf_json_save_point( $orig_path ) {
  $path = 'C:\wamp64\www\faithcounts\wp-content\themes\src\acf-json';
  return $path;
}
add_filter('acf/settings/save_json', 'webpack_acf_json_save_point');

// determines whether ACF menu should show on the Wordpress admin screens.
// Defaults to true but gulp will replace it to return false so it will be
// hidden on the production build
// add_filter("acf/settings/show_admin", "__return_false");

if (function_exists('acf_add_options_page') && current_user_can('manage_options')) {
  acf_add_options_page(array(
     'page_title' => 'Site Settings',
     'post_id' => 'global_options',
     'icon_url' => 'dashicons-admin-site-alt3'
   ));
  acf_add_options_page(array(
    'page_title' => 'Contact Info',
    'post_id' => 'contact_info'
  ));
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Wordpress sticky post default functionality is buggy and so 
 * sticky posts must be placed at top manually
 */
function bump_sticky_posts_to_top($posts) {
  foreach ($posts as $i => $post) {
    if (is_sticky($post->ID)) {
      $stickies[] = $post;
      unset($posts[$i]);
    }
  }
    
  if (!empty($stickies)) {
    return array_merge($stickies, $posts);
  }
    
  return $posts;
}
add_filter('the_posts', 'bump_sticky_posts_to_top');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array('wpemoji') );
  } else {
    return array();
  }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array($emoji_svg_url) );
  }
  return $urls;
}

// used to get the best fit file size based on size passed in
function get_image_url($img, $size) {
  if (is_numeric($img)) {
    $img = wp_get_attachment_image_src($img, $size);
    if ($img) {
      return $img[0];
    }
  }

  if ($img) {
    if (array_key_exists('sizes', $img) && array_key_exists($size, $img['sizes'])) {
      return $img['sizes'][$size];
    } else {
      return $img['url'];
    }
  }
  return '';
}

function vimeo_link($url) {
  if (preg_match('/vimeo\.com(\/video)?\/([0-9]{1,10})/i', $url, $match)) {
    return 'https://player.vimeo.com/video/' . $match[2];
  }
  return FALSE;
}

function youtube_link($url) {
  if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
    return 'https://www.youtube.com/embed/' . $match[1] . '?rel=0&wmode=transparent&modestbranding=1';
  }
  return FALSE;
}

/** Massages Youtube and Vimeo links so they work for embedding. */
function video_link($url) {
  $vimeo = vimeo_link($url);
  if ($vimeo) {
    return $vimeo;
  }
  return youtube_link($url);
}

add_theme_support( 'post-thumbnails' );

if (!is_admin()) {
  function wpb_search_filter($query) {
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }
    return $query;
  }
  add_filter('pre_get_posts','wpb_search_filter');
}

add_theme_support( 'post-thumbnails' );

add_filter( 'pre_get_posts', 'tgm_io_cpt_search' );
/**
 * This function modifies the main WordPress query to include an array of
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function tgm_io_cpt_search( $query ) {
  if ( $query->is_search ) {
    $query->set( 'post_type', array('post', 'videos', 'podcasts', 'sharables', 'downloads') );
  }

  return $query;
}

$the_query = new WP_Query( array('s' => 'test') );

//set rgb value from acf colorpicker
function hex2rgb($hex) {
  $hex = str_replace("#", "", $hex);
	
  if (strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1) . substr($hex,0,1));
    $g = hexdec(substr($hex,1,1) . substr($hex,1,1));
    $b = hexdec(substr($hex,2,1) . substr($hex,2,1));
  } else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
  }
  $rgb = array($r, $g, $b);
	
  return $rgb; // returns an array with the rgb values
}

// deals with incrementing the view count for the current entity (download, podcast, etc.)
function increment_view_count() {
  $count = (int)get_field('fc_view_count');
  $count++;
  update_field('fc_view_count', $count);
}

// Finds the number of each post type in specific wordpress query
function get_post_count_in_query($query) {
  $counts = [];
  foreach ($query->posts as $post) {
    if ($counts[$post->post_type]) {
      $counts[$post->post_type]++;
    } else {
      $counts[$post->post_type] = 1;
    }
  }
  return $counts;
}

// Maps each category id to the catagory name
function get_category_map() {
  $cats = get_categories();
  $map = [];
  foreach ($cats as $cat) {
    $map[$cat->category_nicename] = $cat->term_id;
  }
  return $map;
}

// echoes out the swimlane item passed in
function the_swimlane_item($item, $img_type = 'post-slider') {
  $post_title = $item->post_title;
  $postURL = get_permalink($item->ID);  
  $slide_image = get_the_post_thumbnail_url( $item->ID, 'post-slider' );
  if (!$slide_image) {
    // try and get the image on the item if one exists
    $slide_image = get_image_url(get_field('image', $item->ID), 'post-slider');
  }
  $post_type = $item->post_type;
  $post_icon = '';
  if ($post_type == 'videos') {
    $post_icon = 'video-icon';
  } elseif ($post_type == 'podcasts') {
    $post_icon = 'mic-icon';
  } elseif ($post_type == 'post') {
    $post_icon = 'reading-icon';
  } elseif ($post_type == 'downloads') {
    $post_icon = 'download-icon';
  } ?> 
  <a href="<?php echo $postURL; ?>" class="post-slide" <?php echo $post_type == 'downloads' ? 'download target="_blank"' : ''; ?>>
    <div class="slide-image lazy <?php echo $post_icon; ?>" data-bg="url(<?php echo $slide_image; ?>)"></div>
    <div class="slide-title"><?php echo $post_title; ?></div>
  </a><?php
}

// used to keep track of whether the last block was a non-custom block
// if so, and the current block is a custom block, then the last block
// needs to be closed
$prev_block_is_standard = false;
function fc_block_wrapper($block_content, $block) {
  global $post, $prev_block_is_standard;
  if ($block['blockName'] == '') {
    // do nothing here
    return $block_content;
  }
  // keep out the resource center template as that already has everything wrapped up
  if (substr($block['blockName'], 0, 6) == 'acf/fc') {
    if ($prev_block_is_standard) {
      $block_content = '</div>' . $block_content;
      $prev_block_is_standard = false;
    }
  } else {
    if (!$prev_block_is_standard) {
      $block_content = '<div class="narrow-container">' . $block_content;
      $prev_block_is_standard = true;
    }
  }
  return $block_content;
}
add_filter('render_block', 'fc_block_wrapper', 10, 2);

function fc_finish_content($content) {
  global $prev_block_is_standard;
  if ($prev_block_is_standard) {
    return '</div>' . $content;
  }
  return $content;
}
add_filter('the_content', 'fc_finish_content');

// legacy content doesn't have blocks so the events aren't firing. As a precaution, on posts, starting and ending with narrow-container wrappers
function fc_start_wrapper() {
  ?><div class="narrow-container"><?php
}
function fc_end_wrapper() {
  ?></div><?php
}

// testing fix for blocks
function fc_content_wrapper_fix() {
  ?><div class="narrow-container"><?php the_content() ?></div><?php
}


// for relevanssi search we need to wire in specific filtering on the query
function fc_relevanssi_search($wp_query) {
  // error_log(print_r($wp_query, true));
  foreach ($wp_query->query_vars as $key => $val) {
    error_log("$key => " . print_r($val, true) . "\n");
  }
}
add_filter('relevanssi_modify_wp_query', 'fc_relevanssi_search', 10, 1);

function fc_relevanssi_acf_fields($value, $field_name, $post_id) {
  error_log("Looking at $value for $field_name of $post_id\n");
}
add_filter('relevanssi_acf_field_value', 'fc_relevanssi_acf_fields', 10, 3);

require_once 'functions-blocks.php';

