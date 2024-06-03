<div class="row">
	<div class="small-12 columns">
		<div class="pac-lines pac-lines-4">
			<h1 class="section-title"><? the_title()?></h1>
			<?php the_content(); ?>
		</div>

		<? if(get_field('more_info')){ ?>
				<?php the_field('more_info'); ?>
		<? } ?>
		
		<? if(get_field('about_the_program')){ ?>
			<div class="pac-lines pac-lines-5">
				<?php the_field('about_the_program'); ?>
			</div>
		<? } ?>

	</div>
</div>

