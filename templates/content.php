<? 
$cat = get_the_category();
$cat_img = (get_field('icon', 'category_'.$cat[0]->term_id))?get_field('icon', 'category_'.$cat[0]->term_id):'';
?>

<? if($cat_img) { ?>
	<div class="row">
		<div class="small-2 columns">
			<img src="<?= $cat_img['url']?>" alt="" style="margin-top: 0.5rem;">
		</div>
		<div class="small-10 columns">
			<article <?php post_class(); ?>>
				<header>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php get_template_part('templates/entry-meta'); ?>
				</header>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</article>
		</div>
	</div>
	
<? } else { ?>
	<article <?php post_class(); ?>>
		<header>
			<? if('event' == get_post_type() || 'job' == get_post_type() || 'work' == get_post_type() || 'agency' == get_post_type()){?>
				<div style="text-transform:uppercase; color: #999;"><?=get_post_type()?></div>
			<? } ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<? if('agency' == get_post_type()){?>
				<p><a href="<? the_permalink()?>">View Agency</a></p>
			<? } ?>
		</div>
	</article>
<? } ?>
