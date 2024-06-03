<div class="row">
	<div class="small-12 columns">
		<a name="introduction"></a>
		<div class="introduction pac-lines pac-lines-4">
			<h3 class="section-title">Introduction</h3>
			<?php the_content(); ?>
		</div>

		<? if ( have_rows('administration') ): ?>
		<a name="administration"></a>
			<div class="row">
				<div class="large-9 medium-10 columns">
					<div class="administration pac-lines pac-lines-5">
						<h3 class="section-title">Administration</h3>
					    <? while ( have_rows('administration') ) : the_row(); ?>
					    	<div class="administrator">
					    		<strong><? the_sub_field('title')?></strong>
						        <? if(get_sub_field('link')) { ?>
							        <a href="<? the_sub_field('link')?>"><? the_sub_field('name')?></a>
						        <? } else { ?>
							        <? the_sub_field('name')?>
						        <? } ?>
					    	</div>
					    <? endwhile;?>
					</div>
				</div>
			</div>
		<? endif;?>

		<? if(get_field('image')) {?>
			<div class="divider-img">
				<? $img = get_field('image')?>
				<img src="<?= $img['sizes']['large']?>" alt="<? the_title()?>">
			</div>
		<? } ?>


		<? if(get_field('site_disclaimer')) {?>
			<a name="site_disclaimer"></a>
			<div class="site_disclaimer pac-lines pac-lines-6">
				<div class="pac-lines-helper"></div>
				<h3 class="section-title">Site Disclaimer</h3>
				<?php the_field('site_disclaimer'); ?>
			</div>
		<? } ?>

	</div>
</div>
