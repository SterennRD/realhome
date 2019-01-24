<?php get_header(); ?>

<!--    BANNIERE-->
    <section class="banner" style="<?php if (has_post_thumbnail()) : ?>background-image: url(<?php the_post_thumbnail_url(); ?>);<?php endif; ?>">
        <div class="container">
            <h1 class="banner__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

<!--    CONTENU PAGE D'ACCUEIL-->
            <section class="container home__article">
                <div class="row">
                    <?php the_content(); ?>
                </div>
            </section>

            <?php if( have_rows('features') ): ?>
                <section class='features'><div class='container'><div class='row'>
                <?php while ( have_rows('features') ) : the_row(); ?>
                    <div class="features__block col-sm-12 col-md-6 col-lg-3">
                        <div class="fas fa-<?php the_sub_field('icon'); ?> features__icon"></div>
                        <h3 class="features__title"><?php the_sub_field('titre-features'); ?></h3>
                        <?php
                            $features_txt = get_sub_field('texte-features');
                            $features_txt = strip_tags($features_txt);
                        ?>
                        <p class="features__txt"><?php echo $features_txt; ?></p>
                    </div>
                <?php endwhile; ?>
                </div></div></section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

<!--    AFFICHAGE DES DERNIERES PROPRIETES-->
        <?php
        $args = array(
            'post_type' => 'propriete',
            'posts_per_page' => 6,
            'order' => 'DESC',
            'orderby' => 'ID',
        );
        ?>

        <?php $the_query = new WP_Query($args);?>

        <?php if ( $the_query->have_posts() ) : ?>
            <section class="home__proprietes">
                <div class="container">
                    <h2 class="home__proprietes_title">Nos <b>propriétés</b></h2>
                    <p class="home__proprietes_txt">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <div class="row">
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                            <?php get_template_part( 'propriete-card' ); ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <a href="<?php bloginfo('url'); ?>/proprietes" class="button home__proprietes_button">
                            Voir toutes
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<!--    AFFICHAGE DES MEMBRES DE L'EQUIPE-->
        <?php
        $args_team = array(
            'post_type' => 'equipe',
            'posts_per_page' => 6,
            'order' => 'DESC',
        );
        ?>

        <?php $query_team = new WP_Query($args_team);?>

        <?php if ( $query_team->have_posts() ) : ?>
            <?php $nb = 0; ?>
            <section class="home__team">
                <div class="container">
                    <div class="row home__team_title_box">
                        <h2 class="col-md-9 col-lg-8 home__team_title">Nos <b>agents</b></h2>
                    </div>
                    <div class="row home__team_container">
                        <div class="home__team_controls">
                            <div class="home__team_control home__team_control_left">
                                <i class="fas fa-angle-left"></i>
                            </div>
                            <div class="home__team_control home__team_control_right">
                                <i class="fas fa-angle-right"></i>
                            </div>
                        </div>
                        <div class="home__team_wrapper">
                            <div class="home__team_content">
                                <?php while ( $query_team->have_posts() ) : $query_team->the_post(); ?>
                                    <?php $nb++; ?>
                                    <div class="home__team_item home__team_item--<?php echo $nb; ?> row m-0 p-0">
                                        <div class="col-md-3 col-lg-4">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img class="home__team_img" src="<?php the_post_thumbnail_url('large') ?>" />
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-9 col-lg-8 home__team_right">
                                            <h3 class="home__team_name"><?php the_title(); ?></h3>
                                            <?php if (get_field('texte-team')) : ?>
                                                <?php $texte = strip_tags(get_field('texte-team')); ?>
                                                <p class="home__team_txt"><?php echo $texte; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

<!--    AFFICHAGE DES PARTENAIRES-->
            <?php ( have_rows( 'partenaires' ) ); ?>
            <?php if( have_rows('partenaires') ): ?>
                <div class='container partners'><h2 class='partners__title'>Our <b>partners</b></h2>
                    <?php while ( have_rows('partenaires') ) : the_row();
                        $img = get_sub_field('logo'); ?>
                        <div class="partners__logo">
                            <img src="<?php echo $img['url']; ?>" alt="<?php if(get_sub_field('alt')): the_sub_field('alt'); endif;?>" title="<?php if(get_sub_field('alt')): the_sub_field('alt'); endif;?>"/>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>