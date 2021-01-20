<?php 
$block_id = 'post-slide-' . $block['id'];
$video_link = get_field('video_url');
$video_image_array = get_field('video_image');
$video_image = get_image_url($video_image_array, 'video-hero');
?>
<div id="<?php echo $block_id; ?>" class="faithcounts-video-hero-block">
    <div class="container twelvefifty">
        <a href="<?php echo get_the_permalink(get_field('video')); ?>" id="video-hero" style="background-image:url(<?php echo $video_image; ?>"><div class="spacer"></div></a>
    </div>
</div>