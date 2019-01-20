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