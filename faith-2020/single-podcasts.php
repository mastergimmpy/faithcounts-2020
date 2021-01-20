<?php 
require '_popup-header.php';  
if (have_posts()) : while (have_posts()) : the_post();

increment_view_count();

$image = get_image_url(get_field('image'), 'podcast-main');
?>
<div id="overlay-all"></div>
<div class="showing-popup">
  <div id="popup">
    <div id="popup-body">
      <div id="podcast-player" class="container">
        <a href="<?php echo home_url(); ?>" id="popup-close" class="popup-close-link"></a>
        <div class="podcast-wrapper">
          <div class="audio-player">
            <audio src="<?php the_field('podcast'); ?>"></audio>
            <div class="background" data-was-processed="true" style="background-image: url(<?php echo $image; ?>);"></div>
            <div class="info">
              <div class="blackout">
                <div class="play-indicator-bg">
                  <div class="play-indicator">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Soundwave2.png" alt="Sound wave">
                  </div>
                </div>
                <div class="buttons">
                <div class="rewind"></div>
                <div class="play-button"></div>
                <div class="fast-forward"></div>
                </div>
                <h3 class="podcast-title"><?php the_title(); ?></h3>
                <div class="name"><?php the_field('subtitle'); ?></div>
                <div class="current-time"></div>
                <div class="duration"></div>
              </div>
              <div class="transcript open narrow-container">
                <?php the_field('transcript'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
endwhile; endif;
require '_popup-footer.php';