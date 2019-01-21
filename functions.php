<?php
add_action('wp_enqueue_scripts', 'insert_css');
function insert_css() {
    // On ajoute le css general du theme
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('style2', get_template_directory_uri() .'/style2.css');
    wp_enqueue_style('fa', 'https://use.fontawesome.com/releases/v5.6.3/css/all.css');
    wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.3.1/dist/leaflet.css');



}

function add_js_scripts() {
    // On ajoute le jQuery au thème
    wp_register_script('jquery2', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js');
    wp_enqueue_script('jquery2');

    wp_enqueue_script( 'fa-js', 'https://use.fontawesome.com/releases/v5.6.3/js/all.js');
    wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.3.1/dist/leaflet.js');


    // On ajoute le js au thème
    wp_enqueue_script( 'script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), '1.0', true );

    // pass Ajax Url to script.js
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action('wp_enqueue_scripts', 'add_js_scripts');

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
        'rewrite' => array('slug' => 'propriete', 'with_front' => true),
        'show_in_rest'       => true,
        'rest_base'          => 'propriete',
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
            'show_in_rest' => true,
        )
    );
}
add_action( 'init', 'themes_taxonomy');

add_action( 'wp_ajax_filter_city', 'filter_city' );
add_action( 'wp_ajax_nopriv_filter_city', 'filter_city' );

function filter_city() {
    $keyword = $_POST['param'];
    if ($_POST['param']) {
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 10,
            'order' => 'DESC',
            'order by' => 'rand',
            'tax_query' => array(
                array (
                    'taxonomy' => 'ville',
                    'field' => 'slug',
                    'terms' => [$keyword],
                )
            ),
        );
    } else {
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 10,
            'order' => 'DESC',
            'order by' => 'rand',
        );
    }

    $ajax_query = new WP_Query($args);

    if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
        get_template_part( 'propriete-card' );
    endwhile;
    endif;

    die();
}

// Insertion sidebar
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name'=>'Sidebar',
        'id' => 'primary',
        'before_widget' => '<div class="sidebar__widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="sidebar__title">',
        'after_title' => '</h2>',
    ));

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
    <div class="comment-author vcard"><?php
    if ( $args['avatar_size'] != 0 ) {
        echo get_avatar( $comment, 100 );
    }
    printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
    </div><?php
    if ( $comment->comment_approved == '0' ) { ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
    } ?>
    <div class="comment-right">


    <?php comment_text(); ?>

    <div class="comment-footer">
        <div class="comment-meta commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                /* translators: 1: date, 2: time */
                printf(
                    __('%1$s'),
                    get_comment_date()
                ); ?>
            </a><?php
            edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
        </div>

        <div class="comment-sep">/</div>

        <div class="reply"><?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); ?>
        </div>
    </div>
    </div><?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php
    endif;
}