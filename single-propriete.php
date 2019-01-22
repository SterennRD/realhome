<?php get_header(); ?>
    <div class="container property">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="property__title"><?php the_title() ?></h1>

                <div class="row">
                    <div class="property__img col-lg-8">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('large') ?>" />
                        <?php else: ?>
                            <div class="property__img--empty"></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-4">
                        <?php if(get_field('prix')): ?>
                            <?php $prix = get_field('prix');
                            $prix = number_format($prix, 2, ',', ' '); ?>
                            <div class="property__price"><i class="fas fa-bookmark property__price--icon"></i> <?php echo $prix ?> €</div>
                        <?php endif; ?>
                        <ul class="property__info">
                            <?php if (get_the_taxonomies() ) : ?>
                                <?php
                                $id = get_the_ID();
                                $terms = get_the_terms( $id, 'ville' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    foreach ( $terms as $term ) {
                                        $term_link = get_term_link( $term, 'ville' );
                                        echo '<li><label class="property__label">Ville :</label><a class="" href="' . $term_link . '">' . $term->name . '</a></li>';
                                    }
                                }
                                ?>
                            <?php endif ?>
                            <?php if(get_field('nb_pieces')): ?>
                                <li><label class="property__label">Nombre de pièces :</label> <?php echo get_field('nb_pieces') ?></li>
                            <?php endif; ?>
                            <?php if(get_field('info')): ?>
                                <li><label class="property__label">Info :</label> <?php echo get_field('info') ?></li>
                            <?php endif; ?>
                        </ul>

                        <?php if(get_field('description')): ?>
                            <?php
                            $description = get_field('description');
                            $description = strip_tags($description);
                            ?>
                            <p class="property__txt"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endwhile; ?>
        <?php endif; ?>

        <h2 class="property__subtitle">Nos <b>propriétés</b></h2>
        <?php $Posts = get_the_ID(); ?>
        <?php
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 4,
            'order' => 'DESC',
            'orderby' => 'ID',
            'posts__not_in' => array($Posts),
        );
        ?>

        <?php $the_query = new WP_Query($args);?>

        <?php if ( $the_query->have_posts() ) : ?>
            <div class="row">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="col-lg-3">

                <?php if (has_post_thumbnail()) : ?>
                    <div class="property__img property__img--mini">
                        <img src="<?php the_post_thumbnail_url('large') ?>" />
                    </div>
                <?php else: ?>
                    <div class="property__img property__img--mini property__img--empty"></div>
                <?php endif; ?>

                <h3 class="property__mini_title"><?php the_title(); ?></h3>

                <?php if (get_the_taxonomies() ) : ?>
                    <?php
                    $id = get_the_ID();
                    $terms = get_the_terms( $id, 'ville' );
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term, 'ville' );
                            echo '<a class="property__mini_link" href="' . $term_link . '">' . $term->name . '</a>';
                        }
                    }
                    ?>
                <?php endif ?>
            </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>