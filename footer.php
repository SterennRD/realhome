<footer class="footer">
    <div class="container footer__container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                <a href="<?php echo bloginfo('url'); ?>" class="footer__logo">
                    Real<b>Home</b><span></span>
                </a>

                <?php wp_nav_menu(array( 'theme_location' => 'menu-secondaire','container' => 'nav', 'container_class' => 'footer__menu_rs')); ?>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                <h3 class="footer__title">Menu</h3>
                <?php wp_nav_menu(array( 'theme_location' => 'menu-principal','container' => 'nav', 'container_class' => 'footer__menu')); ?>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 mb-3 footer__contact">
                <h3 class="footer__title">Contact us</h3>
                <?php if(get_field('adresse', 74) && get_field('ville', 74)) :?>
                    <div class="footer__contact_txt footer__contact_address"><?php the_field('adresse', 74); ?>, <?php the_field('ville', 74); ?></div>
                <?php endif; ?>
                <?php if(get_field('telephone', 74)) :?>
                    <div class="footer__contact_txt">Téléphone : <b><?php the_field('telephone', 74); ?></b></div>
                <?php endif; ?>

                <?php if(get_field('fax', 74)) :?>
                    <div class="footer__contact_txt">FAX : <b><?php the_field('fax', 74); ?></b></div>
                <?php endif; ?>

                <?php if(get_field('email', 74)) :?>
                    <div class="footer__contact_txt footer__contact_mail">E-Mail : <a href="mailto:<?php the_field('email', 74); ?>"><?php the_field('email', 74); ?></a></div>
                <?php endif; ?>
            </div>


        </div>

    </div>
    <?php wp_footer(); ?>
</footer>
