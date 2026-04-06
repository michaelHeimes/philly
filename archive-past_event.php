<?php
$past_event_page = get_post(23373);
$content = apply_filters('the_content', $past_event_page->post_content); 
get_header();
?>
<div class="content noimage">
	<div class="agFlexBox">
		<?php if ( $content ) : ?>
			<div class="contentZone0123boxed permanentGray zoneForForm mb-0 pb-30">
				<?=wp_kses_post($content);?>
			</div>
		<?php endif;?>
	</div>
	<div class="contentZone1234 pastEventsWrap">
		
		<div class="pastEventList pt-40">

			<?php
			$args = array(  
				'post_type' => 'past_event',
				'post_status' => 'publish',
				'posts_per_page' => 12,
				'meta_key'  => 'event_date',
				'orderby'   => 'meta_value_num',
				'order'     => 'DESC',
			);
			
			$loop = new WP_Query( $args ); 
			
			if ( $loop->have_posts() ) : 
				
				while ( $loop->have_posts() ) : $loop->the_post();
					$date_string = get_field( 'event_date' ) ?? null;
					$date = DateTime::createFromFormat( 'Ymd', $date_string );	
					$event_location = get_field('event_location') ?? null;
					$archive_excerpt = get_field('archive_excerpt') ?? null;
					$gallery_preview = get_field('gallery_preview') ?? null;
				?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('pb-40 mb-40'); ?>>
						<header class="entry-header">
							<h2><?php the_title();?></h2>
							<?php if( $date_string || $event_location ):?>
								<div class="event-meta">
									<div class="permanentGray">
										<?php if($date_string):?>
											<div class="event-date">
												<b><?=$date->format( 'F j, Y' );?></b>
											</div>
										<?php endif;?>
										<?php if($event_location):?>
											<div class="event-location">
												/ 
												<b><?=wp_kses_post( $event_location );?></b>
											</div>
										<?php endif;?>
									</div>
								</div>
							<?php endif;?>
						</header>
						<?php if ( $archive_excerpt || $gallery_preview  ) : ?>
							<div class="entry-content">
								<?php if ( get_the_content() ):?>
									<div class="content-wrap">
										<?=wp_kses_post( $archive_excerpt );?>
									</div>
								<?php endif;?>
								<?php if( $gallery_preview ): ?>
									<div class="gallery-preview">
										<?php foreach($gallery_preview as $image):?>
											<div class="g-image">
												<?=wp_get_attachment_image( $image['id'], 'large' ); ?>
											</div>
										<?php endforeach;?>
									</div>
								<?php endif;?>
							</div>
						<?php endif;?>
						<div class="buttonZone12" style="margin:0 auto !important; float: none !important;">
							<a href="<?=esc_url( get_the_permalink() );?>" class="button" title="<?=wp_kses_post( get_the_title() ); ?>" rel="bookmark">View Full Recap <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
						</div>
					</article>
					
				<?php
				endwhile;?>
				<?php if ($wp_query->max_num_pages > 1) : ?>
				<?php echo roots_numbered_pagination(); ?>
				<?php endif; ?>
			<?php	
			endif;
			wp_reset_postdata(); 
			?>

		</div>
	</div>
</div>

<?php get_footer();