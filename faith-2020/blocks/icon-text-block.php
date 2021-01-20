<?php 
$block_id = 'post-slide-' . $block['id'];
?>
<div id="<?php echo $block_id; ?>" class="fc-icon-text-block">
    <div id="mediaSlider" class="container twelvefifty layout-scrollbar">

    <?php
    if( have_rows('media_center_topic_pages') ){
        while ( have_rows('media_center_topic_pages') ) { the_row(); 
            $postobject = get_sub_field('topic_page');
            $postURL = get_permalink($postobject->ID);
            $postImgArray = get_field('thumbnail_main_image',$postobject->ID);
            $postImg = get_image_url($postImgArray, 'logo-block');
        ?>
        <a href="<?php echo $postURL; ?>" class="icon-text-block">
            <img src="<?php echo $postImg; ?>" class="icon-image" />
            <div class="text-position">
                <div class="slide-name"><?php echo $postobject->post_title; ?></div>
                <div class="slide-description"><?php the_field('thumbnail_description',$postobject->ID); ?></div>
            </div>
        </a>
        <?php }
    }
    ?>
        <div class="clearfix"></div>
    </div>
</div>