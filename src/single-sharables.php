<?php 
require '_popup-header.php'; 
if (have_posts()) : while (have_posts()) : the_post();

increment_view_count();

$image = get_image_url(get_field('image'), 'sharable-large');
?>
<div id="overlay-all"></div>
<div class="showing-popup">
  <div id="popup">
    <div id="popup-body">
      <div id="sharable-player" class="container">
        <a href="<?php echo home_url(); ?>" id="popup-close" class="popup-close-link"></a>
        <img src="<?php echo $image; ?>" />
        <div class="description"><?php the_field('description'); ?></div>
      </div>
    </div>
  </div>
</div>
<?php 
endwhile; endif;
require '_popup-footer.php';