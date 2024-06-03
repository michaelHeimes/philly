<?php


// Youtube Helpers
function youtube_embed_from_url($url, $w=null, $h=null){
  $vid = youtube_id_from_url($url);
  if($w===null) $w=420;
  if($h===null) $h=315;
  $embed = '<div class="video-container"><iframe width="'.$w.'" height="'.$h.'" src="//www.youtube.com/embed/'.$vid.'?rel=0" frameborder="0" allowfullscreen></iframe></div>';
  echo $embed;
  return;
}
function youtube_id_from_url($url){
  if(strpos($url, 'youtu.be/') !== false){
    $url = split('youtu.be/', $url);
    $url = split('/', $url[1]);
    return $url[0];
  }

  parse_str( parse_url( $url, PHP_URL_QUERY ), $vid );
  return $vid['v'];
}


// $pid = The ID of the page we're looking for pages underneath
function is_tree($pid) {     
  global $post;         // load details about this page
  if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
       return true;   // we're at the page or at a sub page
  else 
       return false;  // we're elsewhere
}

function get_menu_title($location=''){
  $ic_menu_locations = (array) get_nav_menu_locations();
  $ic_menu = get_term_by( 'id', (int) $ic_menu_locations[ $location ], 'nav_menu', ARRAY_A );
  return $ic_menu[ 'name' ];
}


// Add ACF option
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);


/*
// Migrations
function add_migrate_page() {
  add_menu_page( 'Migrate', 'Migrate', 'edit_posts', 'migrate', 'migrate', null, 6 );
  add_submenu_page('migrate', 'Migrate Agencies', 'Migrate Agencies', 'edit_posts', 'migrate_agencies', 'migrate_agencies');
  add_submenu_page('migrate', 'Migrate Blog', 'Migrate Blog', 'edit_posts', 'migrate_blog', 'migrate_blog');
  add_submenu_page('migrate', 'Migrate Events', 'Migrate Events', 'edit_posts', 'migrate_events', 'migrate_events');
  add_submenu_page('migrate', 'Migrate Jobs', 'Migrate Jobs', 'edit_posts', 'migrate_jobs', 'migrate_jobs');
  add_submenu_page('migrate', 'Migrate Jobs Dates', 'Migrate Jobs Dates', 'edit_posts', 'migrate_jobs_dates', 'migrate_jobs_dates');
}
function migrate(){
  include dirname(__FILE__) . '/../migrate/index.php';
}
function migrate_agencies(){
  include dirname(__FILE__) . '/../migrate/agencies.php';
}
function migrate_blog(){
  include dirname(__FILE__) . '/../migrate/blog.php';
}
function migrate_events(){
  include dirname(__FILE__) . '/../migrate/events.php';
}
function migrate_jobs(){
  include dirname(__FILE__) . '/../migrate/jobs.php';
}
function migrate_jobs_dates(){
  include dirname(__FILE__) . '/../migrate/jobs_dates.php';
}
add_action('admin_menu' , 'add_migrate_page');
*/



/**
 * Custom functions, all this is optional
 * Mosly cleaning up the admin interface.
 * Comment out what you don't need, and uncomment what you want.
 */



//
//    Adds foundations flex video container around oembed embeds
//
//////////////////////////////////////////////////////////////////////


add_filter('embed_oembed_html', 'embed_oembed', 99, 4);
function embed_oembed($html, $url, $attr, $post_id) {
  return '<div class="flex-video">' . $html . '</div>';
}







//
//    Fixes overlapping adminbar for Foundations top-bar
//
//////////////////////////////////////////////////////////////////////


add_action('wp_head', 'admin_bar_fix', 5);
function admin_bar_fix() {
  if( is_admin_bar_showing() ) {
    $output  = '<style type="text/css">'."\n\t";
    $output .= '@media screen and (max-width: 600px) {#wpadminbar { position: fixed !important; } }'."\n";
    $output .= '</style>'."\n";
    echo $output;
  }
}







//
//    Adds Foundation classes to next/prev buttons
//
//////////////////////////////////////////////////////////////////////


add_filter('previous_post_link', 'post_link_attributes_prev');
add_filter('next_post_link', 'post_link_attributes_next');

function post_link_attributes_prev($output) {
    $injection = 'class="button go_prev"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}
function post_link_attributes_next($output) {
    $injection = 'class="button go_next"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}









//
//    Adds the livereload script. Primarily for testing other devices on same network as web server
//    Change the IP address to the IP of the computer thats running the "gulp" command (likely your dev computer)  
//
//////////////////////////////////////////////////////////////////////


function livereload() {
  wp_register_script('livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
  wp_enqueue_script('livereload');
}

// Runs the livereload function if domain contains .dev — edit to fit your own needs
$host = $_SERVER['HTTP_HOST']; 
if (strpos($host,'.dev') !== false) {
    add_action('wp_enqueue_scripts', 'livereload');
}




// custom styles
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
  // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  update_user_meta( get_current_user_id(), 'show_welcome_panel', false );
  // remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );




function clean_up_menu(){
  remove_menu_page('upload.php');
  remove_menu_page('edit-comments.php');
}
add_filter( 'admin_menu', 'clean_up_menu');


// Move Yoast to bottom
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');





function myupload_function($url, $post_id) {

    require_once(ABSPATH . 'wp-admin' . '/includes/image.php');
    require_once(ABSPATH . 'wp-admin' . '/includes/file.php');
    require_once(ABSPATH . 'wp-admin' . '/includes/media.php');

    // upload image to server
  media_sideload_image($url, $post_id);

    // get the newly uploaded image
    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'number_posts' => 1,
        'post_status' => null,
        'post_parent' => $post_id,
        'orderby' => 'post_date',
        'order' => 'DESC',)
    );

    // returns the id of the image
    return $attachments[0]->ID;
}


