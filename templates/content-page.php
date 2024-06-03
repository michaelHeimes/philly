<div class="row">
	<div class="small-12 columns">
		<div class="pac-lines pac-lines-4">
			<h1 class="section-title"><? the_title()?></h1>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
		</div>
	</div>
</div>

