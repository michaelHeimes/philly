<?php while (have_posts()) : the_post(); ?>
  <? 
  $cat = get_the_category();
  $cat_img = (get_field('icon', 'category_'.$cat[0]->term_id))?get_field('icon', 'category_'.$cat[0]->term_id):'';
  ?>

  <? if($cat_img) { ?>
    <div class="row">
      <div class="small-2 columns">
        <img src="<?= $cat_img['url']?>" alt="" style="margin-top: 0.5rem;">
      </div>
      <div class="small-10 columns">
        <article <?php post_class(); ?>>
          <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php get_template_part('templates/entry-meta'); ?>
          </header>
          <div class="entry-content">
            <? the_post_thumbnail(null, 'large', array('class'=>'post_thumb'));?>
            <?php the_content(); ?>
          </div>
          <footer>
            <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
          </footer>
        </article>
      </div>
    </div>
    <?php comments_template('/templates/comments.php'); ?>
    
  <? } else { ?>
    <article <?php post_class(); ?>>
      <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="entry-content">
        <? the_post_thumbnail(null, array('class'=>'post_thumb'));?>
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
    </article>
    <?php comments_template('/templates/comments.php'); ?>

  <? } ?>
<?php endwhile; ?>
