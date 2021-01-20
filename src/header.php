<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged, $is_search_page;
  $class_list = [];
  if ($is_search_page) {
    array_push($class_list, "search-open", "force-scroll");
  }

  wp_title();
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
  }
  ?></title>

<!-- Adobe Analytics Script prod -->
<script src="//assets.adobedtm.com/05064fe6cab0/b9d37f296ace/launch-fe44d8adbb98.min.js" async></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129118134-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-129118134-1');
</script>

<meta name="google-site-verification" content="uFwTks44JBjirV6SnZqz0KvzacUZlYETowwxQuR_OFs" />
<meta name="p:domain_verify" content="1751720c1f93710a0750060676b32bcb"/>

<script src='https://www.google.com/recaptcha/api.js'></script>


<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '806562926390005');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=806562926390005&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_enqueue_script('jquery'); ?>
    <?php wp_head(); ?>

    <script type="text/javascript">
      jQuery(document).ready( function() {
             jQuery('.rstw_comma').html(',<br />');
      });

    </script>
  </head>
  <body <?php body_class($class_list); ?> >
  <header>
        <div class="container">
            <div id="hamburger"></div>
            <a class="logo" href="<?php echo get_home_url(); ?>"></a>
            <?php wp_nav_menu( array(
                'menu' => 'Main Menu'
            ) ); ?>
            <div></div>
            <a href="<?php echo site_url('/search/'); ?>" id="search-icon"></a>
            <a href="#" id="search-close" <?php if ($is_search_page) {
              echo " nav-back";
            } ?>></a>
            <div class="clearfix"></div>
        </div>
  </header>
  <div class="container fixed-container">
    <div id="header-social">
      <a href="#" target="_blank" class="header-twitter" data-headersocial="twitter"></a>
      <a href="#" target="_blank" class="header-facebook" data-headersocial="facebook"></a>
      <a href="#" target="_blank" class="header-email" data-headersocial="email"></a>
      <a href="#" id="mobile-social"></a>
    </div>
  </div>