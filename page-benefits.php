<?php
/**
 * Template Name: Benefits
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

        <div class="visualBlocksButton mb-40">
            <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/join/" >Become a members <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        </div>

        <div class="contentZone1234">
            <?php the_field('content_zone_1234'); ?>
        </div>

        <?php
        $rows = get_field('even_odd_benefits_zone');
        if($rows){
            $i=0;
            ?>
        <div class="evenOddBenefitsZone">
            <?php foreach($rows as $row){
                $i++;
                ?>
                <div class="contentZoneBBbbBoxed">
                    <a class="eozoneLink" name="eozone_<?php echo $i; ?>" id="eozone_<?php echo $i; ?>" ></a>
                    <div class="contentZoneBBbbBoxedText">
                        <?php echo $row['text']?>
                    </div>
                    <div class="zoneBBbbButton">
                        <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/join/" >Join Now <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
<?php get_footer();
