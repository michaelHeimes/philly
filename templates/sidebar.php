<? // subnavs ================================================== ?>
<? if (is_page('about')) { ?>
	<div class="pac-lines pac-lines-1">
		<div class="subnav">
			<h3 class="section-title"><? the_title()?></h3>
			<ul>
				<li><a href="#introduction">Introduction</a></li>
				<? if(have_rows('administration')){ ?><li><a href="#administration">Administration</a></li><? } ?>
				<? if(get_field('site_disclaimer')) {?><li><a href="#site_disclaimer">Site Disclaimer</a></li><? } ?>
			</ul>
		</div>
	</div>
<? } ?> 


<? if (is_post_type_archive('event') || is_page('suggest-event')) { ?>
	<div class="pac-lines pac-lines-1">
		<div class="subnav">
			<h3 class="section-title">Events</h3>
			<ul>
				<li><a href="<?=site_url('events')?>">Upcoming Events</a></li>
				<li><a href="<?=site_url('events?past=true')?>">Past Events</a></li>
				<li><a href="<?=site_url('suggest-event')?>">Suggest An Event</a></li>
			</ul>
		</div>
	</div>
<? } ?> 










<? // little logos ================================================== ?>
<? if(is_post_type_archive('agency') || is_singular('agency')){ ?>
	<? $ad_args = array(
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
	<? wp_reset_query(); ?>
<? } ?>


<? if(is_home() || is_singular('post') || is_post_type_archive('post') || is_category()){ ?>
	
	<? $categories = get_terms( 'category', array('hide_empty' => false)); ?>
	<? if($categories) { ?>
		<div class="cats pac-lines pac-lines-1">
			<div class="subnav">
				<h3 class="section-title">Categories</h3>
				<ul>
					<? foreach ($categories as $cat) { ?>
						<? $cat_img = (get_field('icon', 'category_'.$cat->term_id))?get_field('icon', 'category_'.$cat->term_id):''; ?>

						<li><a href="<?=site_url('category/'.$cat->slug)?>"><img src="<?=$cat_img['url']?>" alt="<?= $cat->name?>" class="icon"> <?= $cat->name?></a></li>
					<? } ?>
				</ul>
			</div>
		</div>
	<? } ?>

<? } ?>

	
	<?
	if(is_post_type_archive('job') || is_singular('job')){ 
		$posts = get_field('ads', 11109); // job
	} else {
		$posts = get_field('ads', 11110); // pages
	}
	?>
	<? if( $posts ): ?>
		<div class="sda reverse">
			<h3>Advertisements</h3>
		    <? foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
		        <?php setup_postdata($post); ?>
				<div class="da">
					<? $ad = get_field('artwork')?>
					<a href="<? the_field('link')?>" target="_blank">
						<img src="<?= $ad['url']?>" alt="<? the_title()?>">
					</a>
				</div>
		    <?php endforeach; ?>
		</div>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>
