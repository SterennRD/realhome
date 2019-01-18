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

// Custom post type propriété
function create_post_type() { register_post_type('propriete',
    array(
        'label' => __('Propriétés'),
        'singular_label' => __('Propriété'),
        'add_new_item' => __( 'Ajouter une propriété' ),
        'edit_item' => __( 'Modifier une propriété' ),
        'new_item' => __( 'Nouvelle propriété' ),
        'view_item' => __( 'Voir la propriété' ),
        'search_items' => __( 'Rechercher une propriété' ),
        'not_found' => __( 'Aucune propriété trouvée' ),
        'not_found_in_trash' => __( 'Aucune propriété trouvée' ),
        'public' => true, 'show_ui' => true, 'capability_type' => 'post',
        'has_archive' => true, 'hierarchical' => true,
        'menu_icon' => 'dashicons-admin-home',
        'taxonomies' => array('types'),
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'propriete', 'with_front' => true)
    )
);
}

// Custom post type équipe
function create_post_type() { register_post_type('equipe',
    array(
        'label' => __('Equipiers'),
        'singular_label' => __('Equipier'),
        'add_new_item' => __( 'Ajouter un équipier' ),
        'edit_item' => __( 'Modifier un équipier' ),
        'new_item' => __( 'Nouvel équipier' ),
        'view_item' => __( 'Voir l\'équipier' ),
        'search_items' => __( 'Rechercher un équipier' ),
        'not_found' => __( 'Aucun équipier trouvé' ),
        'not_found_in_trash' => __( 'Aucun équipier trouvé' ),
        'public' => true, 'show_ui' => true, 'capability_type' => 'post',
        'has_archive' => true, 'hierarchical' => true,
        'menu_icon' => 'dashicons-businessman',
        'taxonomies' => array('types'),
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'equipe', 'with_front' => true)
    )
);
}