<?php

/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!hello_get_header_display()) {
    return;
}


$viewport_content = apply_filters('hello_elementor_viewport_content', 'width=device-width, initial-scale=1');
$enable_skip_link = apply_filters('hello_elementor_enable_skip_link', true);
$skip_link_url = apply_filters('hello_elementor_skip_link_url', '#content');


$is_editor = isset($_GET['elementor-preview']);
$site_name = get_bloginfo('name');
$tagline   = get_bloginfo('description', 'display');
$header_nav_menu = wp_nav_menu([
    'theme_location' => 'menu-1',
    'fallback_cb' => false,
    'echo' => false,
]);
?>


<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="<?php echo esc_attr($viewport_content); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php if ($enable_skip_link) { ?>
        <a class="skip-link screen-reader-text" href="<?php echo esc_url($skip_link_url); ?>"><?php echo esc_html__('Skip to content', 'hello-elementor'); ?></a>
    <?php } ?>

    <header id="site-header" class="site-header">

        <div class="site-branding">
            <div id="headerTop">
                <div class="container">
                    <div class="ht-left flex">
                        <div class="locate-store">
                            <a href="#">
                                <p>Locate nearby store</p>
                            </a>
                        </div>
                        <div class="track-order">
                            <a href="#">
                                <p>Track your order</p>
                            </a>
                        </div>
                    </div>
                    <div class="ht-right flex">
                        <div class="socials">

                        </div>
                        <div class="my-account">

                        </div>
                    </div>
                </div>
            </div>
            <div id="headerBottom">
                <div class="container">
                    <div class="hb-left">
                        <?php if ($header_nav_menu) : ?>
                            <nav class="site-navigation">
                                <?php

                                echo $header_nav_menu;
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                    <div class="hb-right">
                        <?php if (class_exists('YITH_WCWL') && function_exists('yith_wcwl_wishlist_count')) : ?>
                            <div class="wishlist-icon">
                                <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="wishlist-icon-link">
                                    <i class="fa fa-heart"></i>
                                    <span class="wishlist-count"><?php echo yith_wcwl_wishlist_count(); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } elseif ($site_name) {
            ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr__('Home', 'hello-elementor'); ?>" rel="home">
                        <?php echo esc_html($site_name); ?>
                    </a>
                </h1>
                <p class="site-description">
                    <?php
                    if ($tagline) {
                        echo esc_html($tagline);
                    }
                    ?>
                </p>
            <?php } ?>
        </div>
    </header>