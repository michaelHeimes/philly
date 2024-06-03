<div class="row">
	<div class="small-12 columns">
		<? if(get_field('intro')){ ?>
			<div class="pac-lines pac-lines-4">
				<?php the_field('intro'); ?>
			</div>
		<? } ?>

		<? if(get_field('benefits')){ ?>
			<div class="pac-lines pac-lines-4">
				<h1 class="section-title">Member Benefits &amp; Discounts</h1>
				<?php the_field('benefits'); ?>
			</div>
		<? } ?>

		<? if(get_field('membership_categories')){ ?>
			<div class="pac-lines pac-lines-4">
				<h1 class="section-title">Membership Categories</h1>
				<?php the_field('membership_categories'); ?>
			</div>
		<? } ?>


		<? if(get_field('how_to_apply')){ ?>
			<div class="pac-lines pac-lines-4">
				<h1 class="section-title">How To Apply</h1>
				<?php the_field('how_to_apply'); ?>
			</div>
		<? } ?>
		

	</div>
</div>

