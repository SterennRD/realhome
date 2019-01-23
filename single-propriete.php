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
                    <div class="row">
                        <?php if(get_field('m2')): ?>
                            <div class="property__features_m2 col-2"><?php the_field('m2'); ?>m²</div>
                        <?php endif; ?>
                        <?php if(get_field('dpe')): ?>
                            <div class="col-sm-12 col-lg-8">
                                <b>DPE (Diagnostic de Performance Energétique)</b>
                                <div class="property__features_dpe d-flex">
                                <div class="property__features_dpe_schema d-flex flex-column">
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        <= 50 <div>A</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        51 à 90<div>B</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        91 à 150<div>C</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        151 à 230 <div>D</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        231 à 330 <div>E</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        331 à 450 <div>F</div>
                                    </span>
                                    <span class="d-flex align-items-center justify-content-between px-2">
                                        > 451 <div>G</div>
                                    </span>
                                </div>
                                <?php
                                $dpe = get_field('dpe');
                                switch ($dpe) {
                                    case $dpe <= 50 :
                                        $letter = "A";
                                        $top = 0;
                                        break;
                                    case $dpe < 90 :
                                        $letter = "B";
                                        $top = 20;
                                        break;
                                    case $dpe < 150 :
                                        $letter = "C";
                                        $top = 40;
                                        break;
                                    case $dpe < 230 :
                                        $letter = "D";
                                        $top = 60;
                                        break;
                                    case $dpe < 330 :
                                        $letter = "E";
                                        $top = 80;
                                        break;
                                    case $dpe < 450 :
                                        $letter = "F";
                                        $top = 100;
                                        break;
                                    case $dpe > 450 :
                                        $letter = "G";
                                        $top = 120;
                                        break;
                                }

                                    ?>
                                <div>
                                    <div class="property__features_dpe_letter"><?php echo $letter; ?></div>
                                    <div class="property__features_dpe_indice" style="top: <?php echo $top; ?>px;"><?php the_field('dpe'); ?></div>
                                </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <h3 class="property__features_title">À l'intérieur</h3>
                    <div class="d-flex flex-wrap">
                        <?php if(get_field('nb_pieces') && get_field('nb_pieces') > 0): ?>
                            <div class="property__features_item mr-5 d-flex flex-column">
                                <i class="property__features_icon fas fa-door-closed"></i>
                                <div>
                                    <?php the_field('nb_pieces'); ?>
                                    <label class="property__features_label">pièces</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('nb_chambres') && get_field('nb_chambres') > 0): ?>
                            <div class="property__features_item mr-5 d-flex flex-column">
                                <i class="property__features_icon fas fa-bed"></i>
                                <div>
                                    <?php the_field('nb_chambres'); ?>
                                    <label class="property__features_label">chambres</label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('nb_bain') && get_field('nb_bain') > 0): ?>
                            <div class="property__features_item mr-5 d-flex flex-column">
                                <i class="property__features_icon fas fa-bath"></i>
                                <div>
                                    <?php the_field('nb_bain'); ?>
                                    <label class="property__features_label">salles de bain</label>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                        <?php if (get_the_taxonomies() ) : ?>
                            <?php
                            $terms_plus = get_the_terms( $id, 'plus' );
                            if ( ! empty( $terms_plus ) && ! is_wp_error( $terms_plus ) ){
                                echo '<h3 class="property__features_title">Les plus</h3>';
                                echo '<div class="d-flex flex-wrap">';
                                foreach ( $terms_plus as $term ) {
                                    $term_link = get_term_link( $term, 'plus' );
                                    echo '<div class="property__features_item mr-5 d-flex flex-column"><i class="property__features_icon fas fa-'. $term->slug .'"></i>' . $term->name . '</div>';
                                }
                                echo '</div>';
                            }
                            ?>
                        <?php endif ?>

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