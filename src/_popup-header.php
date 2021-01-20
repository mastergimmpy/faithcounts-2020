<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;
  wp_title();
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
  }
  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <div class="container fixed-container">
    <div id="header-social">
      <a href="#" target="_blank" class="header-twitter"></a>
      <a href="#" target="_blank" class="header-facebook"></a>
      <a href="#" target="_blank" class="header-email"></a>
      <a href="#" id="mobile-social"></a>
    </div>
  </div>
  