<?php 
get_header();  
if (have_posts()) : while (have_posts()) : the_post();

increment_view_count();
?>
<main>
  <div class="container">
    <h1 class="article-title"><?php the_title(); ?></h1>
  </div>
  <?php 
  // fc_start_wrapper();
  // the_content(); 
  // fc_end_wrapper();
  fc_content_wrapper_fix();
  ?>
</main>
<?php 
endwhile; endif;
get_footer();