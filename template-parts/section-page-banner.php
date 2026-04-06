<?php
$banner_image = null;

if( is_post_type_archive('work') ) {
	$banner_image = get_field('banner_image', 15352) ?? null;
} elseif( is_post_type_archive('job') ) {	
	$banner_image = get_field('banner_image', 15525) ?? null;
} elseif( is_post_type_archive('event') ) {	
		$banner_image = get_field('banner_image', 15330) ?? null;
} elseif( is_post_type_archive('past_event') ) {	
		$banner_image = get_field('banner_image', 23180) ?? null;
} elseif( is_home() ) {	
		$banner_image = get_field('banner_image', get_option( 'page_for_posts' ) ) ?? null;
} else {
	$banner_image = get_field('banner_image') ?? null;
}

if($banner_image):
?>
<div class="page-banner">
	<?=wp_get_attachment_image( $banner_image['id'], 'full' );?>
</div>
<?php endif;?>