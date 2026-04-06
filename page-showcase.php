<?php
/**
 * Template Name: Showcase
 */

get_header();
the_post();
?>

<div class="content noimage">
  <div class="agFlexBox">
    <div class="contentZone0123boxed">
      <?php the_content(); ?>
    </div>

    <div class="agRight agRight31 mb-40" style="align-self: self-end;">
      <div style="width: 100%; margin: auto">
        <a href="<?php echo esc_url(home_url('/showcase/spotlight-work/')); ?>" class="button">
          Submit work to be featured
        </a>
      </div>
    </div>
  </div>

  <div class="contentZone1234 workList">
    <?php
    $paged = get_query_var('paged') ?: 1;

    $work_query = new WP_Query([
      'post_type'      => 'work',
      'post_status'    => 'publish',
      'posts_per_page' => 32,
      'paged'          => $paged,
    ]);

    if (!$work_query->have_posts()) :
    ?>
      <p><?php _e('Sorry, no work found.', 'roots'); ?></p>
    <?php
    else :
      $i = 0;
      $class = '';
      while ($work_query->have_posts()) :
        $work_query->the_post();
        $i++;

        $class = match ($class) {
          'workItemA' => 'workItemB',
          'workItemB' => 'workItemC',
          'workItemC' => 'workItemD',
          default     => 'workItemA',
        };

        $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'work');
        ?>
        <div class="workItem <?php echo esc_attr($class); ?>" id="workItem_<?php echo $i; ?>">
          <a href="<?php the_permalink(); ?>" class="img" data-equalizer-watch>
            <?php if ($img) : ?>
              <img src="<?php echo esc_url($img[0]); ?>" alt="<?php the_title_attribute(); ?>">
            <?php else : ?>
              <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/default.png'); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
          </a>

          <div class="workItemText">
            <?php if (trim(get_field('agency_custom_line'))) : ?>
              <span class="agencyCustomLine"><?php the_field('agency_custom_line'); ?></span><br />
            <?php else :
              $author = get_field('agency');
              if ($author) : ?>
                <a class="workAgensyName" href="<?php echo esc_url($author->guid); ?>">
                  <?php echo esc_html($author->post_title); ?>
                </a><br />
              <?php endif;
            endif; ?>

            <strong>Client:</strong> <?php the_field('client'); ?><br />
            <strong>Category:</strong>
            <?php echo strip_tags(get_the_term_list(get_the_ID(), 'work-category', '', ', ')); ?><br />
          </div>
        </div>
      <?php endwhile; ?>
  </div>

  <div class="contentZone1234">
    <?php
    echo paginate_links([
      'total'   => $work_query->max_num_pages,
      'current' => $paged,
    ]);
    ?>
  </div>

  <?php endif; wp_reset_postdata(); ?>

  <div class="contentZone1234">
    <a href="<?php echo esc_url(home_url('/showcase/spotlight-work/')); ?>" class="button">
      Submit work to be featured
    </a>
  </div>
</div>

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


    });
</script>

<?php get_footer(); ?>