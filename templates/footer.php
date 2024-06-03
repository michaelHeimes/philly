<div class="page_content">
	<div class="footer_sda">
		<div class="sda row">
				<h3>Advertisements</h3>
				<? $posts = get_field('ads', 11108); // footer?>
				<? if( $posts ): ?>
				    <? foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				        <?php setup_postdata($post); ?>
						<div class="medium-4 columns">
							<div class="da">
								<? $ad = get_field('artwork')?>
								<a href="<? the_field('link')?>" target="_blank">
									<img src="<?= $ad['url']?>" alt="<? the_title()?>">
								</a>
							</div>
						</div>
				    <?php endforeach; ?>
			    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="row_wrap">
		
		<div class="navs row">
			<div class="large-10 medium-9 columns">
				<div class="row">
					<div class="medium-3 columns">
						<?php if (has_nav_menu('about_nav')) {?>
							<h6><?=get_menu_title('about_nav')?></h6>
							<? wp_nav_menu(array('theme_location' => 'about_nav'));?> 
						<? } ?>
					</div>
					<div class="medium-3 columns">
						<?php if (has_nav_menu('join_nav')) { ?>
							<h6><?=get_menu_title('join_nav')?></h6>
							<? wp_nav_menu(array('theme_location' => 'join_nav')); ?>
						<? } ?>
					</div>
					<div class="medium-3 columns">
						<?php if (has_nav_menu('involved_nav')) { ?>
							<h6><?=get_menu_title('involved_nav')?></h6>
							<? wp_nav_menu(array('theme_location' => 'involved_nav')); ?>
						<? } ?>
					</div>
					<div class="medium-3 columns">
						<? if ( have_rows('social', 'options') ): ?>
							<h6>Follow Us</h6>
							<ul class="social">
						    <? while ( have_rows('social', 'options') ) : the_row(); ?>
						        <li>
						        	<a href="<? the_sub_field('url')?>" target="_blank">
						        		<i class="fa fa-<? the_sub_field('network')?>"></i>
						        	</a>
						        </li>
						    <? endwhile;?>
						    </ul>
						<? endif;?>
					</div>
				</div>
			</div>
			<div class="medium-2 columns">
				<div class="footer_logo">
					<a href="<?=site_url('/')?>">
						<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2020/04/PhillyAdClub_LogoUpdate_KO-300x297.png" alt="Philly Ad Club">
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row_wrap">
		<div class="row">
			<div class="small-12 columns">
				<p class="pull-left">MAIL: PHILLY AD CLUB, P.O. BOX 1155, C/O SEAMLESS EVENTS, HAVERTOWN, PA 19083 TEL: <a href="tel://215-477-1993">215-477-1993</a></p>
				<p class="pull-right"><a href="<?=site_url('privacy')?>">Privacy</a> | <a href="<?=site_url('terms')?>">Terms</a></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<p class="pull-left">&copy; <?= date('Y')?> PHILLY AD CLUB. ALL RIGHTS RESERVED.</p>
			<p class="pull-right">Proudly made by <a href="http://impartcreative.com" class="impart" target="_blank">Impart Creative</a></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
