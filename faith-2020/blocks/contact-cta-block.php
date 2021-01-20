<?php 
$block_id = 'post-slide-' . $block['id'];
$headshot_image_array = get_field('headshot_image', 'contact_info');
$headshot_image = get_image_url($headshot_image_array, 'headshot');
?>
<div id="<?php echo $block_id; ?>" class="fc-contact-cta">
  <div class="container">
    <div class="headshot-image" style="background-image:url(<?php echo $headshot_image; ?>);"><div class="spacer"></div></div>
    <div class="cta-text">
      <div class="post-slide-title"><?php the_field('cta_title', 'contact_info'); ?></div>
      <p class="strong uppercase"><?php the_field('cta_description', 'contact_info'); ?></p>
      <p class="uppercase">
        <?php the_field('contact_name', 'contact_info'); ?><br>
        <?php the_field('contact_position', 'contact_info'); ?><br>
        Phone: <a href="tel:<?php the_field('contact_phone', 'contact_info'); ?>"><?php the_field('contact_phone', 'contact_info'); ?></a><br>
        <a href="mailto:<?php the_field('contact_email', 'contact_info'); ?>"><?php the_field('contact_email', 'contact_info'); ?></a>
      </p>
    </div>
  </div>
</div>