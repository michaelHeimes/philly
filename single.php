<?php
/**
 * The template for displaying blog
 *
 */

get_header("blog");
if(!isset($image_id)){
    $image_id = get_post_thumbnail_id();
}
$image_url = wp_get_attachment_image_src($image_id, 'full', true);

if($image_id){
    $image_url2 = $image_url[0];
}
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-563a25b242f124b3" async="async"></script>

<div class="content noimage blogSingleContent">
    <div class="portfolioNav">
        <?php next_post_link('%link', '<svg class="xrarr xrarr180" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg> Newer Post', 'yes'); ?>
        <?php previous_post_link('%link', 'Older Post <svg class="xrarr" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg>', 'yes'); ?>

        <?php /* if($prev_id){?><a href="<?echo get_permalink($prev_id);?>"><svg class="xrarr xrarr180" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg> Previous Work</a><?php } ?>
        <?php if($prev_id && $next_id){?> &nbsp;|&nbsp; <?php } ?>
        <?php if($next_id){?><a href="<?echo get_permalink($next_id);?>">Next Work <svg class="xrarr" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a><?php } ?>
 */?>
    </div>

    <div class="contentZone0123boxed mb-30">
        <h1><?php the_title()?></h1>
        <div class="blogDate"><?php echo get_the_date('n/j/Y',$post->ID); ?></div>
        <div class="itemShareBox">
            Share this post <div data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" class="addthis_sharing_toolbox"></div>
        </div>
    </div>

    <div class="contentZone1234 mb-50">

        <div class="bl2Box">
            <div class="blogBoxSingle">
                <div>
                    <?php
                    if($image_id) { ?>
                        <div class="postImageWrap">
                            <img src="<?=$image_url2?>" alt="<?php echo get_the_title($latest_id); ?>">
                        </div>
                    <? } ?>
                    <div class="contentPadding">
                        <?php
                        while ( have_posts() ) {
                            the_post();
                            the_content();
                        }; // End of the loop.
                        ?>
                    </div>
                    <?php
                    //the_post_navigation( array(
                    //    'next_text' => '<span class="moreMore">Newer Post</span>',
                    //    'prev_text' => '<span class="lessMore">Older Post</span>',
                    //) );
                    ?>
                </div>
            </div>
        </div>

        <!--<div class="singlePaginationWrap">
            <div class="navigation post-navigation">
                <?php next_post_link('%link', '<span class="lessMore">Newer Post</span>', 'yes'); ?>
                <?php previous_post_link('%link', '<span class="moreMore">Older Post</span>', 'yes'); ?>
            </div>
        </div>-->


    </div>
</div>

<?php

get_footer();
?>