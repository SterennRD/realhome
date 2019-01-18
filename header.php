<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<? bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

        <header class="header">
            <div class="container header__container">
                <a href="<?php echo bloginfo('url'); ?>" class="header__logo">
                    Real<b>Home</b><span></span>
                </a>
                <?php wp_nav_menu(array( 'theme_location' => 'menu-principal','container' => 'nav', 'container_class' => 'header__menu')); ?>
                <?php wp_nav_menu(array( 'theme_location' => 'menu-secondaire','container' => 'nav', 'container_class' => 'header__menu_rs')); ?>
            </div>

        </header>
