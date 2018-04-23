<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php 
                if (is_home()||is_search()||is_archive()||is_category()) { 
                    echo get_bloginfo('title'); 
                } else {
                    echo get_bloginfo('title')." - ".get_the_title();
                }
            ?>
        </title>
        <?php wp_meta(); ?>
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo get_bloginfo('title'); ?>" />
        <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
        <meta property="og:url" content="<?php echo site_url(); ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('title'); ?>" />
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
        
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="HandheldFriendly" content="true" />

        <meta name="resource-type" content="Document" />
        <meta name="distribution" content="Global" />
        <meta name="robots" content="index, follow, ALL" />
        <meta name="GOOGLEBOT" content="index, follow" />
        <meta name="rating" content="General" />
        <meta name="revisit-after" content="2 Days" />
        <meta name="language" content="en-us" />
        <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url')."?v=".rand(5, 15); ?>"> 
        <link rel="stylesheet" href="<?php echo get_template_directory_uri()."/custom.css?v=".rand(5, 15); ?>"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://flexslider.woothemes.com/js/jquery.flexslider.js"></script>
        <script src="<?php echo get_template_directory_uri()."/js/functions.js?v=".rand(5, 15); ?>"></script>
        <?php echo '<script>jQuery(document).ready(function(){'; ?>
        <?php 
            echo "$('<div class="; echo '"el">'; echo '<img src="'.get_template_directory_uri().'/assets/pattern_w.png"/></div>'; echo "').appendTo("; echo '"#hero");'; 
        ?>
        <?php echo '});</script>';
        ?>
        <?php wp_head(); ?>
    </head>
    <body 
    <?php
    global $post;
    if (is_front_page()) {
      echo 'class="pg-home"';
    } else if(is_archive()){
      echo 'class="pg-archive pg-interna"';
    } else if(is_category()){
      echo 'class="pg-category pg-interna"';
    } else if(is_search()){
      echo 'class="pg-search pg-interna"';
    } else if(is_single()){
      echo 'class="pg-single pg-interna"';
    } else {
      echo 'class="pg-interna page_id_'.$post->ID.'"';
    }
    ?>>
        <div id="wrap">
            <header>
                <div class="container">
                    <div class="row v-center">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 center-block-xs text-center-xs">
                            <a class="b" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                                <?php 
                                if ( get_theme_mod( 'logo' ) ) :
                                  echo "<img src='".esc_url( get_theme_mod( 'logo' ) )."' alt='".esc_attr( get_bloginfo( 'name', 'display' ) )."'>";
                                else :
                                  echo esc_attr( get_bloginfo( 'name', 'display' ) );
                                endif;
                                ?>
                            </a> 
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 hidden-xs">
                            <a href="#" title="powered by Lorem ipsum">
                                <span>powered by</span>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/powered-by.png" alt="Lorem ipsum dolor.">
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <main>