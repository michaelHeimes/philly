<?php
/**
 * Template Name: Contact
 *
 */

get_header('noimage');
?>
    <div class="content noimage">
        <div class="evenOddContactZone">
            <div class="contactZone12Boxed">
                <?php
                while ( have_posts() ) {
                    the_post();
                    the_content();
                }; // End of the loop.
                ?>
            </div>
            <div id="contactFormBox" class="contactZone23">
                <?php
                echo do_shortcode('[gravityform id="1" name="Contact Form" description="false" ajax="true"]');
                ?>
            </div>
        </div>

        <img class="contactImage" src="<?php the_field('contact_image'); ?>" />
    </div>
<?php get_footer();
