<?php
/**
 * Template Name: Front Page
 *
 */

get_header("frontpage");
?>
    <div class="visualBlocks">

        <?php /* ?>
        <?php if ( have_rows('events') ): ?>
            <?php while ( have_rows('events') ) {

             the_row();
             $url = get_sub_field('url');
             ?>
                <a href="<?= $url['url'] ?>" target="<?= $url['target'] ?>" class="visualBlock">
                <div class="visualCathegory"><? the_sub_field('category')?></div>
                <div class="visualTitle"><? the_sub_field('title')?></div>
                <div class="visualDate"><? the_sub_field('date')?></div>
                <div class="visualLink"><span>more event info</span></div>
            </a>
            <?php } ?>
        <?php endif;?>
        <?php */ ?>
        <?php  ?>

        <?php
        //    grp="..." - comma separated list of event categories to pull from (default all)
        //    cnt="3" - number of upcoming events to display (default 3)
        //    lgo="1" - display event thumbnail
        //    szp="1" - do not display event start date/time
        //    ezp="1" - do not display event end date/time
        //    adn="1" - display event location

        ob_start();
        echo apply_filters( 'the_content',' [mw eventwidget cnt="4" lgo="0" adn="0" ezp="1" grp="1"] ');
        $eventHTML = ob_get_contents();
        ob_end_clean();
        ?>
        <style>
            ul.sf_widget_event_list{display:none!important;}
        </style>
        <?php
        $links = array();
        preg_match_all('/href="(.+)"/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $links[$i] = $val[1];
            $i++;
        }
        $titles = array();
        preg_match_all('/<a(.+)">(.+)<\/a>/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $titles[$i] = $val[2];
            $i++;
        }
        $dates = array();
        preg_match_all('/<span(.+)">(.+)<\/span>/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $d = date_parse($val[2]);
            $dates[$i] = $d['month'].".".$d['day'].".".substr($d['year'],2,2);
            $i++;
        }
        ?>

        <?php for($i = 1; $i<=2; $i++){
            if (!isset($titles[$i])) break;
            $title_ar = explode('|', $titles[$i]);
            ?>
            <a href="<?php echo $links[$i]; ?>" class="visualBlock">
                <div class="visualCathegory"><?php echo @trim($title_ar[1]) ? trim($title_ar[1]) : 'CLUB EVENT'; ?></div>
                <div class="visualTitle"><?php echo $title_ar[0]; ?></div>
                <div class="visualDate"><?php echo $dates[$i]; ?></div>
                <div class="visualLink"><span>register</span></div>
            </a>
        <?php } ?>

        <!-- ########################### -->

        <?php
        //    grp="..." - comma separated list of event categories to pull from (default all)
        //    cnt="3" - number of upcoming events to display (default 3)
        //    lgo="1" - display event thumbnail
        //    szp="1" - do not display event start date/time
        //    ezp="1" - do not display event end date/time
        //    adn="1" - display event location

        ob_start();
        echo apply_filters( 'the_content',' [mw eventwidget cnt="4" lgo="0" adn="0" ezp="1" grp="0"] ');
        $eventHTML = ob_get_contents();
        ob_end_clean();
        ?>
        <style>
            ul.sf_widget_event_list{display:none!important;}
        </style>
        <?php
        $links = array();
        preg_match_all('/href="(.+)"/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $links[$i] = $val[1];
            $i++;
        }
        $titles = array();
        preg_match_all('/<a(.+)">(.+)<\/a>/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $titles[$i] = $val[2];
            $i++;
        }
        $dates = array();
        preg_match_all('/<span(.+)">(.+)<\/span>/', $eventHTML, $out1, PREG_SET_ORDER); // save all links \x22 = "
        $i = 1;
        foreach($out1 as $val){
            $d = date_parse($val[2]);
            $dates[$i] = $d['month'].".".$d['day'].".".substr($d['year'],2,2);
            $i++;
        }
        ?>

        <?php for($i = 1; $i<=2; $i++){
            if (!isset($titles[$i])) break;
            $title_ar = explode('|', $titles[$i]);
            ?>
            <a href="<?php echo $links[$i]; ?>" class="visualBlock">
                <div class="visualCathegory"><?php echo @trim($title_ar[1]) ? trim($title_ar[1]) : 'FOUNDATION EVENT'; ?></div>
                <div class="visualTitle"><?php echo $title_ar[0]; ?></div>
                <div class="visualDate"><?php echo $dates[$i]; ?></div>
                <div class="visualLink"><span>register</span></div>
            </a>
        <?php } ?>

        <?php  ?>
    </div>

    <div class="visualBlocksButton">
        <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>event-calendar/#!calendar" >See all Events <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
    </div>

    <div class="blackNavWrapper">
        <div class="blackNavLeft">
            <div class="verticalBlock">Recent Jobs Posts</div>
        </div>
        <div class="blackNavBlock">
            <?php
            $args = array(
                'posts_per_page' => 8,
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
                'meta_key'   => 'embargo_date',
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
            );

            $loop = new WP_Query( $args );
            ?>
            <? if($loop->have_posts()){?>
                <?php while ( $loop->have_posts() ) : $loop->the_post();?>
                    <a href="<? the_permalink()?>" class="blackNavItem">
                        <?php $employer = get_field('employer'); ?>
                        <?= @$employer[0]->post_title;?><br />
                        <?php the_title() ?><br />
                        <?php the_field('embargo_date'); ?><br />
                        <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg>
                    </a>
                <? endwhile; ?>
            <? } ?>
            <? wp_reset_query(); ?>
        </div>
        <div class="blackNavRight"></div>
    </div>

    <div class="blackNavButton">
        <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>job" >See all JOBS <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
    </div>

    <div class="featuredTitle">
        <?php
        while ( have_posts() ) {
            the_post();
            the_content();
        }; // End of the loop.
		wp_reset_postdata();
        ?>
    </div>

    <div class="featuredContent">
    <div class="featuretextnew" style="text-align:center">
    <?php the_field("featured_text"); ?>
    </div>
				<?php  //exit();
				
					$args = array(
					'post_type' => 'work',
					'posts_per_page' => 8,
					 'orderby' => 'date', 
        				'order' => 'DESC', 
					);
					
					$query = new WP_Query( $args );
					
					if ( $query->have_posts() ) { 
					?><div class="contentZone1234 workList"><?php
					while ( $query->have_posts() ) {
					$query->the_post();
					
					
					
                    
				$client= get_field('client',$post->ID);
				$agency= get_field('agency',$post->ID);
				$agency_name= $agency->post_title;
				$agency_id= $agency->ID;
				//echo "test"; print_r($agency->post_title);
				 $imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); 
			?>
            
            
	<div class="workItem workItemB active" id="workItem_2">
                <a href="<?php echo get_the_permalink($post->ID); ?>" class="img" data-equalizer-watch=""><img src="<?php echo $imageurl;?>" alt=""></a>
				<div class="workItemText"> 
                                            <a class="workAgensyName" href="https://www.phillyadclub.com/?post_type=agency&amp;p=<?php echo $agency_id; ?>"><?php echo $agency_name; ?></a><br>
                                             <strong>Client: </strong> <?php echo $client; ?><br>
                    <strong>Category: </strong> 
                    <?php
					$postidd= $post->ID;
						//work-category
						$taxonomies = wp_get_object_terms($post->ID, 'work-category',  array("fields" => "names"));
						//$taxonomies = get_post_taxonomies( $postidd );
						//print_r($taxonomy_names); 
						$i=1;
						$count=count($taxonomies);
						foreach ( $taxonomies as $taxonomy ) {
							
								echo $taxonomy; // Output the name of the term
								
								if($i<$count)
								{
									echo ", ";
								}
								$i++;
							
						} 
					?>
                   <br>
                </div>
     </div>
   
            
          
			
                    <?php
					// Display your custom post type content here
					
						
					
					}
					} else {
					// No posts found
					}
					
					
					//exit;
				?>
              
              
              <!--New feature work section-->
           <?php /*?> <?php if(get_field('feature_work_section_home'))
			{?>
            
            <?php 
			$featureworkss= get_field('feature_work_section_home');
			//echo "<pre>";
			//print_r($featureworkss);
			foreach($featureworkss as $work)
			{
				$client= get_field('client',$work->ID);
				$agency= get_field('agency',$work->ID);
				$agency_name= $agency->post_title;
				$agency_id= $agency->ID;
				//echo "test"; print_r($agency->post_title);
				 $imageurl = wp_get_attachment_url( get_post_thumbnail_id($work->ID, 'thumbnail') ); 
			?>
            
            
	<div class="workItem workItemB active" id="workItem_2">
                <a href="<?php echo get_the_permalink($work->ID); ?>" class="img" data-equalizer-watch=""><img src="<?php echo $imageurl;?>" alt=""></a>
				<div class="workItemText">
                                            <a class="workAgensyName" href="https://www.phillyadclub.com/?post_type=agency&amp;p=<?php echo $agency_id; ?>"><?php echo $agency_name; ?></a><br>
                                             <strong>Client: </strong> <?php echo $client; ?><br>
                    <strong>Category: </strong> 
                    <?php
					$postidd= $work->ID;
						//work-category
						$taxonomies = wp_get_object_terms($work->ID, 'work-category',  array("fields" => "names"));
						//$taxonomies = get_post_taxonomies( $postidd );
						//print_r($taxonomy_names); 
						$i=1;
						$count=count($taxonomies);
						foreach ( $taxonomies as $taxonomy ) {
							
								echo $taxonomy; // Output the name of the term
								
								if($i<$count)
								{
									echo ", ";
								}
								$i++;
							
						} 
					?>
                   <br>
                </div>
     </div>
   
            
            <?php
			}
			}
			?><?php */?>
             </div>
            <!--/*New feature work section*/-->
    
        <div data-desktopsort="1" class="textZone textZone12" id="textZone_A" style="margin:0 auto !important; float: none !important; margin-bottom:20px !important;">
            
  
            <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>work">See More Featured work <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
        </div>

        <div data-desktopsort="2" class="buttonZone12"  style="margin:0 auto !important; float: none !important;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>work-page/submit-work/" class="button">Sumbit work to be featured <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg></a>
        </div>

      <?php /*?>  <?php // Inside Monitor
        while ( have_rows('inside_monitor') ) : the_row(); ?>
            <div data-desktopsort="3" class="imageZone imageZone34 imageZone-monitor">
                <div class="imageWindow" >
                    <img src="<?php echo get_sub_field('image'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/monitor.png">
                </div>
            </div>
            <div data-desktopsort="5" class="textZone textZone4" id="textZone_B">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                    <?php echo $a->post_title; ?><br />
                    <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                    <?php //echo $featured_work_post->post_title; ?>
                    <?php echo $c; ?><br />
                    </p>
                        <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Inside Monitor ?><?php */?>

 <?php /*?>       <?php // Magazine
        while ( have_rows('magazine') ) : the_row(); ?>
            <div data-desktopsort="4" class="imageZone imageZone12 imageZone-magazine">
                <div class="imageWindow">
                    <img src="<?php echo get_sub_field('image'); ?>" />
                </div>
            </div>
            <div data-desktopsort="7" class="textZone textZone1" id="textZone_C">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                        <?php echo $a->post_title; ?><br />
                        <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                        <?php //echo $featured_work_post->post_title; ?>
                        <?php echo $c; ?><br />
                    </p>
                    <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Magazine ?><?php */?>

        <?php /*?><?php // Inside Smartphone
        while ( have_rows('inside_smartphone') ) : the_row(); ?>
            <div data-desktopsort="6" class="imageZone imageZone34 imageZone-smartphone">
                <div class="imageWindow" >
                    <img src="<?php echo get_sub_field('image'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/smartphone.png">
                </div>
            </div>
            <div data-desktopsort="9" class="textZone textZone4" id="textZone_D">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                        <?php echo $a->post_title; ?><br />
                        <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                        <?php //echo $featured_work_post->post_title; ?>
                        <?php echo $c; ?><br />
                    </p>
                    <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Inside Smartphone ?><?php */?>

        <?php /*?><?php // Inside TV
        while ( have_rows('inside_tv') ) : the_row(); ?>
            <div data-desktopsort="8" class="imageZone imageZone12 imageZone12-tv">
                <div class="imageWindow" >
                    <img src="<?php echo get_sub_field('image'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hitachi-tv.png">
                </div>
            </div>
            <div data-desktopsort="11" class="textZone textZone1" id="textZone_E">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                        <?php echo $a->post_title; ?><br />
                        <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                        <?php //echo $featured_work_post->post_title; ?>
                        <?php echo $c; ?><br />
                    </p>
                    <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Inside TV ?><?php */?>

        <?php /*?><?php // Inside Glasses
        while ( have_rows('inside_glasses') ) : the_row(); ?>
            <div data-desktopsort="10" class="imageZone imageZone34 imageZone-glasses">
                <div class="imageWindow" >
                    <img src="<?php echo get_sub_field('image'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/glasses.png">
                </div>
            </div>
            <div data-desktopsort="13" class="textZone textZone4" id="textZone_F">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                        <?php echo $a->post_title; ?><br />
                        <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                        <?php //echo $featured_work_post->post_title; ?>
                        <?php echo $c; ?><br />
                    </p>
                    <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Inside Glasses ?>

        <?php // Bins
        while ( have_rows('bins') ) : the_row(); ?>
            <div data-desktopsort="12" class="imageZone imageZone12 imageZone-bins">
                <div class="imageWindow" >
                    <img src="<?php echo get_sub_field('image'); ?>" />
                </div>
            </div>
            <div data-desktopsort="14" class="textZone textZone1" id="textZone_G">
                <?php
                if(get_sub_field('source') == 'work'){
                    $featured_work_post = get_sub_field('featured_work');
                    $a = get_field('agency',$featured_work_post->ID);
                    $c = get_field('client',$featured_work_post->ID);
                    ?>
                    <p>
                        <?php echo $a->post_title; ?><br />
                        <?php echo strip_tags(get_the_term_list( $featured_work_post->ID, 'work-category', '', ', ', '' ))?><br />
                        <?php //echo $featured_work_post->post_title; ?>
                        <?php echo $c; ?><br />
                    </p>
                    <a href="<? the_permalink($featured_work_post)?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                } else {
                    echo get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>
                    <p><a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">Learn More <svg class="xrarr" viewBox="0 0 30 17"><line x1="0" y1="8.5" x2="26.8" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg></a></p>
                    <?php
                }
                ?>
            </div>
        <? endwhile; // end - Bins ?>
<?php */?>
    </div>

    <div class="contentZone01234boxed contentZoneInverted">
        <?php the_field('content_zone_01234'); ?>
    </div>

<?php /* ?>
    <div class="instaFeedWrapper">
        <div class="instaFeed">
            <?php echo do_shortcode('[wdi_feed id="1"]'); ?>
        </div>
        <a target="_blank" href="https://www.instagram.com/phillyadclub/" class="instaFeedRight">
            <div>
                <div>GET SOCIAL</div>
                <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg>
            </div>
        </a>
    </div>
<?php */ ?>
    <div class="instaFeedWrapper">
        <div class="instaFeed">
            <?php echo do_shortcode('[instagram-feed]'); ?>
        </div>
        <a target="_blank" href="https://www.instagram.com/phillyadclub/" class="instaFeedRight">
            <div>
                <div>GET SOCIAL</div>
                <svg class="xrarr" viewBox="0 0 40 17"><line x1="0" y1="8.5" x2="36.8" y2="8.5"></line><polyline points="30,1.7 36.8,8.5 30,15.3 "></polyline></svg>
            </div>
        </a>
    </div>


<?php get_footer();