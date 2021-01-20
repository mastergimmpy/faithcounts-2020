<?php
$category_id = -1;
$search_category = '';
if (isset($_GET['cat'])) {
  $cat_map = get_category_map();
  $category_id = $cat_map[$_GET['cat']] ?: $_GET['cat'];
  $cat = get_term($category_id, 'category');
}

// $post_types = $search_filter ? array($search_filter) : array('post', 'videos', 'podcasts', 'sharables', 'downloads');
// $args = array(
//   'posts_per_page' => -1,
//   'post_type' => "$post_types",
//   'post_status' => array('publish', 'future'),
//   's' => $search_term
// );
// if ($category_id > -1) {
//   $args['cat'] = $category_id;
// }
// $category_posts = new WP_Query($args);
?>

<?php
$block_id = 'category-grid-' . $block['id'];
?>

<div class="container thirteenseventyfive">
    <div class="search-wrapper">
        <?php 
            if($category_posts->have_post()) {
                while($category_posts->have_posts()) {
                    $category_posts->the_post();
                    $id = get_the_ID();
                    $post_type = get_post_type($id);
                    $thumbnail_large = get_the_post_thumbnail_url($id);
                    if(!$thumbnail_large) {
                        $thumbnail_large = get_image_url(get_field('image', $id), 'post-slider');
                    }
                    $category_class = $block_class = '';
                    $permalink = get_the_permalink();
                    
                    switch ($post_type) {
                        case "videos" :
                            $category_class = "video-icon";
                            $block_class = "popup-page-link";
                            break;
                        case "post" :
                            $category_class = "reading-icon";
                            $block_class = "articleLaunch";
                            break;
                        case "podcasts" :
                            $category_class = "mic-icon";
                            $block_class = "podcastLaunch";
                            break;
                        case "sharables" :
                            $category_class = "sharables-image";
                            $block_class = "sharableLaunch";
                            break;
                        case "downloads" :
                            $category_class = "download-icon";
                            $block_class = "downloadLaunch";
                            break;
                        default :
                            $category_class = "reading-icon";
                            $block_class = "articleLaunch";
                    } ?>

                    <a href="<?php echo $permalink; ?>" class="post-slide <?php echo $block_class . $show_class; ?>" data-type="<?php echo $post_type ?>">
                        <div class="slide-image lazy <?php echo $category_class; ?>" data-bg="url(<?php echo $thumbnail_large; ?>)"><div class="spacer"></div></div>
                        <div class="slide-title"><?php the_title(); ?></div>
                    </a>
                <?php }
            }
        ?>
    </div>
</div>