<?php
get_header('noimage');
?>
<?php while (have_posts()) : the_post(); ?>
<div class="content noimage">
    <div class="agFlexBox">
        <div class="contentZone0123boxed mb-30">
            <h1 style="text-align: left"><? the_title()?></h1>
            <? $employer = get_field('employer'); ?>
            <p>
                <? if(get_field('employer_agency')){?>
                    <?php $ag_post = get_field('employer_agency'); ?>
                    Agency: <a href="<?echo get_permalink($ag_post->ID);?>"><?php echo $ag_post->post_title; ?></a><br />
                    <?php  } else { ?>
                    Agency: <a href="<?php @the_permalink($employer[0])?>"><?= @$employer[0]->post_title?></a><br />
                <?php } ?>
                Specialty: <? $terms = @wp_get_post_terms(get_the_ID(), 'area');?>
                    <?= @$terms[0]->name?><br />
                Posted: <? @the_field('embargo_date'); ?><br />
            </p>
        </div>
        <div class="agRight">
            <?php
            $thumb_id = get_post_thumbnail_id();
            if($thumb_id){
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'lil-logo', true);
                $thumb_url = $thumb_url_array[0];
                ?>
                <img src="<?=$thumb_url?>" alt="<? the_title()?>">
            <?php } else { ?>
                <? $employer = get_field('employer'); ?>
                <?php if( $post_thumb_url = get_the_post_thumbnail_url(@$employer[0])){ ?>
                    <img src="<?=$post_thumb_url?>" alt="<? the_title()?>">
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="contentZone1234">
        <div class="jobZone">
            <?php the_content(); ?>
        </div>
        <?php /* if(get_field('employer_agency')){?>
            <div class="info">
                <h3 class="section-title">Employer</h3>
                <p>
                    <?php $ag_post = get_field('employer_agency'); ?>
                    <a href="<?echo get_permalink($ag_post->ID);?>"><?php echo $ag_post->post_title; ?></a>
                </p>
            </div>
        <? } */ ?>

        <? if(get_field('recruitment_agency')){?>
            <div class="info">
                <h3 class="section-title">Recruitment Agency</h3>
                <p><? the_field('recruitment_agency')?></p>
            </div>
        <? } ?>

        <? if(get_field('website')){?>
            <div class="info">
                <h3 class="section-title">Website</h3>
                <p><a href="<? the_field('website')?>" target="_blank"><? the_field('website')?></a></p>
            </div>
        <? } ?>

        <? if(get_field('contact_email')){?>
            <div class="info">
                <h3 class="section-title">Contact Email</h3>
                <p><? the_field('contact_email')?></p>
            </div>
        <? } ?>

        <? if(get_field('contact_phone')){?>
            <div class="info">
                <h3 class="section-title">Contact Phone</h3>
                <p><? the_field('contact_phone')?></p>
            </div>
        <? } ?>

    </div>
</div>
<? endwhile;?>

<?php get_footer();
