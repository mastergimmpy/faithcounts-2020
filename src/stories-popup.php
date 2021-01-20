<?php
/**
 * 
 *  Template Name: Stories of Faith
 * 
 */



$no_search_pop = true;
$is_search_page = true;

$search_term = '';
if (isset($_GET['q'])) {
  $search_term = $_GET['q'];
}
$search_filter = '';
if (isset($_GET['f'])) {
  $search_filter = $_GET['f'];
}
$category_id = -1;
$search_category = '';
if (isset($_GET['cat'])) {
  $cat_map = get_category_map();
  $category_id = $cat_map[$_GET['cat']] ?: $_GET['cat'];
  $cat = get_term($category_id, 'category');
  $search_category = $cat->name;
  // going to clear out any search term passed in
  $search_term = '';
}

$post_types = $search_filter ? array($search_filter) : array('post', 'videos', 'podcasts', 'sharables', 'downloads');
$args = array(
  'posts_per_page' => -1,
  'post_type' => "$post_types",
  'post_status' => array('publish', 'future'),
  's' => $search_term
);
if ($category_id > -1) {
  $args['cat'] = $category_id;
}
$category_posts = new WP_Query($args);
 
get_header(); 
?>
<main>
  <div class="container thirteenseventyfive">
<!--     <div class="searchform-wrapper">
      <form id="searchform" method="get" action="<?php echo site_url('/stories-of-faith/'); ?>">
        <input type="text" class="search-field" name="q" placeholder="Search" value="<?php echo htmlspecialchars($search_category ? $search_category : $search_term); ?>">
        <input type="submit" value="">
      </form>
    </div> -->

    <h1 class="article-title">Stories of Faith</h1>

    <div class="filter-wrapper has-selection stories-of-faith">
    <?php 
      $all_posts = $category_posts->post_count;
      $post_counts = get_post_count_in_query($category_posts);
      $count_videos = $post_counts['videos' ] ?: 0;
      $count_articles = $post_counts['post' ] ?: 0;
      $count_sharables = $post_counts['sharables' ] ?: 0;
      $count_downloads = $post_counts['downloads' ] ?: 0;
      $count_podcasts = $post_counts['podcasts' ] ?: 0;
      ?>
      <div id="filters-btn" class="single-filter<?php if ($search_filter=='') {
        echo ' active';
      } ?>" data-type="">
        <div class="filter-icon-circle">
          <div class="filter-icon filter-filter"></div>
        </div>
        <div class="filter-title">All Types</div>
        <div class="filter-count"><?php echo $all_posts; ?></div>
      </div>
      <div id="video-btn" class="single-filter<?php if ($search_filter=='videos') {
        echo ' active';
      } ?>" data-type="videos">
        <div class="filter-icon-circle">
          <div class="filter-icon video-filter"></div>
        </div>
        <div class="filter-title">Videos</div>
        <div class="filter-count"><?php echo $count_videos; ?></div>
      </div>
      <div id="article-btn" class="single-filter<?php if ($search_filter=='post') {
        echo ' active';
      } ?>" data-type="post">
        <div class="filter-icon-circle">
          <div class="filter-icon article-filter"></div>
        </div>
        <div class="filter-title">Articles</div>
        <div class="filter-count"><?php echo $count_articles; ?></div>
      </div>
      <div id="sharable-btn" class="single-filter<?php if ($search_filter=='sharables') {
        echo ' active';
      } ?>" data-type="sharables">
        <div class="filter-icon-circle">
          <div class="filter-icon sharable-filter"></div>
        </div>
        <div class="filter-title">Sharables</div>
        <div class="filter-count"><?php echo $count_sharables; ?></div>
      </div>
      <div id="podcast-btn" class="single-filter<?php if ($search_filter=='podcasts') {
        echo ' active';
      } ?>" data-type="podcasts">
        <div class="filter-icon-circle">
          <div class="filter-icon podcast-filter"></div>
        </div>
        <div class="filter-title">Podcasts</div>
        <div class="filter-count"><?php echo $count_podcasts; ?></div>
      </div>
      <div id="download-btn" class="single-filter<?php if ($search_filter=='downloads') {
        echo ' active';
      } ?>" data-type="downloads">
        <div class="filter-icon-circle">
          <div class="filter-icon download-filter"></div>
        </div>
        <div class="filter-title">Downloads</div>
        <div class="filter-count"><?php echo $count_downloads; ?></div>
      </div>
    </div>
    <div class="search-wrapper">
      <?php 
      if ($category_posts->have_posts()) {
        while ($category_posts->have_posts()) {
          $category_posts->the_post();
          $id = get_the_ID();
          $post_type = get_post_type( $id );
          $thumbnail_large = get_the_post_thumbnail_url( $id );
          if (!$thumbnail_large) {
            $thumbnail_large = get_image_url(get_field('image', $id), 'post-slider');
          }
          $category_class = $block_class = '';
          $permalink = get_the_permalink();
          $show_class = "";
          // hide the block if there is a post type filter set and the
          // block isn't of that post type
          if ($search_filter != '' && $search_filter !== $post_type) {
            $show_class = " hiddenBlock";
          }
          if (is_sticky($id)) {
            $show_class .= " sticky-stuff";
          }
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
          case "sharables":
            $category_class = "sharables-image";
            $block_class = "sharableLaunch";
            break;
          case "downloads":
            $category_class = "download-icon";
            $block_class = "downloadLaunch";
            break;
          default:
            $category_class = "reading-icon";
            $block_class = "articleLaunch";
        } ?>
        <a href="<?php echo $permalink; ?>" class="post-slide <?php echo $block_class . $show_class; ?>" data-type="<?php echo $post_type ?>">
          <div class="slide-image lazy <?php echo $category_class; ?>" data-bg="url(<?php echo $thumbnail_large; ?>)"><div class="spacer"></div></div>
          <div class="slide-title"><?php the_title(); ?></div>
        </a>
      <?php
        }
      } else { ?>
        <p>We're sorry, there were no results for "<?php echo $search_term; ?>". Please try again.</p>
      <?php } ?>
    </div>
  </div>
</main>
<?php
get_footer();