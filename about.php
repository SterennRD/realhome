<?php /* Template Name: Gabarit A propos */ ?>

<?php get_header(); ?>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="about">
                    <div class="container">
                        <h1 class="about__title">À <b>propos</b></h1>
                        <div class="row about__article">
                            <div class="col-lg-6">
                                <?php if (get_the_post_thumbnail()) : ?>
                                    <img class="about__img" src="<?php the_post_thumbnail_url('large'); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    if( have_rows('features', 13) ):
                        echo "<div class='features'><div class='container'><div class='row'>";
                        while ( have_rows('features', 13) ) : the_row(); ?>
                            <div class="features__block col-sm-12 col-md-6 col-lg-3">
                                <div class="fas fa-<?php the_sub_field('icon'); ?> features__icon"></div>
                                <h3 class="features__title"><?php the_sub_field('titre-features'); ?></h3>
                                <?php
                                $features_txt = get_sub_field('texte-features');
                                $features_txt = strip_tags($features_txt);
                                ?>
                                <p class="features__txt"><?php echo $features_txt; ?></p>
                            </div>
                        <?php endwhile;
                        echo "</div></div></div>";
                    endif;
                    ?>

                    <div class="container about__team">
                        <h2 class="about__team_title">Notre <b>équipe</b></h2>

                        <?php
                        $args = array(
                            'post_type' => 'equipe',
                            'order' => 'ASC',
                        );
                        ?>
                        <?php $the_query = new WP_Query($args);?>

                        <?php if ( $the_query->have_posts() ) : ?>
                            <div class="row">
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <div class="col-lg-3">
                                <div class="team">
                                    <div class="team__img<?php if(!get_the_post_thumbnail()) : ?> team__img--empty<?php endif; ?>">
                                        <?php if(get_the_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('large'); ?>" />
                                        <?php endif; ?>
                                    </div>


                                        <h3 class="team__name"><?php the_title(); ?></h3>


                                    <?php if(get_field('poste')): ?>
                                        <h4 class="team__role"><?php the_field('poste') ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            <?php endwhile;?>
        <?php endif;?>

<?php get_footer(); ?>