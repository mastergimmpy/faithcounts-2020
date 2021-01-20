<?php 
$block_id = 'post-slide-' . $block['id'];
?>
<div id="<?php echo $block_id; ?>" class="faithcounts-page-title-light-block">
    <div class="container twelvefifty">
        <h1 class="main-page-title"><?php the_field('page_title'); ?></h1>
        <p class="fourth"><?php the_field('page_subtitle'); ?></p>
    </div>
</div>