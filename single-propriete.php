<?php get_header(); ?>
    <div class="container property">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="property__title"><?php the_title() ?></h1>

                <div class="row">
                    <div class="property__img col-lg-8 <?php if (!has_post_thumbnail()) : ?>property__img--empty<?php endif; ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('large') ?>" />
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
    </div>
<?php get_footer(); ?>