<?php 
require '_popup-header.php'; 
if (have_posts()) : while (have_posts()) : the_post();

increment_view_count();

$video_url_raw = get_field('video_url');
$video_url = video_link($video_url_raw);
?>
<div id="overlay-all"></div>
<div class="showing-popup">
  <div id="popup">
    <div id="popup-body">
      <div id="video-player" class="container">
        <div class="iframe-wrapper">
          <iframe src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
        </div>
        <a href="<?php echo home_url(); ?>" id="popup-close" class="popup-close-link"></a>
        <div class="description" style="color: #00000066"><?php echo '<h2>'.get_the_title().'</h2>'.get_field("description") ?></div>
      </div>
    </div>
  </div>
</div>
<?php 
endwhile; endif;
require '_popup-footer.php';