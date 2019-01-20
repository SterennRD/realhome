<?php /* Template Name: Gabarit Propriétés */ ?>

<?php get_header(); ?>
    <div class="container properties">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="properties__title"><?php the_title() ?></h1>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php
        // your taxonomy name
        $tax = 'ville';

        // get the terms of taxonomy
        $terms = get_terms( $tax, [
            'hide_empty' => false, // do not hide empty terms
        ]);

        $url = bloginfo('url');
        var_dump($terms);

        // loop through all terms
        foreach( $terms as $term ) {

            echo '<h4><a href="'. get_term_link( $term ) .'">'. $term->name .'</a></h4>';
            echo '<a class="filter" data-id="' . $term->slug . '" href="';
            echo bloginfo('url');
            echo '/wp-json/wp/v2/propriete?ville=' . $term->term_id .'">' . $term->name .'</a>';
            echo $term->term_id;

        }

        $url = get_site_url();
        $url .= '/wp-json/wp/v2/propriete?ville=6'; // path to your JSON file
        $data = file_get_contents($url); // put the contents of the file into a variable
        $characters = json_decode($data); // decode the JSON feed
        var_dump($characters);
        foreach( $characters as $character ) {

            echo $character->title->rendered;

        }
        ?>
        <?php echo do_shortcode('[searchandfilter fields="ville"]'); ?>
            <!-- // Les arguments  -->
        <?php $Posts = get_the_ID(); ?>
        <?php
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 10,
            'order' => 'DESC',
            'order by' => 'rand',
            'posts__not_in' => array($Posts),
            'tax_query' => array(
                array (
                    'taxonomy' => 'ville',
                    'field' => 'slug',
                    'terms' => ['rennes', 'paris'],
                )
            ),
        );
        ?>

            <!-- // The Query -->
        <?php $the_query = new WP_Query($args);?>

            <!-- // The Loop -->
        <?php if ( $the_query->have_posts() ) : ?>
            <div class="row test">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="properties__card">
                        <a href="<?php the_permalink() ?>">
                            <div class="properties__img">
                                <img src="<?php the_post_thumbnail_url('large') ?>" />
                            </div>
                            <div class="properties__desc">
                                <h2 class="properties__link">
                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </h2>

                                <?php if (get_the_taxonomies() ) : ?>
                                    <?php
                                    $id = get_the_ID();
                                    $terms = get_the_terms( $id, 'ville' );
                                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                        foreach ( $terms as $term ) {
                                            $term_link = get_term_link( $term, 'ville' );
                                            echo '<div class="properties__city"><a class="" href="' . $term_link . '">' . $term->name . '</a></div>';
                                        }
                                    }
                                    ?>
                                <?php endif ?>

                                <?php if(get_field('prix')): ?>
                                    <?php $prix = get_field('prix');
                                    $prix = number_format($prix, 2, ',', ' '); ?>
                                    <div class="properties__price"><?php echo $prix ?> €</div>
                                <?php endif; ?>

                                <div class="properties__details">
                                    <?php if(get_field('m2')): ?>
                                        <div><?php echo get_field('m2') ?>m²</div>
                                    <?php endif; ?>

                                    <?php if(get_field('nb_chambres')): ?>
                                        <div><?php echo get_field('nb_chambres') ?> chambres</div>
                                    <?php endif; ?>

                                    <?php if(get_field('nb_bain')): ?>
                                        <?php get_field('nb_bain') > 1 ? $salle = 'salles' : $salle = 'salle'; ?>
                                        <div><?php echo get_field('nb_bain') ?> <?php echo $salle; ?> de bain</div>
                                    <?php endif; ?>
                                </div>
                            </div>





                        </a>
                    </div>

                </div>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>