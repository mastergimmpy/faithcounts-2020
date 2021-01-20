<?php
// unique id for this block, can be helpful to differentiate if necessary in javascript
$block_id = 'hero-' . $block['id'];
$hero_color = get_field('hero_text_color');
$hero_image = get_image_url(get_field('hero_background_image'), 'home-hero');
$hero_button_text = get_field('hero_button_text');
$hero_button_url = get_field('hero_button_url');
$clases = '';
$classes .= 'text-' . get_field('text_alignment');
$classes .= get_field('wide_text') ? ' wider' : '';
$classes .= get_field('this_is_a_series_page') ? ' wide-text-hero' : '';
$overlay_type = get_field('gradient_overlay_type');
$overlay_color = get_field('overlay_color');
if ($overlay_type != 'none') {
  $classes .= ' overlay-' . $overlay_color;
}
?>
<div class="fc-hero <?php echo $classes; ?>" style="background-image:url(<?php echo $hero_image; ?>);"><?php
if ($overlay_type != 'none') {
  // the horizontal will look a little odd because we're just putting in the colors of the linear gradient.
  // the rest of it comes later when combined with the directional indicator. Vertical is always the same
  // direction.
  $gradient_vertical = '';
  $gradient_horizontal = '';
  if ($overlay_color == 'white') {
    $gradient_vertical = 'linear-gradient(180deg, rgba(247,247,247,0) 0%, #FFFFFF 100%)';
    $gradient_horizontal = 'rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%';
  } elseif ($overlay_color == 'green') {
    $gradient_vertical = 'linear-gradient(180deg, rgba(49,100,92,0) 0%, rgba(55,102,93,0.8) 100%)';
    $gradient_horizontal = 'rgba(41,92,85,1) 0%, rgba(45,96,90,0) 74%, rgba(255,255,255,0) 100%';
  } elseif ($overlay_color == 'red') {
    $gradient_vertical = 'linear-gradient(180deg, rgba(203,93,70,0) 0%, rgba(203,93,70,0.8) 100%)';
    $gradient_horizontal = 'rgba(200,93,70,1) 0%, rgba(200,93,70,0) 100%';
  } elseif ($overlay_color == 'yellow') {
    $gradient_vertical = 'linear-gradient(180deg, rgba(184, 163, 91,0) 0%, rgba(184, 163, 91,0.6) 100%)';
    $gradient_horizontal = 'rgba(184, 163, 91,0.8) 0%, rgba(184, 163, 91,0) 100%';
  }
  if ($overlay_type == 'horizontal' || $overlay_type == 'both') { ?>
    <div class="hero-overlay-horizontal"
        style="background-image: linear-gradient(to <?php the_field('horizontal_overlay_direction'); ?>, <?php echo $gradient_horizontal; ?>);">
    </div><?php
        }
  if ($overlay_type == 'vertical' || $overlay_type == 'both') { ?>
    <div class="hero-overlay-vertical"
        style="background-image: <?php echo $gradient_vertical; ?>;">
    </div><?php
  }
}
?>
  <div class="container">
    <div class="hero-upper-text"><?php the_field('hero_upper_text'); ?></div>
    <div class="hero-title"><?php the_field('hero_title'); ?></div>
    <?php the_field('hero_description'); ?>
    <div class="clearfix"></div>
    <?php
    if (!empty($hero_button_text) && !empty($hero_button_url) && $series_hero) { ?>
      <a href="<?php echo $hero_button_url; ?>" class="btn-link"><?php echo $hero_button_text; ?></a>
    <?php } elseif (!empty($hero_button_text) && !empty($hero_button_url)) { ?>
      <a href="<?php echo $hero_button_url; ?>" class="btn-orange"><?php echo $hero_button_text; ?></a>
    <?php } ?>
  </div>
</div>