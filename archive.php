<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */


get_header("noimage");

//get latest article
$latest_id = 0;
?>
    <div class="content noimage">
        <div class="contentZone01black">
            <form id="filterForm" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <?php wp_dropdown_categories(array('id' => 'catSelect', 'show_option_all' => 'Select Category')); ?>
                <!--<input type="hidden" value="post" name="post_type" id="post_type" />-->
                <div class="clear"></div>
            </form>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#catSelect').change(function(){
                    $('#filterForm').submit();
                });
            });
        </script>


        <div class="contentZone1234 blogList">
            <?php
            if ( have_posts() ) { ?>
                <?php

                $i=0;
                $class = "";

                while ( have_posts() ) {
                    the_post();

                    if ($latest_id !== get_the_ID()) {
                        $i++;
                        if($class == "workItemA"){ $class = "workItemB"; }
                        elseif($class == "workItemB") {$class = "workItemC";}
                        elseif($class == "workItemC") {$class = "workItemD";}
                        elseif($class == "workItemD") {$class = "workItemA";}
                        elseif($class == "") {$class = "workItemA";};

                        $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'work_square');
                        ?>
                        <div class="blogItem <?=$class?>" id="workItem_<?=$i?>">
                            <a href="<?php the_permalink()?>" class="img" data-equalizer-watch>
                                <? if($img) { ?>
                                    <img src="<?=$img[0]?>" alt="<? the_title()?>">
                                <? } else { ?>
                                    <img src="<?=get_stylesheet_directory_uri()?>/assets/img/default.png" alt="<? the_title()?>">
                                <? } ?>
                            </a>
                            <div class="blogItemText">
                                <div class="blogCat"><?php echo get_the_category( $id )[0]->name; ?></div>
                                <a class="blogTitleLink" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="blogDate"><?php echo get_the_date('n/j/Y', $post->ID); ?></div>
                                <div class="blogMore"><a href="<?php the_permalink(); ?>">Learn More</a></div>
                            </div>
                        </div>
                    <?php } //if?>
                <?php } //while ?>

            <?php } else { ?>
                <h1>No Posts</h1>
            <?php } //if ?>

        </div>

        <div class="contentZone1234">
            <?php if ($wp_query->max_num_pages > 1) { ?>
                <?php
                /*
                    the_posts_pagination( array(
                        'prev_text' => '<span class="lessMore">Newer Posts</span>',
                        'next_text' => '<span class="moreMore">Older Posts</span>',
                        'before_page_number' => '',
                    ) );
                */
                ?>
                <?php echo roots_numbered_pagination(); ?>
            <?php } ?>
        </div>

        <div class="clear"></div>
    </div>

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

<?php
get_footer();
?>