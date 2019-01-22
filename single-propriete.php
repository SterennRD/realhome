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

                <?php if(get_field('galerie')): ?>
                    <?php $size = 'medium';$images = get_field('galerie');?>
                        <div class="property__gallery" id="lightgallery">
                            <?php foreach( $images as $image ): ?>
                                    <a href="<?php echo $image['url']; ?>" data-sub-html="<?php echo $image['caption']; ?>">
                                        <img class="property__gallery_item" src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                                    </a>
                            <?php endforeach; ?>
                        </div>
                <?php endif; ?>

                <div class="property__features">
                    <?php if(get_field('m2')): ?>
                        <?php the_field('m2'); ?>m²
                    <?php endif; ?>
                    <h3 class="property__features_title">À l'intérieur</h3>
                    <div class="row">
                        <?php if(get_field('nb_pieces') && get_field('nb_pieces') > 0): ?>
                            <div class="property__features_item col-lg-2 d-flex flex-column">
                                <i class="property__features_icon fas fa-door-closed"></i>
                                <div>
                                    <?php the_field('nb_pieces'); ?>
                                    <label class="property__features_label">pièces</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('nb_chambres') && get_field('nb_chambres') > 0): ?>
                            <div class="property__features_item col-lg-2 d-flex flex-column">
                                <i class="property__features_icon fas fa-bed"></i>
                                <div>
                                    <?php the_field('nb_chambres'); ?>
                                    <label class="property__features_label">chambres</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('nb_bain') && get_field('nb_bain') > 0): ?>
                            <div class="property__features_item col-lg-2 d-flex flex-column">
                                <i class="property__features_icon fas fa-bath"></i>
                                <div>
                                    <?php the_field('nb_bain'); ?>
                                    <label class="property__features_label">salles de bain</label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <h2 class="property__subtitle">
            Nos <b>propriétés</b>
            <?php if (get_the_taxonomies() ) : ?>
                <?php
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                    foreach ( $terms as $term ) {
                        echo 'à ' . $term->name;
                    }
                }
                ?>
            <?php endif ?>
        </h2>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if ( function_exists( 'get_related_posts' ) ) {
            $related_posts = get_related_posts( 'ville', array( 'posts_per_page' => 4) );
            if ( $related_posts ) {
                echo "<div class='row'>";
                foreach ( $related_posts as $post ) {
                    setup_postdata( $post ); ?>

                    <div class="col-lg-3">
                        <a class="d- flex-column" href="<?php the_permalink(); ?>">

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

                        </a>
                    </div>
                <?php
                }
                echo "</div>";
                wp_reset_postdata();
            }
        }
        ?>

    </div>
<?php get_footer(); ?>