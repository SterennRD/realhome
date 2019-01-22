<?php /* Template Name: Gabarit Propriétés */ ?>

<?php get_header(); ?>
    <div class="container properties">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="properties__title"><?php the_title() ?></h1>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php

        $terms = get_terms( 'ville', [
            'hide_empty' => false,
        ]);

        echo '<div class="filter">';
        echo '<div class="filter__link filter__link--active" data-id="" href="">Tout</div>';

        // loop through all terms
        foreach( $terms as $term ) {

            echo '<div class="filter__link" data-id="' . $term->slug . '"> '. $term->name .'</div>';

        }
        echo '</div>';

//        $url = get_site_url();
//        $url .= '/wp-json/wp/v2/propriete?ville=6'; // path to your JSON file
//        $data = file_get_contents($url); // put the contents of the file into a variable
//        $characters = json_decode($data); // decode the JSON feed
//        var_dump($characters);
//        foreach( $characters as $character ) {
//
//            echo $character->title->rendered;
//
//        }
        ?>

            <!-- // Les arguments  -->
        <?php $Posts = get_the_ID(); ?>
        <?php
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 10,
            'order' => 'DESC',
            'order by' => 'rand',
            'posts__not_in' => array($Posts),
        );
        ?>

            <!-- // The Query -->
        <?php $the_query = new WP_Query($args);?>

            <!-- // The Loop -->
        <?php if ( $the_query->have_posts() ) : ?>
            <div class="row properties__wrapper">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php get_template_part( 'propriete-card' ); ?>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>