<?php /* Template Name: Gabarit Propriétés */ ?>

<?php get_header(); ?>
    <div class="container properties">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="properties__title"><?php the_title() ?></h1>
            <?php endwhile; ?>
        <?php endif; ?>

            <!-- // Les arguments  -->
        <?php $Posts = get_the_ID(); ?>
        <?php
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 10,
            'order' => 'ASC',
            'order by' => 'rand',
            'posts__not_in' => array($Posts),
        );
        ?>

            <!-- // The Query -->
        <?php $the_query = new WP_Query($args);?>

            <!-- // The Loop -->
        <?php if ( $the_query->have_posts() ) : ?>
            <div class="row">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="col-lg-3">
                    <div class="properties__card">
                        <a href="<?php the_permalink() ?>">
                            <div class="properties__img">
                                <img src="<?php the_post_thumbnail_url('medium') ?>" />
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