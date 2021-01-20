<?php

/**
 * This file includes the custom blocks that are used on the site.
 */

// register the Faith Counts block category
function fc_plugin_block_categories($categories, $post) {
  if ($post->post_type !== 'page') {
    return $categories;
  }
  return array_merge(
      $categories,
      array(
          array(
              'slug' => 'fc-category',
              'title' => 'Faith Counts',
          ),
      )
  );
}
add_filter('block_categories', 'fc_plugin_block_categories', 10, 2);

function fc_add_acf_custom_blocks() {
  acf_register_block(array(
    'name' => 'fc-hero-block',
    'title' => 'Hero',
    'description' => 'Shows a hero image (and text) on a page.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/hero-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-post-slide-block',
    'title' => 'Post Swim Lane',
    'description' => 'Shows a swim lane with up to 15 posts and a title with rectagular imges.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/post-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-series-slide-block',
    'title' => 'Series Pages Swim Lane',
    'description' => 'Shows a swim lane with up to 15 pages and a title with round images.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/series-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-sharables-slide-block',
    'title' => 'Sharables Swim Lane',
    'description' => 'Shows a swim lane with up to 15 sharables and a title with square images.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/sharables-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-page-title-light-block',
    'title' => 'Page title with light font',
    'description' => 'Shows a page title in light font with a subtitle below.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/page-title-light-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-video-hero-block',
    'title' => 'Video Hero',
    'description' => 'Shows a background image clickable to play a video',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/video-hero-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-logos-block',
    'title' => 'Logos',
    'description' => 'Shows rows of logos under a section title.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/logos-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-contact-cta-block',
    'title' => 'Contact CTA',
    'description' => 'Shows contact information and image of a person.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/contact-cta-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-resources-slide-block',
    'title' => 'Resources Swim Lane',
    'description' => 'Shows a swim lane with up to 15 Resources and a title with square images.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/resources-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-form-block',
    'title' => 'Form',
    'description' => 'Shows submit form for people to sign up for #myfaith.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/form-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-myfaith-slide-block',
    'title' => 'MyFaith Swim Lane',
    'description' => 'Shows a swim lane with up to 15 myfaith members clickable to their profile.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/myfaith-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'fc-portrait-slide-block',
    'title' => 'Portrait Swim Lane',
    'description' => 'Shows a swim lane with up to 15 portrait members clickable to their profile.',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/portrait-slide-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'my-faith-heading-block',
    'title' => '#myfaith Heading',
    'description' => 'Creates the special heading block which exists on the #myfaith page',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/my-faith-heading-block.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
      // only enable if it should appear once on a page (usually not what you want)
      // 'multiple' => false,
    ),
    'icon' => 'id'
  ));
  acf_register_block(array(
    'name' => 'category-grid-block',
    'title' => 'Category Grid',
    'description' => 'Grid layout of posts of a specific category',
    'render_template' => plugin_dir_path(__FILE__) . 'blocks/category-grid.php',
    'category' => 'fc-category',
    'align' => 'full',
    'supports' => array(
      'align' => false,
    ),
    'icon' => 'id'
  ));
}
add_action('acf/init', 'fc_add_acf_custom_blocks');
