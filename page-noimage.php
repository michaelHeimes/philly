<?php
/**
 * Template Name: No Header Image
 *
 */

get_header('noimage');
?>
    <div class="content noimage">
        <div class="contentZone1234">
            <?php
            while ( have_posts() ) {
                the_post();
                the_content();
            }; // End of the loop.
            ?>
        </div>
        <div class="contentZone234">
            <?php the_field('content_zone_234'); ?>
        </div>
        <div class="contentZoneDonationButton">
            <?php the_field('content_zone_button_23'); ?>
        </div>

        <?php
        $rows = get_field('even_odd_content_zone');
        if($rows){ ?>
            <div class="evenOddContentZone">
                <?php foreach($rows as $row){ ?>
                    <div class="contentZoneAAAaBoxed">
                        <?php echo $row['text']?>
                        <a href="#" class="trickyRedMore">Read More On how To Help</a>
                        <div class="trickyRedMoreContent">
                            <?php echo $row['read_more']?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php get_footer();
