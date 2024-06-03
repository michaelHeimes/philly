<?php
/**
 * Template Name: Test
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

            /*
                grp="..." - comma separated list of event categories to pull from (default all)
                cnt="3" - number of upcoming events to display (default 3)
                lgo="1" - display event thumbnail
                szp="1" - do not display event start date/time
                ezp="1" - do not display event end date/time
                adn="1" - display event location
             */

            echo apply_filters( 'the_content',' [mw eventwidget cnt="4" lgo="0" adn="0" ezp="1"] ');
            ?>
            <script type="text/javascript" src="https://cdn.membershipworks.com/mfm.js"></script>
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
