<?php
get_header('noimage');
?>
<?php while (have_posts()) : the_post(); ?>
    <div class="content noimage">
        <div class="agFlexBox">
            <div class="contentZone0123boxed mb-30">
                <h1 style="text-align: left"><? the_title()?></h1>
                <? if(get_field('website')){?>
                    <div class="info">
                        <p><a href="<? the_field('website')?>" target="_blank"><? the_field('website')?></a></p>
                    </div>
                <? } ?>
                <? if(get_field('contact_address')){?>
                    <div class="info">
                        <p><? the_field('contact_address')?></p>
                    </div>
                <? } ?>

            </div>
            <div class="agRight">
                <?php
                $thumb_id = get_post_thumbnail_id();
                if($thumb_id){
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'lil-logo', true);
                    $thumb_url = $thumb_url_array[0];
                    ?>
                    <img src="<?=$thumb_url?>" alt="<? the_title()?>">
                <?php } ?>
            </div>
        </div>
        <div class="contentZone1234">
            <?php the_content(); ?>
            <? if(get_field('summary')){?>
                <div class="info">
                    <h3 class="section-title">Summary</h3>
                    <? the_field('summary')?>
                </div>
            <? } ?>
            <? if(get_field('key_accounts')){?>
                <div class="info">
                    <h3 class="section-title">Key Accounts</h3>
                    <? the_field('key_accounts')?>
                </div>
            <? } ?>

            <? if(get_field('established')){?>
                <div class="info">
                    <h3 class="section-title">Established</h3>
                    <p><? the_field('established')?></p>
                </div>
            <? } ?>

            <? if(get_field('employees')){?>
                <div class="info">
                    <h3 class="section-title">Employees</h3>
                    <p><? the_field('employees')?></p>
                </div>
            <? } ?>

            <? if(get_field('key_contacts')){?>
                <div class="info">
                    <h3 class="section-title">Key Contacts</h3>
                    <? the_field('key_contacts')?>
                </div>
            <? } ?>

        </div>
    </div>
<? endwhile;?>

<?php get_footer();
