<?php get_header(); ?>
    <div class="container actualites">
        <h1 class="actualites__title">
            <?php single_cat_title() ?>
        </h1>

        <div class="row">
            <div class="col-lg-8">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="actualites__item">
                            <h2 class="actualites__item__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title() ?>
                                </a>
                            </h2>
                            <?php if (get_the_post_thumbnail()) : ?>
                                <img class="actualites__img" src="<?php the_post_thumbnail_url('large'); ?>" />
                            <?php endif; ?>
                            <?php the_excerpt(); ?>
                            <a class="actualites__more" href="<?php the_permalink(); ?>">
                                Lire la suite
                            </a>
                            <hr class="actualites__sep">
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <?php if ( is_active_sidebar( 'primary' ) ) : ?>
                    <div class="sidebar">
                        <?php dynamic_sidebar( 'primary' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
<?php get_footer(); ?>