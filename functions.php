<?php


/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */




/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function sls_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'sls' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sls', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'menus' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Top Navigation', 'sls' ) );
	register_nav_menu( 'footer', __( 'Footer Navigation', 'sls' ) );
	register_nav_menu( 'bottom', __( 'Bottom Side Menu', 'sls' ) );


	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */


	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'sls_setup' );


/**
 * Returns the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function sls_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'sls' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		 this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'sls' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function sls_scripts_styles() {
	global $wp_styles;

	wp_enqueue_style('zf-norm', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style('zf-min', get_template_directory_uri() . '/css/foundation.css' );
	wp_enqueue_style('app-styles', get_template_directory_uri() . '/css/styles.css' );

	wp_register_script( 'zf-min', get_template_directory_uri()  . '/js/foundation.min.js', array(), false, true );
	wp_register_script('zf-mod', get_template_directory_uri()  . '/js/vendor/custom.modernizr.js' );
	wp_register_script('app-scripts', get_template_directory_uri()  . '/js/scripts.js' );

	wp_enqueue_script('zf-mod');   
	wp_enqueue_script('zf-min');   
	wp_enqueue_script('app-scripts');   
}

add_action( 'wp_enqueue_scripts', 'sls_scripts_styles' );


function myformatTinyMCE($in)
{
 $in['src']=true;
 
 return $in;
}
add_filter('tiny_mce_before_init', 'myformatTinyMCE' );


/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses sls_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string
 */
function sls_mce_css( $mce_css ) {
	$font_url = sls_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'sls_mce_css' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function sls_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'sls' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'sls_wp_title', 10, 2 );



/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function sls_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'sls' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'sls' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );


}
add_action( 'widgets_init', 'sls_widgets_init' );

if ( ! function_exists( 'sls_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function sls_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'sls' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sls' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sls' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;




add_filter('nav_menu_css_class' , 'top_nav_class' , 10 , 2);
function top_nav_class($classes, $item)
{
     if( in_array('current-menu-item', $classes) )
     {
             $classes[] = 'active ';
     }
     return $classes;
}


function get_nested_menu()
{
	 $top_level = array();
  foreach(get_pages() as $page)
  {
  	$sub = array();
  	if($page->post_parent == 0)
  	{
  		$top_level[$page->ID]['post_title'] = $page->post_title;
  		$top_level[$page->ID]['post_id'] = $page->ID;

  		$child = get_children(array('post_parent' => $page->ID));
  		if(count($child)>0)
  		{
  			foreach($child as $c)
  			{
  				$sub[$c->ID] = $c->post_title;
  			}
  			$top_level[$page->ID]['sub_menu'] = $sub;
  		}
  		
  	}
  }

  return $top_level;
}


//require('lib/footer_nav.php');
//require('lib/dropdown-menus.php');
