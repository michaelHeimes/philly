<?php
/**
 * Template Name: Job Board New
 *
 */

get_header('noimage');
?>
<div class="content noimage">

    <div class="contentZone1234 jobListWrap">
        <div class="jobList jobListNew">

        <?php
        while ( have_posts() ) {
            the_post();
            the_content();
        }; // End of the loop.
        ?>
        </div>
        <div class="jobSide">
            <?php
            $description_post = get_post(15525);
            echo $description_post->post_content;
            ?>
            <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/job-board/post-a-job/" >Post a Job <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        </div>

    </div>


</div>

<?php get_footer();
