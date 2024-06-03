<?php

get_header('noimage');
?>

<!--<div class="row">
	<div class="small-12 columns">
		<h1 class="section-title">Get Featured</h1>
		<p>Submissions are switched out monthly and posted on a first come basis. <a href="<?=site_url('submit-work')?>" class="nowrap">Submit Your Work</a></p>
	</div>
</div>-->

<div class="content noimage">
    <div class="contentZone0123boxed">
        <?php
        $term = get_queried_object_id();
        switch ($term){
            case "154";
                $description_post = get_post(15510);
                echo $description_post->post_content;
                break;
            case "155";
                $description_post = get_post(15514);
                echo $description_post->post_content;
                break;
        }
        ?>
    </div>
    <div class="contentZone1234 workList">
        <?php
        global $wp_query;
        $has_ad = false;
        $args = array_merge( $wp_query->query_vars, array(
            'post_status' => 'publish',
            'showposts' => 30,
            'paged'=>$paged
        ));
        query_posts($args);

         if (!have_posts()) { ?>
            <p><?php _e('Sorry, no work found.', 'roots'); ?> </p>
            <?php //get_search_form(); ?>
        <?php } else { ?>
        <?php $i=0;
        while (have_posts()) {

            the_post(); $i++; ?>

            <? $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'work'); ?>
            <div class="workItem">
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
                    <? $author = get_field('agency')?>
                    <? if($author){ ?>
                        <a class="workAgensyName" href="<?=$author->guid?>"><?=$author->post_title?></a><br />
                    <? } ?>
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

        <?php if ($wp_query->max_num_pages > 1) { ?>
            <?php echo roots_numbered_pagination(); ?>
        <?php } ?>
    <?php }; ?>

    </div>
</div>

<?
?>

<?php get_footer();