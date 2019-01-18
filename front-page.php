<?php get_header(); ?>

    <section class="banner">
        <img src="<?php the_post_thumbnail_url(); ?>" class="banner__img"/>
        <div class="container">
            <h1 class="banner__title"><?php the_title(); ?></h1>
        </div>
    </section>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="container home_article">
                <div class="row">
                    <?php the_content(); ?>
                </div>
            </div>



            <?php
            if( have_rows('features') ):
                echo "<div class='features'><div class='container'><div class='row'>";
                while ( have_rows('features') ) : the_row(); ?>
                    <div class="features__block col-sm-12 col-md-6 col-lg-3">
                        <div class="dashicons <?php the_sub_field('icon'); ?> features__icon"></div>
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
            <?php ( have_rows( 'partenaires' ) ); ?>
            <?php
            if( have_rows('partenaires') ):
                echo "<div class='container partners'><h2 class='partners__title'>Our <b>partners</b></h2>";
                while ( have_rows('partenaires') ) : the_row();
                    $img = get_sub_field('logo'); ?>
                    <img src="<?php echo $img['url']; ?>" class="partners__logo" alt="<?php if(get_sub_field('logo')): the_sub_field('alt'); endif;?>"/>
                <?php endwhile;
                echo "</div>";
            endif;
            ?>
    <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>