<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('pac-lines pac-lines-4'); ?>>
    <header>
      <h1><?php the_title(); ?></h1>
    	<time><?php echo the_field('date'); ?></time>
    </header>
    <? the_content(); ?>
  </article>
<? endwhile; ?>