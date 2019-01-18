<?php get_header(); ?>
<?php the_title(); ?>
    <img src="<?php the_post_thumbnail_url('medium') ?>" />
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
        <?php if(get_field('texte')): ?>
            <?php the_field('texte'); ?>
        <?php endif; ?>
        <?php if(get_field('photo')): ?>
            <?php $img = get_field('photo') ?>
            <?php if($img): ?>
                <img src='<?php echo $img['url'] ?>' alt='<?php echo $img['alt'] ?>'>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        if( have_rows('features') ):
            echo "<div class='features'>";
            while ( have_rows('features') ) : the_row(); ?>
                <div class="features__block">
                    <div class="dashicons <?php the_sub_field('icon'); ?> features__icon"></div>
                    <h3 class="features__title"><?php the_sub_field('titre-features'); ?></h3>
                    <p class="features__txt"><?php the_sub_field('texte-features'); ?></p>
                </div>
            <?php endwhile;
            echo "</div>";
        endif;
        ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>