<?php 
$block_id = 'post-slide-' . $block['id'];

?>
<div id="<?php echo $block_id; ?>" class="fc-logos-block">
  <div class="container twelvefifty">
    <div class="post-slide-title"><?php the_field('section_title'); ?></div>
    <div class="block-logos">
      <?php
      if ( have_rows('logos') ) {
        while ( have_rows('logos') ) { 
          the_row(); 
          $logo_image_array = get_sub_field('logo');
          $logo_image = get_image_url($logo_image_array, 'logo-block');
          ?>
          <div class="block-logo">
            <img src="<?php echo $logo_image; ?>" />
          </div>
          <?php 
        }
      } ?>
    </div>
  </div>
</div>