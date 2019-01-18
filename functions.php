<?php
add_action('wp_enqueue_scripts', 'insert_css');
function insert_css() {
    // On ajoute le css general du theme
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('style2', get_template_directory_uri() .'/style2.css');
    wp_enqueue_style('fa', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');


    // On ajoute le jQuery au thème
    wp_register_script('jquery2', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
    wp_enqueue_script('jquery2');

    wp_enqueue_script( 'fa-js', 'https://use.fontawesome.com/releases/v5.6.3/js/all.js');


    // On ajoute le js au thème
    wp_enqueue_script( 'script-js', get_template_directory_uri() .'/assets/js/script.js');
}

// Définition des menus dans l'admin
add_theme_support('menus');
register_nav_menus(array(
    'menu-principal' => 'Navigation principale',
    'menu-secondaire' => 'Navigation secondaire'
));

// Ajouter les images à la une
add_theme_support('post-thumbnails');

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
// Custom post type équipe
    register_post_type('equipe',
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
add_action( 'init', 'create_post_type' );

// Créer une taxonomie
function themes_taxonomy() {
    register_taxonomy(
        'ville',
        'propriete', // nom du custom type
        array(
            'label' => 'Ville', // Nom de la taxonomie (dans le back)
            'query_var' => true, // Pouvoir faire des requêtes
            'rewrite' => array(
                'slug' => 'ville',
                'with_front' => true
            ),
            'hierarchical' => true, // pour créer des catégories et non pas des étiquettes
        )
    );
}
add_action( 'init', 'themes_taxonomy');