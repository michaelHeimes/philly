<?php
/**
 * Template Name: Event Speakers
 *
 */
$speakers = get_field('speakers') ?? null;
get_header();
?>
    <div class="content noimage">
        
        <div class="agFlexBox">
            
            <?php if ( get_the_content() ) : ?>
                <div class="contentZone0123boxed permanentGray zoneForForm mb-0 pb-30 mb-40">
                    <?php the_content();?>
                </div>
            <?php endif;?>
        </div>
        <?php if($speakers):?>
        <div class="contentZone1234 speakersWrap">
            <div class="speakers">
                <?php foreach($speakers as $speaker):
                    $photo = $speaker['photo'] ?? null;       
                    $name = $speaker['name'] ?? null;        
                    $title = $speaker['title'] ?? null;        
                    $company = $speaker['company'] ?? null;        
                    $bio = $speaker['bio'] ?? null; 
                ?>
                    <div class="speaker">
                        <div class="inner">
                            <?php if($photo):?>
                                <div class="speaker-photo">
                                    <?=wp_get_attachment_image( $photo['id'], 'medium' );?>
                                </div>
                            <?php endif;?>
                            <div class="permanentGray speaker-meta">
                            <?php if($name):?>
                                <h3>
                                    <?=wp_kses_post( $name );?>
                                </h3>
                            <?php endif;?>
                            <?php if($title || $company):?>
                                <h4><b>
                                    <?php if($title):?>
                                        <?=wp_kses_post( $title );?>
                                    <?php endif;?>
                                    <?php if($company):?>
                                        / 
                                        <?=wp_kses_post( $company );?>
                                    <?php endif;?>
                                </b></h4>
                            <?php endif;?>
                            </div>
                            <?php if($bio):?>
                                <div class="bio-wrap">
                                    <?=wp_kses_post($bio);?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endif;?>

    </div>
<?php get_footer();
