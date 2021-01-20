<?php 
get_header(); 
if (have_posts()) : while (have_posts()) : the_post();

increment_view_count();

$video_url_raw = get_field('video');
$video_url = video_link($video_url_raw);
$video_image_array = get_field('hero_image');
$video_image = get_image_url($video_image_array, 'video-hero');
$video_class = '';
if (!empty($video_url_raw)) {
  $video_class = 'with-video';
}
?>
<main>
  <div class="container twelvefifty">
    <h1 class="main-page-title"><?php the_title(); ?></h1>
    <a href="<?php echo $video_url; ?>" id="video-hero" class="<?php echo $video_class; ?>" style="background-image:url(<?php echo $video_image; ?>">
      <div class="spacer"></div>
    </a>
    <div class="narrow-container">
      <?php
      if ( have_rows('about_section') ) {
        while ( have_rows('about_section') ) {
          the_row(); ?>
          <h2 class="page-topic-header"><?php the_sub_field('title'); ?></h2>
          <?php the_sub_field('text');
        }
      }
      $post_object = get_field('related_podcast');
      if ($post_object) {
        $post = $post_object;
        setup_postdata( $post );
        $podcast_image_array = get_field('image');
        $podcast_image = get_image_url($podcast_image_array, 'podcast-thumb'); ?>
        <div class="podcast-wrapper">
          <div class="audio-player on-portrait">
            <audio src="<?php the_field('podcast'); ?>"></audio>
            <div class="background" data-was-processed="true" style="background-image: url(<?php echo $podcast_image; ?>);"></div>
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
              <div class="transcript-toggle"></div>
              <div class="transcript narrow-container">
                <?php the_field('transcript'); ?>
              </div>
            </div>
          </div>
        </div>
        <?php
        wp_reset_postdata();
      }
      ?>
    </div>
  </div>
  <?php 
  $related_articles = get_field("related_articles")?:[];
  if (count($related_articles)) { ?>
    <div class="fc-post-slide-block">
      <div class="post-slide-title">Related</div>
      <div class="post-slide-wrapper layout-scrollbar">
        <div class="post-slides"> <?php
        $icon_map = Array(
          "post" => "reading-icon",
          "videos" => "video-icon", 
          "podcasts" => "mic-icon", 
          "sharables" => "share-icon", 
          "downloads" => "download-icon",
          "portraits" => "reading-icon"
        );
          for ($i=0; $i < count($related_articles); $i++) {
            $article = $related_articles[$i];
            $image = get_field("image", $article)?:get_post_thumbnail_id($article)?:get_field("hero_image", $article) ?>
            <a href="<?php echo get_permalink($article) ?>" id="slide1" class="post-slide">
              <div class="slide-image lazy <?php echo $icon_map[get_post_type($article)] ?>" 
                data-bg="url(<?php echo get_image_url($image, "post-slider"); ?>)"><div class="spacer"></div></div>
              <div class="slide-title"><?php echo get_the_title($article) ?></div>
            </a> <?php
          } ?>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="post-more-button"></div>
    </div> <?php
  } ?>

</main>
<?php 
endwhile; endif;
get_footer();


