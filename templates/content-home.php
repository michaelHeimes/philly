<div class="homeslide">
	<div class="slideshow">
		<? if ( have_rows('slideshow') ): ?>
		    <? while ( have_rows('slideshow') ) : the_row(); ?>
		        <? $img = get_sub_field('image');?>
				<div class="<?=(get_sub_field('is_sponsor_slide'))?'sponsor':''?>" data-title="<?= htmlspecialchars(get_sub_field('title'))?>" data-description="<?= htmlspecialchars(get_sub_field('description'))?>">
					
					<? if(get_sub_field('link_type') == 'internal') {?>
						<a href="<? the_sub_field('link')?>"><img src="<?=$img['sizes']['slide']?>" alt=""></a>
					<? } elseif(get_sub_field('link_type') == 'external') { ?>
						<a href="<? the_sub_field('url')?>" target="_blank"><img src="<?=$img['sizes']['slide']?>" alt=""></a>
					<? } else { ?>
						<img src="<?=$img['sizes']['slide']?>" alt="">
					<? } ?>
					
				</div>
		    <? endwhile;?>
		<? endif;?>
	</div>
	<? if ( have_rows('slideshow') ): ?>
		<div class="text">
			<h2></h2><p></p>
		</div>
	<? endif;?>
</div>




<div class="page_content">
	<div class="about">
		<div class="row">
			<div class="program_content small-12 columns pac-lines pac-lines-1">
				<h1 data-orig="<? the_field('about_title')?>"><? the_field('about_title')?></h1>
				<p data-orig="<?= strip_tags(get_field('about'))?>"><?= strip_tags(get_field('about'))?></p>
			</div>
		</div>
		<div class="row">
			<div class="small-12 columns">

				<? $programs = get_terms('program', array('hide_empty'=> false))?>
				<ul class="programs_list medium-block-grid-5 small-block-grid-2">
					<? if($programs){?>
						<? foreach($programs as $program){ ?>
							<li data-color="<? the_field('color','program_'.$program->term_id); ?>" 
								data-title="<?= $program->name?>" 
								data-desc="<?= $program->description?>">
								<a href="<? the_field('link','program_'.$program->term_id); ?>" title="<?= $program->name?>">
									<span></span>
									<? $img = get_field('logo','program_'.$program->term_id);?>
									<img src="<?=$img['url']?>" alt="<?= $program->name?>">
								</a>
							</li>
						<? } ?>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="medium-8 columns">
			<div class="job_board pac-lines pac-lines-2">
				<span class="pac-lines-helper"></span>
				<h3 class="section-title">Job Board</h3>
				<ul class="small-block-grid-2">
					<?
					$args = array(
					'posts_per_page' => 10,
					'post_type' => 'job',
					'post_status' => 'publish',
					'meta_query' => array(
						'relation' => 'AND',
						array(	// past their embargo date
							'key' => 'embargo_date',
							'compare' => '<',
							'type' => 'DATE',
							'value' => date('Y-m-d'),
						),
					),
					'order'			=> 'DESC'
					);

					$loop = new WP_Query( $args );
					?>
					<? if($loop->have_posts()){?>
						<?php while ( $loop->have_posts() ) : $loop->the_post();?>
							<li>
								<a href="<? the_permalink()?>" class="job">
									<? the_title() ?>
									<? $employer = get_field('employer'); ?>
									<span><?= $employer[0]->post_title;?></span>
								</a>
							</li>
						<? endwhile; ?>
					<? } ?>
					<? wp_reset_query(); ?>
				</ul>
				<a href="<?=site_url('job')?>" class="button tiny">See All +</a>
			</div>


				<?
				$args = array(
				    'post_type' => 'event',
					'post_status' => 'publish',
					'posts_per_page' => 5,
					'meta_query' => array(
						'relation' => 'AND',
						array( // future events
							'key' => 'date',
							'compare' => '>=',
							'type' => 'DATE',
							'value' => date('Y-m-d'),
						),
						array(	// past their embargo date
							'key' => 'embargo_date',
							'compare' => '<',
							'type' => 'DATE',
							'value' => date('Y-m-d'),
						)
					),
					'meta_key' => 'date',
					'orderby' => 'meta_value',
					'order' => 'ASC'
				);
				$loop = new WP_Query( $args );
				?>
				<? if($loop->have_posts()){?>
					<div class="upcoming_events pac-lines pac-lines-2">
						<span class="pac-lines-helper"></span>
						<h3 class="section-title">Upcoming Events</h3>

						<div class="events">
							<?php while ( $loop->have_posts() ) : $loop->the_post();?>
								<div class="row">
									<? 
										$program = get_field('related_program');
										$program_color = (get_field('color', 'program_'.$program->term_id))?get_field('color', 'program_'.$program->term_id):'';
									?>
									<a href="<? the_permalink()?>" class="event <?=$program->name?>" style="background:<?=$program_color?>;">
										<div class="date"><? the_field('date')?></div>
										<? the_title();?>
										<div class="meta">
											<span class="loc"><?=(get_field('location'))?get_field('location'):''?></span>
											<span class="program"><?=($program->name)?' - '.$program->name:'';?></span>
										</div>
									</a>
								</div>
							<? endwhile; ?>
						</div>

						<a href="<?=site_url('events')?>" class="button tiny">See All +</a>
					</div>
				<? } ?>
				<? wp_reset_query(); ?>







		</div>
		<div class="medium-4 columns">
			<? $posts = get_field('ads', 11107); // home?>
			<? if( $posts ): ?>
				<div class="sda">
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


			<div class="news pac-lines pac-lines-4">
				<span class="pac-lines-helper"></span>
				<h3 class="section-title">Current News</h3>
				<div class="articles">
					
					<?
					$args = array(
					'posts_per_page' => 5,
					'post_type' => 'post',
					'order' => 'DESC',
					'post_status' => 'publish',
					);

					$loop = new WP_Query( $args );
					?>
					<? if($loop->have_posts()){?>
						<?php while ( $loop->have_posts() ) : $loop->the_post();?>
							<div class="story row"> 
								<? 
									$cat = get_the_category();
									$cat_img = (get_field('icon', 'category_'.$cat[0]->term_id))?get_field('icon', 'category_'.$cat[0]->term_id):'';
								?>
								<div class="small-3 columns">
									<img src="<?= $cat_img['url']?>" alt="">
								</div>
								<div class="small-9 columns">
									<p>
										<a href="<?= the_permalink()?>">
											<? the_title()?>
										</a>
									</p>
								</div>
							</div>
						<? endwhile; ?>
					<? } ?>
					<? wp_reset_query(); ?>
					<div class="row">
						<div class="small-12 columns text-left">
							<a href="<?=site_url('news')?>" class="button tiny">See All +</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




<? if ( have_rows('featured_videos') ): ?>
	<div class="row">
		<div class="small-12 columns">
			<div class="featured_vids pac-lines pac-lines-6">
				<span class="pac-lines-helper"></span>

				<? if(get_field('featured_videos_title')){ ?>
					<h3><? the_field('featured_videos_title')?></h3>
				<? } ?>
				<? if(get_field('featured_videos_desctiption')){ ?>
					<p><? the_field('featured_videos_desctiption')?></p>
				<? } ?>

				<ul class="medium-block-grid-3 large-block-grid-4">
				    <? while ( have_rows('featured_videos') ) : the_row(); ?>
						<li>
							<div class="vid_wrap">
								<? $img = get_sub_field('video_link');?>
								<a href="#" data-reveal-id="videoModal" data-video-id="<?=youtube_id_from_url($img)?>">
									<img src="http://img.youtube.com/vi/<?=youtube_id_from_url($img)?>/mqdefault.jpg" alt="">
								</a>
								<h5><? the_sub_field('title')?></h5>
								<p><? the_sub_field('subtitle')?></p>
							</div>
						</li>
				    <? endwhile;?>
				</ul>
			</div>
		</div>
	</div>
<? endif;?>



	<div class="featured_work">
		<div class="row">
			<div class="small-12 columns">
				<div class="pac-lines pac-lines-3">
					<div class="row">
						<div class="small-12 columns">
							<h3 class="section-title pull-left">
								Featured Work
							</h3>
							<a href="<?=site_url('work')?>" class="button tiny pull-right">See All+</a>
						</div>
						<div class="small-12 columns">
							<p><? the_field('featured_work_intro')?></p>
						</div>
					</div>
					

					<?
					$args = array(
					'posts_per_page' => 6,
					'post_type' => 'work',
					'orderby' => 'title',
					'order' => 'ASC',
					'post_status' => 'publish',
					);

					$loop = new WP_Query( $args );
					$has_ad = false;
					?>
					<? if($loop->have_posts()){?>
							<?php $i=0; while ( $loop->have_posts() ) : $loop->the_post(); $i++;?>
								<?=($i==1)?'<div class="row" data-equalizer>':'';?>
								<?=($i==4 && !$has_ad || $i==3 && $has_ad)?'</div><div class="row">':'';?>

								<? $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'work'); ?>
								<div class="work medium-4 columns">
									<a href="<? the_permalink()?>" class="img" <?=($i<4)?'data-equalizer-watch':''?>>
										<? if($img) { ?>
											<img src="<?=$img[0]?>" alt="<? the_title()?>">
										<? } else { ?>
											<img src="<?=get_stylesheet_directory_uri()?>/assets/img/default.png" alt="<? the_title()?>">
										<? } ?>
									</a>
									
									<div class="title">
										<? the_title()?>
									</div>
									<div class="award">
										<?= strip_tags(get_the_term_list( get_the_ID(), 'award' ))?>
									</div>
									<div class="author">
										<? $author = get_field('agency')?>
										<? if($author){ ?>
											By <a href="<?=$author->guid?>"><?=$author->post_title?></a>
										<? } ?>
									</div>
								</div>
								

								<? if($i==2){ ?>
									<? $posts = get_field('ads', 11283); // fetured work ad?>
									<? if( $posts ): ?>
									    <? foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
											<div class="work medium-4 columns">
										        <?php setup_postdata($post); ?>
												<div class="sda text-center">
													<? $ad = get_field('artwork')?>
													<a href="<? the_field('link')?>" target="_blank">
														<img src="<?= $ad['url']?>" alt="<? the_title()?>">
													</a>
													<h3 class="no-border">Advertisement</h3>
												</div>
											</div>
										<? $has_ad = true; break; endforeach; ?>
								    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
									<?php endif; ?>
								<? } ?>

								<? if($i==5 && $has_ad){ break; } ?>

							<? endwhile; ?>
							</div>
						</div>
					<? } ?>
					<? wp_reset_query(); ?>

					<div class="row">
						<div class="small-12 columns">
							<p>Want your work featured?
								<a href="<?=site_url('submit-work')?>" class="nowrap">Submit Your Work</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<div id="videoModal" class="reveal-modal" data-reveal>
  <div class="embed-video"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>