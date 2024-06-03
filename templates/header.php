<header class="header">
	<div class="row_wrap">
		<div class="row">
			<div class="medium-2 small-3 columns">
				<div class="logo">
					<a href="<?php echo esc_url(home_url()); ?>">
						<? if(is_page('2-0')) { ?>
							<img src="<?= get_stylesheet_directory_uri()?>/assets/img/2.0.png" alt="<?php bloginfo('name'); ?>">
						<? } else { ?>
							<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2020/04/PhillyAdClub_LogoUpdate_KO-300x297.png" alt="<?php bloginfo('name'); ?>">
						<? } ?>
					</a>
				</div> 
			</div>
			<div class="medium-3 hide-for-small columns">
				<? if ( have_rows('social', 'options') ): ?>
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
			<div class="medium-7 hide-for-small columns">
				<div class="c2a_button">
					<a href="<?= site_url('volunteer')?>" class="button tiny">Volunteer</a>
				</div>
				<div class="c2a_button">
					<a href="http://pac.memberclicks.net/membership" class="button tiny">Join</a>
				</div>
				<div class="c2a_button">
					<a href="https://pac.memberclicks.net/login" class="button tiny">Login</a>
				</div>
				<div class="c2a_button search">
					<form role="search" method="get" class="search" action="<?php echo esc_url(home_url('/')); ?>">
					  <div class="row">
					    <div class="small-12 columns">
					      <div class="row collapse">
					        <div class="small-10 columns">
					          <input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>">
					        </div>
					        <div class="small-2 columns">
					          <button type="submit" class="button expand postfix"><i class="fa fa-search"></i></button>
					        </div>
					      </div>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="medium-10 medium-offset-2 columns">
			<div class="mobile_btn">
				<a href="#">
					<i class="fa fa-bars"></i>
				</a>
			</div>
			<nav>
				<?php if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'pull-right'));
				endif; ?>
			</nav>
		</div>
	</div>
</header>
