<?php
/**
 * Template Name: Foundation
 *
 */

get_header();
?>
    <div class="content">
        <div class="contentZone0123boxed">
            <?php
            while ( have_posts() ) {
                the_post();
                the_content();
            }; // End of the loop.
            ?>
        </div>
        <div class="contentZone1234">
            <?php the_field('content_zone_1234'); ?>
        </div>
        <div class="contentZone234">
            <?php the_field('content_zone_234'); ?>
        </div>
        <div class="contentZoneDonationButton">
            <?php the_field('content_zone_button_23'); ?>
        </div>

        <?php if (trim(get_field('content_zone_234_boxed'))){?>
            <div class="contentZoneAAAaBoxed even">
                <?php the_field('content_zone_234_boxed'); ?>
            </div>
        <?php } ?>

        <?php
        $rows = get_field('even_odd_content_zone');
        if($rows){
            $i=0;
            ?>
        <div class="evenOddContentZone">
            <?php foreach($rows as $row){
                $i++;
                ?>
                <div class="contentZoneAAAaBoxed">
                    <a class="eozoneLink" name="eozone_<?php echo $i; ?>" id="eozone_<?php echo $i; ?>" ></a>
                    <?php echo $row['text']?>
                    <a href="#" class="trickyRedMore">Read More On how To Help</a>
                    <div class="trickyRedMoreContent">
                        <?php echo $row['read_more']?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
        <script>
            jQuery(document).ready(function($) {
                jQuery(".trickyRedMore").click(function (e) {
                    /*$('body').toggleClass('static');*/
                    e.preventDefault();
                    /*$(window).scrollTop(0);*/
                    $(this).parent().toggleClass("active");
                    return false;
                });
            });
        </script>
    </div>
<?php get_footer();
