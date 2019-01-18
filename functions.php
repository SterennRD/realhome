<?php
add_action('wp_enqueue_scripts', 'insert_css');
function insert_css() {
    // On ajoute le css general du theme
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('style2', get_template_directory_uri() .'/style2.css');

    // On ajoute le jQuery au thème
    wp_register_script('jquery2', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
    wp_enqueue_script('jquery2');


    // On ajoute le js au thème
    wp_enqueue_script( 'script-js', get_template_directory_uri() .'/assets/js/script.js');
}