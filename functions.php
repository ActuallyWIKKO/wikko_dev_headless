<?php

function wikko_dev_headless_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'wikko_dev_headless_setup' );

function wikko_dev_headless_styles() {
	wp_enqueue_style( 'wikko_dev_headless_style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wikko_dev_headless_styles' );