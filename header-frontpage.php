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
<?php */ ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.js?v=2.1.4"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />

    <meta name="image" property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/logo-social.png"/>
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="446">
    <meta property="og:image:height" content="201">

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

            jQuery('.textZone').waypoint(function(direction) {
                //console.log('waypoint1 '+ this.element.id);
                //console.log(direction);
                if(direction === 'down') {
                    jQuery('#'+this.element.id).addClass('active');
                } else {
                    jQuery('#'+this.element.id).removeClass('active');
                }
            }, { offset: '80%' });

            jQuery('#visualGaleryItem1_caption').addClass("active");
            var gal = jQuery('.visualGalery');
            gal.cycle();
            gal.on( 'cycle-before', function( e, opts, curr, next ) {
                var next_id = jQuery(next).attr('id');
                var curr_id = jQuery(curr).attr('id');
                jQuery('.visualCaption').addClass('inaction');
                setTimeout("jQuery('.visualCaption').removeClass('inaction')", 500);
                jQuery('#'+curr_id+'_caption').removeClass('active');
                jQuery('#'+next_id+'_caption').addClass('active');
            });

            if (ww > 800) {
                var $wrapper = $('.featuredContent');
                $wrapper.find('div[data-desktopsort]').sort(function (a, b) {
                    return +a.getAttribute('data-desktopsort') - +b.getAttribute('data-desktopsort');
                }).appendTo($wrapper);
            }
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".visualGaleryPlay").fancybox({
                wrapCSS: 'textpopupstyle',
                padding: 0,
                closeBtn:true,
                type:'iframe',
                autoCenter:true,
                autoResize:true,
                autoHeight:true,
                closeClick:false,
                width:640,
                height:385
            }); //-fancybox
        });
    </script>

    <?php get_template_part('template-parts/tracking','head'); ?>
</head>

<body <?php body_class("homePage"); ?> onresize="adjustHeader();">
<div class="test"></div>
<div class="container">
    <div class="header">
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
    
    <div class="visual">
        <div class="visualCaption">
            <?php
            $slideshow_cutoff_date = '1900-01-01';
            $slideshow_cutoff_date_field = get_field('slideshow_cutoff_date') ?? null;
            if( !empty($slideshow_cutoff_date_field) ) {
                $slideshow_cutoff_date = $slideshow_cutoff_date_field;
            }
            $args = array(  
                'post_type'      => 'work',
                'post_status'    => 'publish',
                'posts_per_page' => 10,
                'orderby'        => 'rand',
                'meta_query'     => array(
                    array(
                        'key'     => 'header_image',
                        'value'   => '',
                        'compare' => '!=',
                    ),
                ),
                'date_query'     => array(
                    array(
                        'after'     => $slideshow_cutoff_date,
                        'inclusive' => true,
                    ),
                ),
            );
            
            $loop = new WP_Query($args);
            $i = 1;
    
            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();
                    $img = get_field('header_image');
                    ?>
                    <div id="visualGaleryItem<?=$i;?>_caption" class="visualGaleryItemCaption">
                        <?php
                        $featured_work_post = get_the_ID();
                        $a = get_field('agency', $featured_work_post);
                        $c = get_field('client', $featured_work_post);
                        ?>
                        <p><em><a href="<?php the_permalink();?>"><?php the_title(); ?></a></em><br />
                        <?php if($a) { ?>
                            <strong>Agency:</strong> <?php echo $a->post_title; ?><br />
                        <?php } ?>
                        <?php if($c) { ?>
                            <strong>Client:</strong> <?php echo $c; ?><br />
                        <?php } ?>
                        <strong>Category:</strong> <?= strip_tags(get_the_term_list($featured_work_post, 'work-category', '', ', ', ''))?></p>
                    </div>
                    <?php
                    $i++;                
                endwhile;
            endif;
            ?>
        </div>
        <div class="visualGalery"
             data-cycle-timeout=5000
             data-cycle-fx="tileBlind"
             data-cycle-tile-count=15
             data-cycle-slides="> div">
            <?php
            $i = 1;
            if ($loop->have_posts()) : 
                while ($loop->have_posts()) : $loop->the_post();
                    $img = get_field('header_image') ?? null;
                    $has_video = false;
                    $vimeo = get_field('vimeo') ?? null;
                    $video_urls = get_field('video_urls') ?? null;
                    $featured_video_url = get_field('featured_video_url') ?? null;
                    if( !empty($vimeo) && empty( $featured_video_url ) ) {
                        $video_id = $vimeo[0]['id_code'];
                    }
                    if( !empty($featured_video_url) || !empty($video_id) || !empty($video_urls) ) {
                        $has_video = true;
                    }
                    if( $has_video == true && empty($vimeo[0]['id_code']) && !empty($video_urls) || $has_video == true && empty($vimeo) || $has_video == true && !empty($featured_video_url) ) {
                        // Load value from $featured_video_url or $video_urls
                        if (!empty($featured_video_url)) {
                            $iframe = $featured_video_url;
                        } elseif (!empty($video_urls)) {
                            $iframe = $video_urls[0]['video_url'];
                        }
                        // Load value.
                        // Use preg_match to find iframe src.
                        preg_match('/src="(.+?)"/', $iframe, $matches);
                        $src = $matches[1];
                        
                        // Add extra parameters to src and replace HTML.
                        $params = array(
                            'controls'  => 0,
                            'hd'        => 1,
                            'autohide'  => 1
                        );
                        $new_src = add_query_arg($params, $src);
                    }
                    ?>
                    <div class="visualGaleryItem <?=sanitize_title(get_the_title());?>" id="visualGaleryItem<?=$i;?>" style="background-image: url(<?=$img['sizes']['header_image']?>);">
                        <div class="visualGaleryClickLink" onclick="window.location='<?php the_permalink(); ?>'" style="cursor: pointer;">&nbsp;</div>
                        <?php
                            if( !empty($vimeo[0]['id_code']) && empty($iframe) ) : ?>
                                <a href="https://player.vimeo.com/video/<?=esc_attr( $video_id );?>?color=ffffff&title=0&byline=0&portrait=0" data-vimeo="<?=get_sub_field('vimeo')?>" class="visualGaleryPlay" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/play-button.png"></a>
                            <?php elseif( empty($vimeo[0]['id_code']) && !empty($iframe) ):?>
                                <a href="<?=esc_url($new_src);?>" class="visualGaleryPlay" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/play-button.png"></a>
                            <?php endif;
                        ?>
                        <?php if(get_field('logo')) { ?>
                            <img src="<?=get_field('logo')?>" class="visualGaleryItemLogo">
                        <?php } ?>
                    </div>
                    <?php
                    $i++;
                endwhile;
            endif;
            wp_reset_postdata(); 
            ?>
        </div>
    </div>

