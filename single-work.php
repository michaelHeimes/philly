<?php
get_header('work');
?>
<?php while (have_posts()) : the_post(); ?>
<div class="content noimage">

    <?php
    $args = array(
        'numberposts'     => 1000,
        'post_type' => 'work',
        'orderby'         => 'menu_order',
        'order'           => 'ASC'
    );
    $pitems = get_posts( $args );
    $next_id = 0;
    $prev_id = 0;
    $current_id = 0;
    foreach( $pitems as $pitem ) {
        if($current_id){
            $next_id = $pitem->ID;
            break;
        }
        if($pitem->ID == $post->ID){
            $current_id = $pitem->ID;
        } else {
            $prev_id = $pitem->ID;
        }
    }

    ?>
    <div class="portfolioNav">
        <?php if($prev_id){?><a href="<?echo get_permalink($prev_id);?>"><svg class="xrarr xrarr180" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg> Previous Work</a><?php } ?>
        <?php if($prev_id && $next_id){?> &nbsp;|&nbsp; <?php } ?>
        <?php if($next_id){?><a href="<?echo get_permalink($next_id);?>">Next Work <svg class="xrarr" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a><?php } ?>
    </div>


    <div class="contentZone0123boxed mb-30">
        <p>
        <?php if(trim(get_field('agency_custom_line'))){?>
            Agency: <?php the_field('agency_custom_line'); ?><br />
        <?php } else { ?>
            <?php $author = get_field('agency')?>
            <?php if($author){ ?>
                Agency: <?=$author->post_title; ?><br />
            <?php } ?>
        <?php } ?>
        <? if(get_field('custom_headline')){ ?>
            <?php the_field('custom_headline'); ?><br />
        <? } ?>
        Client: <?php the_field('client'); ?><br />
        Category: <?= strip_tags(get_the_term_list( get_the_ID(), 'work-category', '', ', ', '' ))?><br />
        </p>
    </div>
    <div class="contentZone1234 mb-50">
        <div class="content2columnZone">
            <div class="contentHalfLeftText">
                <?php the_content(); ?>
            </div>
            <div class="contentHalfRightMediaBoxedWrap">
                <div class="contentHalfRightMediaBoxed">
                    <?php
                    $rows = get_field('square_images');
                    if($rows)
                    {
                        ?>
                        <div class="squareGallery"
                             data-cycle-timeout=3000
                             data-cycle-fx="tileSlide"
                             data-cycle-tile-count=4
                             data-cycle-slides="> div"
                        >

                                <?php
                            foreach($rows as $row) {
                                $image1 = $row['image'];
                                $image_url = $image1['sizes']['fancybox'];
                                $image_url_fancybox = $image1['sizes']['fancybox'];
                                ?>
                                <div style="width: 100%">
                                <div style="height: 0; width: 100%; padding-bottom: 100%; position: relative;">
                                <div style="position: absolute; width: 100%; height: 100%; left: 0; top:0;display: flex; flex-direction: column; justify-content: center;align-items: center;background: url(<?php echo $image_url; ?>) no-repeat center #eeeff0; background-size: contain">
                                    <!--<img style="width: 100%; height: auto;" class="fancybox" data-fancybox-group="gallery1" data-fancybox-href="<?php echo $image_url_fancybox; ?>" src="<?php echo $image_url; ?>">-->
                                </div>
                                </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <script>
                            jQuery(document).ready(function($) {
                                var gal2 = jQuery('.squareGallery');
                                gal2.cycle();

                                var w = document.body.clientWidth;
                                if(w>800) {
                                    $(".fancybox").fancybox({
                                        openEffect: 'none',
                                        closeEffect: 'none'
                                    });
                                }
                            });
                        </script>

                        <?php
                    } else {
                        ?>
                        <script>
                            jQuery(document).ready(function($) {
                                var w = document.body.clientWidth;
                                if(w>800) {
                                    $(".fancybox").fancybox({
                                        openEffect: 'none',
                                        closeEffect: 'none'
                                    });
                                }
                            });
                        </script>
                        <a href="<?php echo the_post_thumbnail_url() ?>" class="fancybox">
                        <?php the_post_thumbnail('large', array('class'=>'post_thumb'));?>
                        </a>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!--<a href="<?=site_url('work')?>" class="button tiny">Return to All</a>-->

    <?php
    $rows = get_field('vimeo');
    if($rows)
    {
        foreach($rows as $row) {
            ?>
            <div class="contentZone1234 pb-30">
                <div style="padding:57% 0 0 0;position:relative; background: #000;">
                    <iframe src="https://player.vimeo.com/video/<?php echo $row['id_code'] ?>?color=ffffff&title=0&byline=0&portrait=0"
                            style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0"
                            allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
            </div>
            <?php
        }
        ?>
        <script src="https://player.vimeo.com/api/player.js"></script>
        <?php
    }
    ?>

</div>
<?php endwhile; ?>
<?php get_footer();
