<?php
get_header();
?>
<?php while (have_posts()) : the_post(); 
    $date_string = get_field( 'event_date' ) ?? null;
    $date = DateTime::createFromFormat( 'Ymd', $date_string );	
    $event_location = get_field('event_location') ?? null;
    $archive_excerpt = get_field('archive_excerpt') ?? null;
    $sponsor_logos = get_field('sponsor_logos') ?? null;
    $gallery = get_field('gallery') ?? null;
?>
<div class="content noimage">
    
    <?php
    $args = array(
        'numberposts'     => 1000,
        'post_type' => 'past_event',
        'orderby'         => 'menu_order',
        'order'           => 'ASC'
    );
    $pitems = get_posts( $args );
    $next_id = 0;
    $prev_id = 0;
    $current_id = 0;
    foreach( $pitems as $pitem ) {
        if($current_id){
            $next_id = $pitem->ID;
            break;
        }
        if($pitem->ID == $post->ID){
            $current_id = $pitem->ID;
        } else {
            $prev_id = $pitem->ID;
        }
    }
    
    ?>

    <div class="portfolioNav">
        <?php if($prev_id){?><a href="<?= get_permalink($prev_id);?>"><svg class="xrarr xrarr180" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg> Previous Past Event</a><?php } ?>
        <?php if($prev_id && $next_id){?> &nbsp;|&nbsp; <?php } ?>
        <?php if($next_id){?><a href="<?= get_permalink($next_id);?>">Next Past Event <svg class="xrarr" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a><?php } ?>
    </div>


    <div class="contentZone0123boxed mb-30">
       <h1><?php the_title();?></h1>
       <?php if($date_string):?>
           <h3 class="event-date">
               <?=$date->format( 'F j, Y' );?>
           </h3>
       <?php endif;?>
       <?php if($event_location):?>
           <h3 class="event-location">
               <?=wp_kses_post( $event_location );?>
           </h3>
       <?php endif;?>
    </div>
    <div class="contentZone1234 mb-50">
        <div class="content2columnZone">
            <div class="content-wrap">
                <?php the_content(); ?>
            </div>
            <?php if($sponsor_logos):?>
                <div class="contentHalfRightMediaBoxedWrap">
                    <h2>Event Sponsors</h2>
                    <div class="contentHalfRightMediaBoxed">
                        <div class="logo-grid">
                            <?php foreach($sponsor_logos as $sponsor_logo):?>
                                <div class="logo">
                                    <?=wp_get_attachment_image( $sponsor_logo['id'], 'medium' );?>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    
    <?php if($gallery):?>
        <div class="gallery-wrap">
            <?=do_shortcode( $gallery );?>
        </div>
    <?php endif;?>
   
</div>
<?php endwhile; ?>
<?php get_footer();
