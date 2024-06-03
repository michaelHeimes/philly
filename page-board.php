<?php
/**
 * Template Name: Board
 *
 */

get_header('noimage');
?>
<div class="content noimage">
    <div class="agFlexBox">
        <div class="contentZone0123boxed mb-50">
            <?php
            while ( have_posts() ) {
                the_post();
                the_content();
            }; // End of the loop.
            ?>
        </div>
        <div class="agRight agRightBigImgDirector mb-50">
            <?php
            $top_right_photo = get_field("top_right_photo");
            if($top_right_photo){
                ?>
                <img src="<?=$top_right_photo?>" alt="Executive Director">
            <?php } ?>
        </div>
    </div>

    <div class="contentZone1234 mb-50">
        <? if ( have_rows('officers') ): ?>
            <h3>Board of Directors</h3>
            <div class="boardList">
                <? while ( have_rows('officers') ) : the_row(); ?>
                    <? $img = get_sub_field('image')?>
                    <div class="boardItem">
                        <div class="img">
                            <? if($img) { ?>
                                <img src="<?=$img['sizes']['headshot']?>" alt="<? the_title()?>">
                            <? } ?>
                        </div>
                        <div class="boardItemText">
                            <div class="name">
                                <? if(get_sub_field('name')){ ?>
                                    <div><strong><? the_sub_field('name')?></strong></div>
                                <? } ?>
                                <div class="position"><strong><? the_sub_field('postion')?></strong></div>
                                <? if(get_sub_field('title')){ ?><? the_sub_field('title')?><? } ?>
                                <? if(!empty(get_sub_field('company')) && !empty(get_sub_field('title'))){ ?> / <? } ?>
                                <? the_sub_field('company')?>
                            </div>
                        </div>
                    </div>
                <? endwhile;?>
            </div>
        <? endif;?>
    </div>

    <div class="contentZone1234 mb-50">
        <? if ( have_rows('board_of_governors') ): ?>
            <h3>Governors</h3>
            <div class="boardList">
                <? while ( have_rows('board_of_governors') ) : the_row(); ?>
                    <? $img = get_sub_field('image')?>
                    <div class="boardItem">
                        <?php /* <div class="img">
                            <? if($img) { ?>
                                <img src="<?=$img['sizes']['headshot']?>" alt="<? the_title()?>">
                            <? } ?>
                        </div> */?>
                        <div class="boardItemText">
                            <div class="position"><strong><? the_sub_field('postion')?></strong></div>
                            <div class="name">
                                <? if(get_sub_field('name')){ ?>
                                    <div><strong><? the_sub_field('name')?></strong></div>
                                <? } ?>
                                <? if(get_sub_field('title')){ ?><? the_sub_field('title')?><? } ?>
                                <? if(get_sub_field('company')){ ?> / <? the_sub_field('company')?><? } ?>
                            </div>
                        </div>
                    </div>
                <? endwhile;?>
            </div>
        <? endif;?>
    </div>

    <div class="contentZone1234 mb-50">
        <? if ( have_rows('special_advisory_board') ): ?>
            <h3>SUPER ADVISORY BOARD</h3>
            <div class="boardList">
                <? while ( have_rows('special_advisory_board') ) : the_row(); ?>
                    <? $img = get_sub_field('image')?>
                    <div class="boardItem">
                        <?php /* <div class="img">
                            <? if($img) { ?>
                                <img src="<?=$img['sizes']['headshot']?>" alt="<? the_title()?>">
                            <? } ?>
                        </div> */?>
                        <div class="boardItemText">
                            <div class="position"><strong><? the_sub_field('postion')?></strong></div>
                            <div class="name">
                                <? if(get_sub_field('name')){ ?>
                                    <div><strong><? the_sub_field('name')?></strong></div>
                                <? } ?>
                                <? if(get_sub_field('title')){ ?><? the_sub_field('title')?><? } ?>
                                <? if(get_sub_field('company')){ ?> / <? the_sub_field('company')?><? } ?>
                            </div>
                        </div>
                    </div>
                <? endwhile;?>
            </div>
        <? endif;?>
    </div>
</div>

<?php get_footer();
