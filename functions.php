<?php

// remove the WordPress version from the head
remove_action('wp_head', 'wp_generator');

// remove the WordPress version from the footer
remove_action('wp_footer', 'wp_generator');

function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}
add_action('wp_default_scripts', 'remove_jquery_migrate');

// force the excerpt length to 30
add_filter('excerpt_length', function () {
    return 30;
  }, 999);


  add_action( 'customize_register', 'jt_customize_register' );

  function jt_customize_register( $wp_customize ) {
  
      $wp_customize->remove_control( 'custom_css' );
  }

  add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

function wps_deregister_styles() {
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

function wikko_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
   } 
   add_action( 'wp_enqueue_scripts', 'wikko_remove_wp_block_library_css', 100 );

  add_action( 'init', 'wikko_disable_emojis' );

  function wikko_disable_emojis() {
   remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
   remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
   remove_action( 'wp_print_styles', 'print_emoji_styles' );
   remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
   remove_action( 'admin_print_styles', 'print_emoji_styles' );
   remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
   remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
   add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  }

function wikko_dev_headless_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'wikko_dev_headless_setup' );

function wikko_dev_headless_styles() {
	wp_enqueue_style( 'wikko_dev_headless_style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wikko_dev_headless_styles' );