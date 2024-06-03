<?php

get_header('noimage');
?>
<div class="content noimage">
    <div class="agFlexBox">

        <div class="contentZone0123boxed permanentGray zoneForForm mb-0 pb-30">
            <h1>Your source for Greater Philadelphia advertising, digital and media jobs.</h1>
            <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="hidden" name="post_type" value="job" />
                <h3 class="section-title">Refine Your Search</h3>
                <div class="formCheckboxRow">
                    <?php
                    $levels = array('executive','senior','middle','junior','freelance','intern');
                    ?>
                    <?php foreach($levels as $key => $level){ ?>
                        <label><input type="checkbox" name="level[]" value="<?=strtolower($level)?>" <?php if(isset($_GET['level']) and is_array($_GET['level']) and in_array($level, $_GET['level'])){echo " checked ";}?>> <?=$level?></label>
                    <?php } ?>
                </div>
                <div class="formRow">
                    <div class="col13">
                        <? $areas = get_terms('area'); ?>
                        <? if($areas) { ?>
                            <select class="input" name="area">
                                <option value="">Select Area</option>
                                <? foreach($areas as $area){ ?>
                                    <option <?=(@$_GET['area'] === $area->slug)?'selected="selected"':''?> value="<?= $area->slug?>"><?= $area->name?></option>
                                <? } ?>
                            </select>
                        <? } ?>
                    </div>
                    <div class="col13">
                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="Enter a Keyword">
                    </div>
                    <div class="col13">
                        <button type="submit" class="button searchJob"><?php _e('Search', 'roots'); ?> <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></button>
                    </div>
                </div>
            </form>

        </div>
        <div class="agRight agRightBigImg">
            <?php
            $adv_image_url = get_field("adv_image",15525);
            if($adv_image_url){
                ?>
                <img src="<?=$adv_image_url?>" alt="AD">
            <?php } ?>
        </div>

    </div>
    <div class="contentZone1234 jobListWrap">
        <div class="jobList">

    <?php
    global $wp_query;
    $args = array_merge( $wp_query->query_vars, array(
        'post_type' => 'job',
        'post_status' => 'publish',
        'posts_per_page' => 25,
        'meta_query' => array(
            'relation' => 'AND',
            array(	// past their embargo date
                'key' => 'embargo_date',
                'compare' => '<',
                'type' => 'DATE',
                'value' => date('Y-m-d'),
            ),
        ),
        'meta_key'   => 'embargo_date',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
    ));
    if(isset($_GET['level']) and is_array($_GET['level'])) {
        $level = implode(',',$_GET['level']);
        if (trim($level)) {
            //echo "LEVEL------------>" . $level;
            $tax_query = array(
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'level',
                        'field' => 'slug',
                        'terms' => $_GET['level'],
                        //'operator' => 'OR'
                    ),
                ),
            );
            $args = array_merge($args, $tax_query);
        }
    }
    //var_dump($args);

    unset($args['taxonomy']);
    unset($args['term']);
    unset($args['level']);
    ?>
    <? query_posts($args); ?>

    <?php if (!have_posts()) : ?>
        <p>&nbsp;</p>

        <p><?php _e('Sorry, no jobs were found.', 'roots'); ?> </p>
        <p>&nbsp;</p>

    <?php else: ?>



        <table class="job_table" cellspacing="0" cellpadding="0">
            <tbody>
                <?php while (have_posts()) : the_post(); ?>

                    <? $employer = get_field('employer'); ?>
                    <tr data-clickable="<? the_permalink()?>">
                        <td class="joTd0">
                            <?php
                            $thumb_id = get_post_thumbnail_id();
                            if($thumb_id) {
                                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'lil-logo', true);
                                $thumb_url = $thumb_url_array[0];
                                ?>
                                <a href="<?php the_permalink()?>"><img src="<?=$thumb_url?>" alt="<? the_title()?>"></a>
                            <?php } else { ?>
                                <?php if( $post_thumb_url = get_the_post_thumbnail_url(@$employer[0])){ ?>
                                    <a href="<?php the_permalink()?>"><img src="<?=$post_thumb_url?>" alt="<? the_title()?>"></a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td class="joTd1">
                            <h3><a href="<? the_permalink()?>"><?= the_title()?></a></h3>
                            <?php the_field('location')?>
                            <?= @$employer[0]->post_title?>
                            <?php // $terms = wp_get_post_terms(get_the_ID(), 'area');?>
                            <?php //echo @$terms[0]->name?>
                        </td>
                        <td class="joTd2">
                            <? the_field('embargo_date'); ?>
                        </td>
                        <td class="joTd3">
                            <? if(get_field('recruitment_agency')) { ?>
                                <div class="ra" data-tooltip aria-haspopup="true" class="has-tip" title="Recruitment Agency">RA</div>
                            <? } ?>
                        </td>
                    </tr>


                <?php endwhile; ?>
            </tbody>
        </table>



        <?php if ($wp_query->max_num_pages > 1) : ?>
          <?php echo roots_numbered_pagination(); ?>
        <?php endif; ?>
    <?php endif; ?>

        </div>
        <div class="jobSide">
            <?php
            $description_post = get_post(15525);
            echo $description_post->post_content;
            ?>
            <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>job-page/post-a-job/" >Post a Job <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        </div>
    </div>
</div>

<?php get_footer();