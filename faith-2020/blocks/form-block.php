<?php 
$block_id = 'post-slide-' . $block['id'];
?>
<div id="<?php echo $block_id; ?>" class="fc-form">
  <div class="narrow-container">
    <h2 class="page-topic-header"><?php the_field('form_title'); ?></h2>
    <p><?php the_field('form_description'); ?></p>
    <?php 
    $form_shortcode = get_field('form_shortcode');
    echo do_shortcode($form_shortcode); ?>
  </div>
</div>