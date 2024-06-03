<?php

get_header('noimage');
?>
<div class="content noimage">
    <div class="agFlexBox">

        <div class="contentZone0123boxed permanentGray zoneForForm mb-0 pb-30">
            <h1>Directory</h1>
            <form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="hidden" name="post_type" value="agency" />
                <h3 class="section-title">Search Members</h3>
                <div class="formRow">
                    <div class="col13">

                        <?php $specialties = get_field_object('specialty', 9522) ?>
                        <?php if($specialties && $specialties['choices']) { ?>
                            <select class="input" name="specialty">
                                <option value="">Select Specialty</option>
                                <?php foreach($specialties['choices'] as $key => $value){ ?>
                                    <option value="<?=$key?>" <?=(@$_GET['specialty'] === $key)?'selected="selected"':''?>><?=$value?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="col13">
                        <?php $size = get_field_object('size', 9522) ?>
                        <?php if($size && $size['choices']) { ?>
                            <select class="input" name="size">
                                <option value="">Select Size</option>
                                <?php foreach($size['choices'] as $key => $value){ ?>
                                    <option value="<?=$key?>" <?=(@$_GET['size'] === $key)?'selected="selected"':''?>><?=$value?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="col13">
                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
                        <div style="height: 15px"></div>
                        <button type="submit" class="button searchJob" style="width: 95%"><?php _e('Search', 'roots'); ?> <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="agRight" style="align-self: flex-end">
            <?php /* ?>
            <div class="agRightButtonInner">
                <?php echo get_field("buy_a_listing", 15769); ?>
                <a style="display: block; text-align: center" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/buy-a-listing/" class="button">Buy a listing <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
            </div>
            <?php */ ?>
        </div>
    </div>




    <?php
    global $wp_query;
    $new_args = array(
        'post_type' => 'agency',
        'post_status' => 'publish',
        'posts_per_page' => 50,
        'meta_query' => array(
            array(
                'key' => 'show_in_directory',
                'compare' => '=',
                'value' => true,
            ),
        ),
        'orderby' => 'title',
        'order' => 'ASC'
    );

    if(isset($_GET['specialty']) && ($_GET['specialty'] <> '')){
        $new_args['meta_query'][] = array(
            'key' => 'specialty',
            'compare' => '=',
            'value' => $_GET['specialty'],
        );
    }
    if(isset($_GET['size']) && ($_GET['size'] <> '')){
        $new_args['meta_query'][] = array(
            'key' => 'size',
            'compare' => '=',
            'value' => $_GET['size'],
        );
    }

    $args = array_merge($wp_query->query_vars, $new_args);

    query_posts($args);
    ?>

    <?php if (!have_posts()) : ?>
        <p>&nbsp;</p>
        <p><?php _e('Sorry, no agencies were found.', 'roots'); ?> </p>
        <?php //get_search_form(); ?>
        <p>&nbsp;</p>
    <?php else: ?>
        <div class="contentZone1234 workList">

            <?php while (have_posts()) : the_post(); ?>

                <?php
                    //$employer = get_field('employer');
                    $i++;

                    if($class == "workItemA"){ $class = "workItemB"; }
                    elseif($class == "workItemB") {$class = "workItemC";}
                    elseif($class == "workItemC") {$class = "workItemD";}
                    elseif($class == "workItemD") {$class = "workItemA";}
                    elseif($class == "") {$class = "workItemA";};
                ?>
                <div class="workItem <?=$class?>" id="workItem_<?=$i?>">
                    <a href="<? the_permalink()?>" class="img" data-equalizer-watch>
                        <?php
                        $thumb_id = get_post_thumbnail_id();
                        if($thumb_id){
                            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'lil-logo', true);
                            $thumb_url = $thumb_url_array[0];
                            ?>
                            <img src="<?=$thumb_url?>" alt="<? the_title()?>">
                        <? } else { ?>
                            <img src="<?=get_stylesheet_directory_uri()?>/assets/img/default.png" alt="<? the_title()?>">
                        <? } ?>
                    </a>
                    <div class="workItemText">
                        <a class="workAgensyName" href="<? the_permalink()?>"><?= the_title()?></a><br />
                        <strong>Location: </strong> <?php the_field('location')?><br />
                        <?php
                        $field = get_field_object('size');
                        $value = get_field('size');
                        $size = isset($field['choices'][ $value ]) ? $field['choices'][ $value ] : "";
                        if($size){
                            ?>
                            <strong>Size: </strong><?php echo $size ?><br />
                            <?php
                        }
                        ?>
                        <strong>Specialty: </strong>
                        <?
                        $field = get_field_object('specialty');
                        $value = get_field('specialty');
                        echo isset($field['choices'][ $value ]) ? $field['choices'][ $value ] : "";
                        ?><br />
                    </div>

                </div>
            <?php endwhile; ?>

        </div>

        <div class="clear"></div>
        <div class="contentZone1234 workList">

            <?php if ($wp_query->max_num_pages > 1) : ?>
                <?php echo roots_numbered_pagination(); ?>
            <?php endif; ?>
        </div>

    <?php endif; ?>

</div>


<?php /*
         <div class="agNrSide">
            <?php echo get_field("buy_a_listing", 15769); ?>
            <a style="display: block; text-align: center" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/buy-a-listing/" class="button">Buy a listing <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        </div>
*/ ?>
<?php
/*

$ad_args = array(
    'post_type' => 'agency',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'featured',
            'compare' => '==',
            'value' => '1',
        )
    ),
    'orderby'=> 'title',
    'order' => 'ASC'
);
$loop = new WP_Query( $ad_args );
?>
<? if($loop->have_posts()){?>
    <ul class="small-block-grid-2 featured_agencies">
        <?php while ( $loop->have_posts() ) : $loop->the_post();?>
            <?
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'lil-logo', true);
            $thumb_url = $thumb_url_array[0];
            ?>
            <li><a href="<? the_permalink()?>"><img src="<?=$thumb_url?>" alt="<? the_title()?>"></a></li>
        <? endwhile; ?>
    </ul>
<? } ?>
<? wp_reset_query();
*/
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


            jQuery("title").text("Agencies Archive - Philly Ad Club");
        });
    </script>

<?php get_footer();