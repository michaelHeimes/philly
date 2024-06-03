<?
// custom post types
function create_post_type() {

  register_post_type( 'agency',
    array(
      'labels' => array(
        'name' => __( 'Agencies' ),
        'singular_name' => __( 'Agency' )
      ),
    'menu_icon' => 'dashicons-groups',
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'agency'),
    'supports' => array ('title', 'editor', 'thumbnail')
    )
  );

  register_post_type( 'work',
    array(
      'labels' => array(
        'name' => __( 'Work' ),
        'singular_name' => __( 'Work' )
      ),
    'menu_icon' => 'dashicons-admin-appearance',
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'work'),
    'supports' => array ('title', 'editor', 'thumbnail')
    )
  );

  register_post_type( 'job',
    array(
      'labels' => array(
        'name' => __( 'Jobs' ),
        'singular_name' => __( 'Job' )
      ),
    'menu_icon' => 'dashicons-hammer',
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'job'),
    'supports' => array ('title', 'editor', 'thumbnail')
    )
  );

  /*
  register_post_type( 'event',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' )
      ),
    'menu_icon' => 'dashicons-calendar',
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'events'),
    'supports' => array ('title', 'editor', 'thumbnail')
    )
  );

  register_post_type( 'ad_locations',
    array(
      'labels' => array(
        'name' => __( 'Ad Locations' ),
        'singular_name' => __( 'Ad Location' )
      ),
    'menu_icon' => 'dashicons-schedule',
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'ad_locations'),
    'supports' => array ('title')
    )
  );

  register_post_type( 'ad',
    array(
      'labels' => array(
        'name' => __( 'Ads' ),
        'singular_name' => __( 'Ad' )
      ),
    'menu_icon' => 'dashicons-format-gallery',
    'public' => true,
    'has_archive' => false,
    'rewrite' => array('slug' => 'ad'),
    'supports' => array ('title')
    )
  );
  */

}
add_action( 'init', 'create_post_type' );

function add_taxonomies(){
  
  $labels = array(
    'name'              => _x( 'Areas', 'taxonomy general name' ),
    'singular_name'     => _x( 'Area', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Area' ),
    'all_items'         => __( 'All Areas' ),
    'parent_item'       => __( 'Parent Area' ),
    'parent_item_colon' => __( 'Parent Area:' ),
    'edit_item'         => __( 'Edit Area' ),
    'update_item'       => __( 'Update Area' ),
    'add_new_item'      => __( 'Add New Area' ),
    'new_item_name'     => __( 'New Area Name' ),
    'menu_name'         => __( 'Areas' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'area' ),
  );
  register_taxonomy( 'area', array( 'job' ), $args );

    $labels = array(
        'name'              => _x( 'Levels', 'taxonomy general name' ),
        'singular_name'     => _x( 'Level', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Level' ),
        'all_items'         => __( 'All Levels' ),
        'parent_item'       => __( 'Parent Level' ),
        'parent_item_colon' => __( 'Parent Level:' ),
        'edit_item'         => __( 'Edit Level' ),
        'update_item'       => __( 'Update Level' ),
        'add_new_item'      => __( 'Add New Level' ),
        'new_item_name'     => __( 'New Area Name' ),
        'menu_name'         => __( 'Levels' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'level' ),
    );
    register_taxonomy( 'level', array( 'job' ), $args );



    $labels = array(
    'name'              => _x( 'Programs', 'taxonomy general name' ),
    'singular_name'     => _x( 'Program', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Program' ),
    'all_items'         => __( 'All Programs' ),
    'parent_item'       => __( 'Parent Program' ),
    'parent_item_colon' => __( 'Parent Program:' ),
    'edit_item'         => __( 'Edit Program' ),
    'update_item'       => __( 'Update Program' ),
    'add_new_item'      => __( 'Add New Program' ),
    'new_item_name'     => __( 'New Program Name' ),
    'menu_name'         => __( 'Programs' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'program' ),
  );
  register_taxonomy( 'program', array( 'event', 'post' ), $args );


  $labels = array(
    'name'              => _x( 'Awards', 'taxonomy general name' ),
    'singular_name'     => _x( 'Award', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Award' ),
    'all_items'         => __( 'All Awards' ),
    'parent_item'       => __( 'Parent Award' ),
    'parent_item_colon' => __( 'Parent Award:' ),
    'edit_item'         => __( 'Edit Award' ),
    'update_item'       => __( 'Update Award' ),
    'add_new_item'      => __( 'Add New Award' ),
    'new_item_name'     => __( 'New Award Name' ),
    'menu_name'         => __( 'Awards' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'award' ),
  );
  register_taxonomy( 'award', array( 'work' ), $args );



    $labels = array(
        'name'              => _x( 'Work Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Work Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Work Category' ),
        'all_items'         => __( 'All Work Category' ),
        'parent_item'       => __( 'Parent Work Category' ),
        'parent_item_colon' => __( 'Parent Work Category:' ),
        'edit_item'         => __( 'Edit Work Category' ),
        'update_item'       => __( 'Update Work Category' ),
        'add_new_item'      => __( 'Add New Work Category' ),
        'new_item_name'     => __( 'New Work Category Name' ),
        'menu_name'         => __( 'Work Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'work-category' ),
    );
    register_taxonomy( 'work-category', array( 'work' ), $args );

    $labels = array(
        'name'              => _x( 'Work Area', 'taxonomy general name' ),
        'singular_name'     => _x( 'Work Area', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Work Area' ),
        'all_items'         => __( 'All Work Areas' ),
        'parent_item'       => __( 'Parent Work Area' ),
        'parent_item_colon' => __( 'Parent Work Area:' ),
        'edit_item'         => __( 'Edit Work Area' ),
        'update_item'       => __( 'Update Work Area' ),
        'add_new_item'      => __( 'Add New Work Area' ),
        'new_item_name'     => __( 'New Work Area Name' ),
        'menu_name'         => __( 'Work Area' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'workarea' ),
    );
    register_taxonomy( 'workarea', array( 'work' ), $args );

}
add_action( 'init', 'add_taxonomies' );

/*
add_action( 'template_redirect', 'redirect_cpt' );

function redirect_cpt() {

  // $queried_post_type = get_query_var('post_type');
  // if ( is_single() && 'agency' ==  $queried_post_type ) {
  //   wp_redirect( 'directories', 301 );
  //   exit;
  // }
}
*/