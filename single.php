<?php get_header(); ?>
    <div class="container">
        <div class="row actualite">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-lg-8">
                        <h1 class="actualite__title"><?php the_title(); ?></h1>
                        <!-- <img src="<?php the_post_thumbnail_url('medium') ?>" alt="<?php  ?>" /> -->
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img class="actualite__thumbnail" src="<?php the_post_thumbnail_url('medium') ?>">
                        <?php endif; ?>
                        <div class="actualite__content">
                            <?php the_content(); ?>
                        </div>
                        <div class="actualite__footer">
                            <?php the_time('d M Y'); ?> <span class="actualite__footer_sep">/</span> <?php the_author(); ?>
                        </div>
                        <!-- Afficher la catégorie avec lien et liste -->
                        <!-- <?php the_category(); ?> -->

                        <!-- Afficher seulement le nom de catégorie -->
                        <?php
                        $category = get_the_category();
                        echo $category[0]->name;
                        ?>
                        <?php comments_template(); ?>
                    </div>

                    <div class="col-lg-4">
                        <?php if ( is_active_sidebar( 'primary' ) ) : ?>

                        <div class="sidebar">

                            <?php dynamic_sidebar( 'primary' ); ?>

                        </div>

                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </div>
<?php get_footer(); ?>