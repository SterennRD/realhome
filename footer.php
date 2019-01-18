<footer class="footer">
    <div class="container footer__container">
        <div class="row">
            <div class="col-lg-3">
                <a href="<?php echo bloginfo('url'); ?>" class="footer__logo">
                    Real<b>Home</b><span></span>
                </a>

                <?php wp_nav_menu(array( 'theme_location' => 'menu-secondaire','container' => 'nav', 'container_class' => 'footer__menu_rs')); ?>
            </div>
            <div class="col-lg-3">
                <h3 class="footer__title">Menu</h3>
                <?php wp_nav_menu(array( 'theme_location' => 'menu-principal','container' => 'nav', 'container_class' => 'footer__menu')); ?>
            </div>


        </div>

    </div>
    <?php wp_footer(); ?>
</footer>
