<?
global $wp_query;
$new_args = array(
    'post_type' => 'event',
	'post_status' => 'publish',
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'embargo_date',
			'compare' => '<',
			'type' => 'DATE',
			'value' => date('Y-m-d'),
		),
	),
	'meta_key' => 'date',
	'orderby' => 'meta_value',
	'order' => 'ASC'
);

if(isset($_GET['past']) && $_GET['past'] == true) {
	$new_args['meta_query'][] = array(
		'key' => 'date',
		'compare' => '<',
		'type' => 'DATE',
		'value' => date('Y-m-d'),
	);
	$new_args['order'] = 'DESC';
} else {
	$new_args['meta_query'][] = array(
		'key' => 'date',
		'compare' => '>=',
		'type' => 'DATE',
		'value' => date('Y-m-d'),
	);
}

$args = array_merge( $wp_query->query_vars, $new_args );
query_posts($args); 
?>

<h1 class="section-title"><?=(isset($_GET['past']) && $_GET['past'] == true) ? 'Past':'Upcoming'?> Events</h1>

<?php if (!have_posts()) : ?>
  <p><?php _e('Sorry, no events were found.', 'roots'); ?> </p>
  <?php get_search_form(); ?>
<?php endif; ?>
<div class="events">
<?php while (have_posts()) : the_post(); ?>
    <div class="row">
  <?php get_template_part('templates/content', 'events'); ?>
  </div>
<?php endwhile; ?>
<div class="events">



<?php if ($wp_query->max_num_pages > 1) : ?>
  <?php echo roots_numbered_pagination(); ?>
<?php endif; ?>