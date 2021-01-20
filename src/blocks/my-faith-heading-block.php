<?php
// unique id for this block, can be helpful to differentiate if necessary in javascript
$block_id = 'my-faith-heading-' . $block['id'];
?>
<div class="fc-hero my-faith-heading" style="background-image:url(<?php echo $hero_image; ?>);">
  <div class="container">
    <div class="hero-upper-text"><?php the_field('heading_upper_text'); ?></div>
    <div class="hero-title"><?php the_field('heading_title'); ?></div>
    <?php the_field('heading_content'); ?>
    <div class="clearfix"></div>
    <?php
    if (!empty($hero_button_text) && !empty($hero_button_url) && $series_hero) { ?>
      <a href="<?php echo $hero_button_url; ?>" class="btn-link"><?php echo $hero_button_text; ?></a>
    <?php } elseif (!empty($hero_button_text) && !empty($hero_button_url)) { ?>
      <a href="<?php echo $hero_button_url; ?>" class="btn-orange"><?php echo $hero_button_text; ?></a>
    <?php } ?>
  </div>
</div>