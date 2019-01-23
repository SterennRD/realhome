<?php get_header(); ?>
    <div class="container properties">
        <h1 class="properties__title">Nos propriétés</h1>

        <?php
        $id = get_the_ID();
        $terms = get_the_terms( $id, 'ville' );

        $terms_list = get_terms( 'ville', [
            'hide_empty' => false,
        ]);

        echo '<div class="filter">';
        echo '<div class="filter__link" data-id="" href="">Tout</div>';

        foreach( $terms as $termCur ) {
        }
        foreach( $terms_list as $term ) {
            if ($term->slug == $termCur->slug) {
                echo '<div class="filter__link filter__link--active" data-id="' . $term->slug . '"> '. $term->name .'</div>';
            } else {
                echo '<div class="filter__link" data-id="' . $term->slug . '"> '. $term->name .'</div>';
            }
        }
        echo '</div>';
        ?>

        <!-- // Les arguments  -->
        <?php
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 2,
            'order' => 'DESC',
            'order by' => 'ID',
            'paged' => $paged,
            'ville' => $termCur->slug,
        );


        $custom_query = new WP_Query( $args );
        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $custom_query;

        ?>



        <!-- // The Loop -->
        <?php if ( $custom_query->have_posts() ) : ?>
            <div class="row properties__wrapper">
                <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <?php get_template_part( 'propriete-card' ); ?>
                <?php endwhile; ?>
                <div id="pagination" class="col-12 d-flex align-items-center justify-content-center">
                    <?php
                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $custom_query->max_num_pages
                    ) );
                    ?>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); // reset the query ?>

    </div>
<?php get_footer(); ?>
