<?php /* Template Name: Gabarit Contact */ ?>

<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="contact">
            <div class="container">
                <h1 class="contact__title"><?php the_title(); ?></h1>
                <?php if(get_field('carte')) :?>
                    <?php the_field('carte'); ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-4 contact__left">
                        <h2 class="contact__subtitle">Infos</h2>
                        <?php if(get_field('infos-contact')) :?>
                            <?php $infos = strip_tags(get_field('infos-contact')); ?>
                            <p class="contact__infos"><?php echo $infos; ?></p>
                        <?php endif; ?>

                        <?php if(get_field('adresse')) :?>
                            <div class="contact__address"><?php the_field('adresse'); ?></div>
                        <?php endif; ?>

                        <?php if(get_field('ville')) :?>
                            <div class="contact__address"><?php the_field('ville'); ?></div>
                        <?php endif; ?>

                        <?php if(get_field('telephone')) :?>
                            <div class="contact__phone">Téléphone : <b><?php the_field('telephone'); ?></b></div>
                        <?php endif; ?>

                        <?php if(get_field('fax')) :?>
                            <div class="fax">FAX : <b><?php the_field('fax'); ?></b></div>
                        <?php endif; ?>

                        <?php if(get_field('email')) :?>
                            <div class="contact__mail">E-Mail : <b><?php the_field('email'); ?></b></div>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-8">
                        <h2 class="contact__subtitle">Envoyez-nous un message !</h2>
                        <?php the_content(); ?>
                    </div>

                </div>
            </div>
        </div>

    <?php endwhile;?>
<?php endif;?>

<?php get_footer(); ?>