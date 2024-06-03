<div class="row">
	<div class="small-12 columns">
		<img src="<?=get_stylesheet_directory_uri()?>/assets/img/2.0-gang.jpg" alt="2.0" class="gang">


		<div class="pac-lines pac-lines-4">
			<h1 class="section-title"><? the_title()?></h1>
			<?php the_content(); ?>
		</div>

		<div class="pac-lines">
			<h2 class="section-title">2.0 Leadership Team</h2>
			<? if ( have_rows('members') ): ?>
				<div class="members">
				    <? while ( have_rows('members') ) : the_row(); ?>
				        <div class="member row">
				        	<div class="medium-4 columns">
				        		<? 
				        		$img = get_stylesheet_directory_uri().'/assets/img/default_square.png';
				        		if(get_sub_field('photo')) { 
					        		$img_array = get_sub_field('photo');
					        		$img = $img_array['url'];
				        		} 
				        		?>
				        		<img src="<?=$img?>">
				        	</div>
				        	<div class="medium-8 columns">
						        <div class="name"><? the_sub_field('name')?></div>
						        <div class="co"><? the_sub_field('company')?></div>
						        <div class="title"><? the_sub_field('title')?></div>
						        <div class="bio">
						        	<? the_sub_field('bio')?>
						        </div>
						        <? if ( have_rows('links') ): ?>
						        	<ul class="links">
									    <? while ( have_rows('links') ) : the_row(); ?>
									        <li><a href="<?the_sub_field('url')?>"><? the_sub_field('type')?></a></li>
									    <? endwhile;?>
								    </ul>
								<? endif;?>
				        	</div>

				        </div>
				    <? endwhile;?>
			    </div>
			<? endif;?>
		</div>

	</div>
</div>

