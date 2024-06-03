<?php

get_header('noimage');
?>

<div class="content noimage">
    <div class="agFlexBox">
        <div class="contentZone0123boxed">
            <?php
            $description_post = get_post(15352);
            echo $description_post->post_content;
            ?>
        </div>
        <div class="agRight agRight31 mb-40" style="align-self: self-end;">
            <div style="width: 100%; margin: auto">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>work-page/submit-work/" class="button">Submit work to be featured <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
            </div>
        </div>
    </div>
    <div class="contentZone1234 workList">
        <?php
        global $wp_query;
        $has_ad = false;
        $args = array_merge( $wp_query->query_vars, array(
            'post_status' => 'publish',
            'showposts' => 32,
            'paged'=>$paged
        ));
        query_posts($args);

         if (!have_posts()) { ?>
            <p><?php _e('Sorry, no work found.', 'roots'); ?> </p>
            <?php //get_search_form(); ?>
        <?php } else { ?>
        <?php $i=0;
        $class = "";

        while (have_posts()) {

            the_post(); $i++;

            if($class == "workItemA"){ $class = "workItemB"; }
            elseif($class == "workItemB") {$class = "workItemC";}
            elseif($class == "workItemC") {$class = "workItemD";}
            elseif($class == "workItemD") {$class = "workItemA";}
            elseif($class == "") {$class = "workItemA";};
            ?>

            <? $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'work'); ?>
            <div class="workItem <?=$class?>" id="workItem_<?=$i?>">
                <a href="<? the_permalink()?>" class="img" data-equalizer-watch>
                    <? if($img) { ?>
                        <img src="<?=$img[0]?>" alt="<? the_title()?>">
                    <? } else { ?>
                        <img src="<?=get_stylesheet_directory_uri()?>/assets/img/default.png" alt="<? the_title()?>">
                    <? } ?>
                </a>

                <?php /*
                <div class="title">
                    <?php the_title()?>
                </div>
                <div class="award">
                    <?= strip_tags(get_the_term_list( get_the_ID(), 'award' ))?>
                </div>
                <div class="author">
                    <? $author = get_field('agency')?>
                    <? if($author){ ?>
                        By <a href="<?=$author->guid?>"><?=$author->post_title?></a>
                    <? } ?>
                </div>
                */ ?>
                <div class="workItemText">
                    <?php if(trim(get_field('agency_custom_line'))){?>
                        <span class="agencyCustomLine"><?php the_field('agency_custom_line'); ?></span><br />
                    <?php } else { ?>
                        <?php $author = get_field('agency')?>
                        <?php if($author){ ?>
                            <a class="workAgensyName" href="<?=$author->guid?>"><?=$author->post_title?></a><br />
                        <?php } ?>
                    <?php } ?>
                    <strong>Client: </strong> <?php the_field('client'); ?><br />
                    <strong>Category: </strong> <?= strip_tags(get_the_term_list( get_the_ID(), 'work-category', '', ', ', '' ))?><br />
                </div>

            </div>


            <?php
            /*
            if($i==3){ ?>
                <? $posts = get_field('ads', 11283); // fetured work ad?>
                <? if( $posts ): ?>
                    <? foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                        <div class="work medium-6 columns">
                            <?php setup_postdata($post); ?>
                            <div class="sda text-center">
                                <? $ad = get_field('artwork')?>
                                <a href="<? the_field('link')?>" target="_blank">
                                    <img src="<?= $ad['url']?>" alt="<? the_title()?>">
                                </a>
                                <h3 class="no-border">Advertisement</h3>
                            </div>
                        </div>
                        <? $has_ad = true; break; endforeach; ?>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <? } ?>
            */
                 ?>

         <?php } ?>

        <!--<div class="clear"></div>-->

    </div>
    <div class="contentZone1234">

        <?php if ($wp_query->max_num_pages > 1) { ?>
            <?php echo roots_numbered_pagination(); ?>
        <?php } ?>
    </div>
    <?php }; ?>


    <div class="contentZone1234">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>work-page/submit-work/" class="button">Sumbit work to be featured <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
    </div>

    <div class="clear"></div>

</div>
</div>

<?
?>
<script>
    jQuery(document).ready(function($) {
        var ww = document.body.clientWidth;

            jQuery('.workItemA').waypoint(function (direction) {
                console.log('waypoint2 ' + this.element.id);
                console.log(direction);
                if (direction === 'down') {
                    jQuery('#' + this.element.id).addClass('active');
                } else {
                    jQuery('#' + this.element.id).removeClass('active');
                }
            }, {offset: '90%'});

            jQuery('.workItemB').waypoint(function (direction) {
                console.log('waypoint2 ' + this.element.id);
                console.log(direction);
                if (direction === 'down') {
                    jQuery('#' + this.element.id).addClass('active');
                } else {
                    jQuery('#' + this.element.id).removeClass('active');
                }
            }, {offset: '85%'});

            jQuery('.workItemC').waypoint(function (direction) {
                console.log('waypoint2 ' + this.element.id);
                console.log(direction);
                if (direction === 'down') {
                    jQuery('#' + this.element.id).addClass('active');
                } else {
                    jQuery('#' + this.element.id).removeClass('active');
                }
            }, {offset: '80%'});

            jQuery('.workItemD').waypoint(function (direction) {
                console.log('waypoint2 ' + this.element.id);
                console.log(direction);
                if (direction === 'down') {
                    jQuery('#' + this.element.id).addClass('active');
                } else {
                    jQuery('#' + this.element.id).removeClass('active');
                }
            }, {offset: '75%'});


    });
</script>
<?php get_footer();