<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
     * If you're building a theme based on Twenty Seventeen, use a find and replace
     * to change 'twentyseventeen' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'twentyseventeen' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    //add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

    //add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

    //i763
    add_image_size( 'header_image', 1920, 700, true );
    add_image_size( 'work_square', 400, 400, true );
    add_image_size( 'fancybox', 800, 600, false );
    add_image_size( 'headshot', 250, 250, true );
    #add_image_size( 'team_thumb', 500, 500, true );
    #add_image_size( 'blog_thumb', 900, 600, true );
    #add_image_size( 'blog_thumb_small', 450, 300, true );
    #add_image_size( 'blog_thumb_small_small', 150, 150, true );

    // Set the default content width.
    $GLOBALS['content_width'] = 525;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'top'    => __( 'Top Menu', 'twentyseventeen' ),
        'social' => __( 'Social Links Menu', 'twentyseventeen' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ) );

    // Add theme support for Custom Logo.
    add_theme_support( 'custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-width'  => true,
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
      */
    add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );


}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );


/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
    $fonts_url = '';

    /*
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

    if ( 'off' !== $libre_franklin ) {
        $font_families = array();

        $font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 1', 'twentyseventeen' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'twentyseventeen' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }

    $link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
    }
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );


/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
    /*
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    */
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
    if ( is_archive() || is_search() || is_home() ) {
        $attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'em';
    $args['format']   = 'list';

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );


/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );


function fix_tiny_mce_before_init( $in ) {

    // You can actually debug this without actually needing Advanced Tinymce Config enabled:
    // print_r( $in );
    // exit();

    $in['valid_children']="+a[div|p|ul|ol|li|h1|span|h2|h3|h4|h5|h5|h6]";
    //$in[ 'force_p_newlines' ] = FALSE;
    $in[ 'remove_linebreaks' ] = FALSE;
    $in[ 'force_br_newlines' ] = FALSE;
    $in[ 'remove_trailing_nbsp' ] = FALSE;
    $in[ 'apply_source_formatting' ] = FALSE;
    //$in[ 'convert_newlines_to_brs' ] = FALSE;
    $in[ 'verify_html' ] = FALSE;
    //$in[ 'remove_redundant_brs' ] = FALSE;
    $in[ 'validate_children' ] = FALSE;
    //$in[ 'forced_root_block' ]= FALSE;

    return $in;
}
add_filter( 'tiny_mce_before_init', 'fix_tiny_mce_before_init' );

add_filter('acf/format_value/type=textarea', 'do_shortcode');



// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


function my_breadcrumbs() {
    $showCurrent = 1;
    $delimiter = '>';

    global $post;

    if ( is_home() || is_front_page() ) return;

    if (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) {
                echo ' ' . $delimiter . ' ';
            }
        }
        if ($showCurrent == 1) {
            echo ' ' . $delimiter . ' ' . '<span>' . get_the_title() . '</span>';
        }
    } else {
        echo '<a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>';
    }
}

function passive_breadcrumbs() {
    $showCurrent = 1;
    $delimiter = '>';

    global $post;

    if ( is_home() || is_front_page() ) return;

    if (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<span data-href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</span>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) {
                echo ' ' . $delimiter . ' ';
            }
        }
        if ($showCurrent == 1) {
            echo ' ' . $delimiter . ' ' . '<span>' . get_the_title() . '</span>';
        }
    } else {
        echo '<span data-href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</span>';
    }
}


add_action('admin_head', 'my_custom_css');
function my_custom_css() {
    echo '<style>
.select2-container .select2-selection--single{max-width: 300px!important;}
</style>';
}



/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}



/**/
$roots_includes = array(
    //'lib/utils.php',           // Utility functions
    //'lib/init.php',            // Initial theme setup and constants
    //'lib/wrapper.php',         // Theme wrapper class
    //'lib/sidebar.php',         // Sidebar class
    //'lib/config.php',          // Configuration
    //'lib/activation.php',      // Theme activation
    //'lib/titles.php',          // Page titles
    //'lib/nav.php',             // Custom nav modifications
    'lib/pagination.php',      // Custom pagination
    //'lib/gallery.php',         // Custom [gallery] modifications
    //'lib/comments.php',        // Custom comments modifications
    //'lib/scripts.php',         // Scripts and stylesheets
    'lib/types_and_tax.php',   // Custom functions
    //'lib/extras.php',          // Custom functions
);
foreach ($roots_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);


function right_arrow($atts){
    return '<svg class="xrarr" viewbox="0 0 30 17"><line x1="0" y1="8.5" x2="25" y2="8.5"></line><polyline points="20,1.7 26.8,8.5 20,15.3 "></polyline></svg>';
}
add_shortcode('right_arrow', 'right_arrow');



add_filter( 'gform_pre_render', 'populate_posts' );
add_filter( 'gform_pre_validation', 'populate_posts' );
add_filter( 'gform_pre_submission_filter', 'populate_posts' );
add_filter( 'gform_admin_pre_render', 'populate_posts' );
function populate_posts( $form ) {
//var_dump($form['fields']);


    foreach ( $form['fields'] as &$field ) {

        if ( $field->inputType != 'select' || strpos( $field->cssClass, 'populate-agency' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts( 'numberposts=-1&post_status=publish&post_type=agency' );

        $choices = array();

        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->ID );
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select an agency';
        $field->choices = $choices;

    }

    return $form;
}

add_action("gform_after_submission_4", "acf_post_submission", 10, 2);
function acf_post_submission ($entry, $form)
{
    $post_id = $entry["post_id"];
    $values = get_field("employer_agency", $post_id);
    //echo "<br />test selected: " . $values;
    update_field("field_5eec8caa89f0a", $values, $post_id);
}

add_action("gform_after_submission_3", "acf_post_submission2", 10, 2);
function acf_post_submission2 ($entry, $form)
{
    $post_id = $entry["post_id"];
    $values = get_field("agency", $post_id);
    //echo "<br />test selected: " . $values;
    update_field("field_54ae0f0c034fa", $values, $post_id);

}

function tierbacklinks($atts){
    ob_start();
    ?>
    <div class="tierBackLinks">
        <a class="button tierButton" href="<?php echo esc_url( home_url( '/' ) ); ?>membership/benefits/#eozone_1">
            Learn More About Membership Benefits
        </a>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
add_shortcode('tierbacklinks', 'tierbacklinks');


add_action( 'pre_get_posts',  'set_posts_per_page'  );
function set_posts_per_page( $query ) {
    global $wp_query;
    if ( !is_admin() ){
        if ($wp_query->query['pagename'] == 'news') {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            if ($paged == 1) {
                $query->set('posts_per_page', 13);
            } else {
                $query->set('posts_per_page', 12);
            }
        }
    }
    return $query;
}

// Remove Read More Links from all excerpts
function custom_excerpt_more( $more ) {
    return '…';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

// Define own excerpt length
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );