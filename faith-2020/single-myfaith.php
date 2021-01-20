<?php 
get_header(); 
if (have_posts()) : while (have_posts()) : the_post();
$myfaith_image_array = get_field('headshot_image');
$myfaith_image = get_image_url($myfaith_image_array, 'headshot-myfaith');
?>
<main>
<div class="faithcounts-page-title-light-block">
    <div class="container twelvefifty">
        <h1 class="main-page-title"><?php the_title(); ?></h1>
        <p class="fourth"><?php the_field('religious_affilitaion'); ?></p>
    </div>
</div>
<div class="faithcounts-narrow-text-block">
    <div class="narrow-container">
        <div class="myfaith-image" style="background-image:url(<?php echo $myfaith_image; ?>);"><div class="spacer"></div></div>
        <h2 class="page-topic-header">About Me</h2>
        <p><?php the_field('about_me'); ?></p>
        <h2 class="page-topic-header">How do I live my faith</h2>
        <p><?php the_field('how_do_i_live_my_faith'); ?></p>
        <h2 class="page-topic-header">Why am I <?php the_field('religious_affilitaion'); ?></h2>
        <p><?php the_field('why_am_i'); ?></p>
        <div style="padding-top:64px;"></div>
    </div>
</div>
</main>
<?php 
endwhile; endif;
get_footer();