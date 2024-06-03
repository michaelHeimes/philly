<?php
/**
 * The header for our theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimumscale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">

    <?php wp_head(); ?>

    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/template.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo esc_url( home_url( '/' ) ); ?>favicon.png" />

    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.waypoints.min.js"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.cycle2.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.cycle2.tile.min.js"></script>

    <?php /* ?>
    <script src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js" type="text/javascript" language="text/javascript"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri(); ?>/slick/slick-theme.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.js?v=2.1.4"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
    <?php */ ?>

    <script type="text/javascript">
        function galleryInit(){
            var ww = document.body.clientWidth;
            var gal1width = jQuery('#container').width() - 64;

            if (ww < 800) {
                gal1width = ww;
            }
            jQuery("#gallery1").width(gal1width);
            jQuery(".gallery1Item").width(gal1width);
        }

        function adjustHeader(){
            var header1 = jQuery(".header").first();
            var h = header1.height();
            jQuery("body > .container").css({'padding-top' : h + 'px'});
            header1.css({'top' : '0', 'position':'fixed', 'width':'100%'});
        }

        jQuery(document).ready(function($){
            jQuery("#activateNav").click(function(e){
                /*$('body').toggleClass('static');*/
                e.preventDefault();
                /*$(window).scrollTop(0);*/
                $('#mainNav').toggleClass("open");
                return false;
            });
            /*NAV*/
            var ww = document.body.clientWidth;
            if (ww < 800) {
                $("#mainNav li.menu-item-has-children:not(.placeholder)").prepend("<div class='tgl2'></div>");
                $("#mainNav li.menu-item-has-children>a").click(function(e) {
                    if($(this).parent("li").hasClass("placeholder")){
                        e.preventDefault();
                        $(this).parent("li").toggleClass('hover');
                    } else {
                        if($(this).parent("li").hasClass("hover")){
                            if ($(e.target).closest(".tgl2").length){
                                e.preventDefault();
                                $(this).parent("li").toggleClass('hover');
                            }
                        } else {
                            e.preventDefault();
                            $(this).parent("li").toggleClass('hover');
                        }
                    }
                });
                $("#mainNav li>.tgl2").click(function(e) {
                    $(this).parent("li").toggleClass('hover');
                });
            } else {
                $("#mainNav li").hover(function() {
                    $(this).addClass('hover');
                }, function() {
                    $(this).removeClass('hover');
                });
                $("#mainNav li.placeholder>a").click(function(e){
                    e.preventDefault();
                    return(false);
                });
            }
            /*/NAV*/

            adjustHeader();

            jQuery(".jobZone").find("a").attr("target","_blank");
        });
    </script>
    <?php get_template_part('template-parts/tracking','head'); ?>
</head>

<body <?php body_class("innerPage"); ?> onresize="adjustHeader();">
<div class="test"></div>
<div class="container">
    <div class="header noimage">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo" />
        </a>
        <a href="#" class="toolTipMobile"><svg class="xrarr" viewBox="0 0 40 17"></svg> Member Login <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        <div class="navBlock">
            <div class="toolTip">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>newsletter-signup" class="toolTip1">Newsletter Signup</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>membership/login/" class="toolTip2">Member Login</a>
            </div>
            <div class="navBlockInner">
                <a href="#" id="activateNav"> </a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobileLogo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo" />
                </a>
                <div id="mainNav">
                    <?php wp_nav_menu(array('menu' => 'Main', 'container' => false )); ?>
                </div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>membership/join/" class="joinNowButton">Join Now<br />
                    <span class="xrarr">
                        <svg viewBox="0 0 90 17"><line x1="0" y1="8.5" x2="86.8" y2="8.5"></line><polyline points="80,1.7 86.8,8.5 80,15.3 "></polyline></svg>
                    </span>
                </a>
            </div>

        </div>
    </div><!-- /header -->
