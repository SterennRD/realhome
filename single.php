<?php get_header(); ?>
    <div class="container">
        <div class="row actualite">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-sm-12 col-md-9 col-lg-8">
                        <h1 class="actualite__title"><?php the_title(); ?></h1>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img class="actualite__thumbnail" src="<?php the_post_thumbnail_url('large') ?>">
                        <?php endif; ?>
                        <div class="actualite__content">
                            <?php the_content(); ?>
                        </div>
                        <div class="actualite__footer">
                            <?php the_time('d M Y'); ?> <span class="actualite__footer_sep">/</span> <?php the_author(); ?>
                        </div>
                        <div class="actualite__cat">
                            <?php
                            $categories = get_the_category();
                            $url = get_bloginfo('url');
                            foreach ( $categories as $category ) {
                                echo '<a class="badge actualite__badge mr-2" href="'.$url.'/category/'. $category->slug.'">'.$category->name .'</a>';
                            }
                            ?>
                        </div>
                        <?php comments_template(); ?>
                    </div>

                    <div class="col-md-3 col-lg-4 d-none d-md-block">
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