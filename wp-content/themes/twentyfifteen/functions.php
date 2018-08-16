<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.

	/**
	 * Filter Twenty Fifteen custom-header support arguments.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-color     		Default color of the header.
	 *     @type string $default-attachment     Default attachment of the header.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Fifteen 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Fifteen 1.9
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyfifteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyfifteen_widget_tag_cloud_args' );


/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';



/* =================================================================================================
====================================================================================================
========================================== my functions ============================================
====================================================================================================
==================================================================================================*/
/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function custom_scripts() {
	/* ==============================================================================================
	================================= Подключение стилей ============================================
	================================================================================================*/
	// Load our main stylesheet
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'bootstrap', 'slick-slider-css', 'magnific-popup', 'fonts') );
	// Load bootstrap stylesheet
	wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('bootstrap');
	// Load flexslider stylesheet
	wp_register_style('slick-slider-css', get_template_directory_uri() . '/plugins/slick-slider/slick.css');
	wp_enqueue_style('slick-slider-css');
	// Load magnific-popup stylesheet
	wp_register_style('magnific-popup', get_template_directory_uri() . '/plugins/magnific-popup/magnific-popup.css');
	wp_enqueue_style('magnific-popup');
	if (  is_page_template('page-templates/error-template.php') || is_page_template('page-templates/thx-template.php') ) {
		wp_register_style('thx-error-style', get_template_directory_uri() . '/css/thx-error-style.css');
		wp_enqueue_style('thx-error-style');
	}
	// Load fonts stylesheet
	wp_register_style('fonts', get_template_directory_uri() . '/css/fonts.css');
	wp_enqueue_style('fonts');
	/* ==============================================================================================
	============================ Подключение jQuery & javascript ====================================
	================================================================================================*/
	//Отключение  jQuery по умолчанию и подключение своего скрипта
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/js/custom-js/jquery-1.12.3.min.js', NULL, NULL, true);
	wp_enqueue_script('jquery');
	wp_register_script('slick-slider', get_template_directory_uri() . '/plugins/slick-slider/slick.js', array('jquery'), NULL, true);
	wp_enqueue_script('slick-slider');
	wp_register_script('magnific-popup-js', get_template_directory_uri() . '/plugins/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), NULL, true);
	wp_enqueue_script('magnific-popup-js');
	wp_register_script('maskedinput-js', get_template_directory_uri() . '/plugins/maskedinput/jquery.maskedinput.min.js', array('jquery'), NULL, true);
	wp_enqueue_script('maskedinput-js');
	wp_register_script('custom-js', get_template_directory_uri() . '/js/custom-js/custom.js', array('jquery'), NULL, true);
	wp_enqueue_script('custom-js');
	wp_register_script('init-js', get_template_directory_uri() . '/js/custom-js/init.js', array('jquery'), NULL, true);
	wp_enqueue_script('init-js');
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
/* ==============================================================================================
============================ Подключение скриптов и стилей End ==================================
================================================================================================*/



/* ==============================================================================================
================================== Отключение обновлений ========================================
================================================================================================*/
// отключаем обновление тем
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', '__return_null' );
// отключаем авто обновления
add_filter( 'auto_update_theme', '__return_false' );
// спрячем имеющиеся уведомления
add_action('admin_menu','hide_admin_notices');
function hide_admin_notices() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}
/* ==============================================================================================
================================ Отключение обновлений End ======================================
================================================================================================*/



/* ==============================================================================================
=============================== Плагин my_cfs_options_screens ===================================
================================================================================================*/
function my_cfs_options_screens( $screens ) {
	$screens[] = array(
		'name'            => 'options',
		'menu_title'      => __( 'Шапка и Подвал' ),
		'page_title'      => __( 'Шапка и Подвал' ),
		'menu_position'   => 10,
		'icon'            => 'dashicons-admin-generic', // optional, dashicons-admin-generic is the default
		'field_groups'    => array(
			'Шапка сайта',
			'Подвал сайта'
		), // Field Group name(s) of CFS Field Group to use on this page (can also be post IDs)
	);
	return $screens;
}
//add_filter( 'cfs_options_screens', 'my_cfs_options_screens' );
/* вывод в шаблоне */
/* $var = cfs_get_option('options', 'field_name');
	первый параметр - $screens['name'] - ( массива $screens с ключем name ) */
/* ==============================================================================================
============================= Плагин my_cfs_options_screens End =================================
================================================================================================*/





/* ==============================================================================================
======================================= Создание виджета ========================================
================================================================================================*/
function my_widgets_init() {
	/* header_logo_sidebar */
	register_sidebar( array(
		'name' => __( 'Logo Sidebar', 'header_logo_sidebar' ),
		'id' => 'header_logo_sidebar',
	) );

	/* header_phone_sidebar */
	register_sidebar( array(
		'name' => __( 'Phone Sidebar', 'header_phone_sidebar' ),
		'id' => 'header_phone_sidebar',
	) );

	/* header_menu_sidebar */
	register_sidebar( array(
		'name' => __( 'Menu Sidebar', 'header_menu_sidebar' ),
		'id' => 'header_menu_sidebar',
	) );

	/* header_auth_sidebar */
	register_sidebar( array(
		'name' => __( 'Auth Button text Sidebar', 'header_auth_sidebar' ),
		'id' => 'header_auth_sidebar',
	) );

	/* header_menu_social_sidebar */
	register_sidebar( array(
		'name' => __( 'Menu Social Sidebar', 'header_menu_social_sidebar' ),
		'id' => 'header_menu_social_sidebar',
	) );

	/* header_lang_switcher_sidebar */
	register_sidebar( array(
		'name' => __( 'Lang Switcher Sidebar', 'header_lang_switcher_sidebar' ),
		'id' => 'header_lang_switcher_sidebar',
	) );

	/* header_try_free_sidebar */
	register_sidebar( array(
		'name' => __( 'Try Sidebar', 'header_try_free_sidebar' ),
		'id' => 'header_try_free_sidebar',
	) );

	/* header_hamburger_sidebar */
	register_sidebar( array(
		'name' => __( 'Hamburger Sidebar', 'header_hamburger_sidebar' ),
		'id' => 'header_hamburger_sidebar',
	) );
}
add_action( 'widgets_init', 'my_widgets_init' );





// Register and load the widget
function wpb_load_widget() {
	register_widget( 'header_logo_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );



// Creating the widget
class header_logo_widget extends WP_Widget {

	function __construct() {
		parent::__construct(

			'header_widget',
			__('Виджет для лого шапки сайта', 'header_widget_domain'),

			array( 'description' => __( 'Виджет для лого шапки сайта', 'header_widget_domain' ), )
		);
	}

// Creating widget front-end

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		if ( ! empty( $title ) ) {
			echo '<div class="header__logoWrap">
						<a href="' . esc_url(home_url("/")) . '" class="header__logoLink">
							<img src="' . $title . '" alt="" class="header__logoImg">
						</a>
					</div>';
		}



// This is where you run the code and display the output
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}
// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here
/* ==============================================================================================
========================================== Создание виджета End =================================
================================================================================================*/


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Страница настроек темы',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

/**
 * Change a currency symbol
 */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch( $currency ) {
		case 'UAH': $currency_symbol = get_field('currency_symb_uah', 'options'); break;
	}
	return $currency_symbol;
}


/*****/
// add core markup to woocommerce pages
add_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
// overwrite existing output content wrapper function
function woocommerce_output_content_wrapper() {
	echo '<div class="container woocomm__container">
			<div class="row woocomm__row">
				<div class="col-xs-12" ><div class="woocomm__col">';

	if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / ');
}
add_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');
function woocommerce_output_content_wrapper_end() {
	echo '</div>
		</div>
	</div>';
}

/* Удаляет хлебные крошки */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20,0);

/* Удаляет строку "Показывает 10 товаров" */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20,0);


/* Удаляет фильтр товаров" */
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30,0);

// Modify the default WooCommerce orderby dropdown
//
// Options: menu_order, popularity, rating, date, price, price-desc
// In this example I'm removing price & price-desc but you can remove any of the options
function patricks_woocommerce_catalog_orderby( $orderby ) {
	unset($orderby["menu_order"]);
	unset($orderby["popularity"]);
	unset($orderby["rating"]);
	unset($orderby["date"]);

	$orderby["price"] = __('', 'woocommerce');
	$orderby["price-desc"] = __('', 'woocommerce');

	return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "patricks_woocommerce_catalog_orderby", 20 );


/* ----------------------------------------------- */
/* ----------------------------------------------- */
/* ----------------------------------------------- */


/*function show_shipping_class(){
	$product = wc_get_product( get_the_ID() );
	$shipclass = $product->get_shipping_class();
	echo $shipclass;
}*/

/* в Карточке товара меняю поле Текст сообщения местами с остальными полями(Текст сообщения внизу) */
function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
/* в Карточке товара меняю поле Текст сообщения местами с остальными полями(Текст сообщения внизу) End */


/**
 * Change the text output that appears before the comment form
 * Note: Logged in user will not see this text.
 */
add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );
function cd_pre_comment_text( $arg ) {
	$arg['comment_notes_before'] = '<div class="reply-title-after">Используйте данную форму, чтобы оставить отзыв о товаре или задать вопрос</div>';
	return $arg;
}
/* Change the text output that appears before the comment form End */
/* ----------------------------------------------- */
/* ----------------------------------------------- */
/* ----------------------------------------------- */

/* ==============================================================================================
================================ Создание кастомного типа записей ===============================
================================================================================================*/
function create_posttype() {

	register_post_type( 'movies',
		// CPT Options
		array(
			'labels' => array(
				'name'                => _x( 'Видеосоветы', 'Post Type General Name', 'twentyfifteen' ),
				'singular_name'       => _x( 'Видеосовет', 'Post Type Singular Name', 'twentyfifteen' ),
				'menu_name'           => __( 'Видеосоветы', 'twentyfifteen' ),
				'parent_item_colon'   => __( 'Parent Movie', 'twentyfifteen' ),
				'all_items'           => __( 'Все Видеосоветы', 'twentyfifteen' ),
				'view_item'           => __( 'Просмотреть', 'twentyfifteen' ),
				'add_new_item'        => __( 'Добавить новый', 'twentyfifteen' ),
				'add_new'             => __( 'Добавить новый', 'twentyfifteen' ),
				'edit_item'           => __( 'Изменить', 'twentyfifteen' ),
				'update_item'         => __( 'Редактировать', 'twentyfifteen' ),
				'search_items'        => __( 'Найти Видеосовет', 'twentyfifteen' ),
				'not_found'           => __( 'Не найдено', 'twentyfifteen' ),
				'not_found_in_trash'  => __( 'Не найдено в корзине', 'twentyfifteen' ),
			),
			'public' 	  => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'videotip'),
			'menu_icon'   => 'dashicons-video-alt3',
		)
	);

	register_post_type( 'usersfeedback',
		// CPT Options
		array(
			'labels' => array(
				'name'                => _x( 'Отзывы', 'Post Type General Name', 'twentyfifteen' ),
				'singular_name'       => _x( 'Отзыв', 'Post Type Singular Name', 'twentyfifteen' ),
				'menu_name'           => __( 'Отзывы', 'twentyfifteen' ),
				'all_items'           => __( 'Все Отзывы', 'twentyfifteen' ),
				'view_item'           => __( 'Просмотреть', 'twentyfifteen' ),
				'add_new_item'        => __( 'Добавить новый', 'twentyfifteen' ),
				'add_new'             => __( 'Добавить новый', 'twentyfifteen' ),
				'edit_item'           => __( 'Изменить', 'twentyfifteen' ),
				'update_item'         => __( 'Редактировать', 'twentyfifteen' ),
				'search_items'        => __( 'Найти Отзыв', 'twentyfifteen' ),
				'not_found'           => __( 'Не найдено', 'twentyfifteen' ),
				'not_found_in_trash'  => __( 'Не найдено в корзине', 'twentyfifteen' ),
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array('slug' => 'feedback'),
			'menu_icon'   => 'dashicons-format-video',
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
/* ==============================================================================================
============================== Создание кастомного типа записей End =============================
================================================================================================*/




/* ==============================================================================================
================================ Хлебные крошки (breadcrumbs) ===================================
================================================================================================*/


//это вставить в месте где выводятся хлебные крошки
//if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / ');


/**
 * Хлебные крошки (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.1
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
		// или можно указать свой массив разметки:
		// array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
		// Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
		// 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
		// порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="kama_breadcrumbs">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		// ну, с богом...
		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num ) {
					if ( is_shop() ) {
						$home_after = 'Ассортимент';
					} else {
						$home_after = $pt_title;
					}
				}
				// singular, paged post_type_archive, tax
				else{
					if ( is_shop() ) {
						$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), 'Ассортимент' );

						$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
					} else {
						$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

						$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
					}
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

/**
 * Изменения:
 * 3.3 - новые хуки: attachment_tax_crumbs, post_tax_crumbs, term_tax_crumbs. Позволяют дополнить крошки таксономий.
 * 3.2 - баг с разделителем, с отключенным 'show_term_title'. Стабилизировал логику.
 * 3.1 - баг с esc_html() для заголовка терминов - с тегами получалось криво...
 * 3.0 - Обернул в класс. Добавил опции: 'title_patt', 'last_sep'. Доработал код. Добавил пагинацию для постов.
 * 2.5 - ADD: Опция 'show_term_title'
 * 2.4 - Мелкие правки кода
 * 2.3 - ADD: Страница записей, когда для главной установлена отделенная страница.
 * 2.2 - ADD: Link to post type archive on taxonomies page
 * 2.1 - ADD: $sep, $loc, $args params to hooks
 * 2.0 - ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 * 1.9 - ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 * 1.8 - FIX: заметки, когда в рубрике нет записей
 * 1.7 - Улучшена работа с приоритетными таксономиями.
 */

/* ==============================================================================================
================================ Хлебные крошки (breadcrumbs) ===================================
================================================================================================*/





/* ==============================================================================================
========================================== checkout Page ========================================
================================================================================================*/


/* ======================================= */
/* Добавляем поле в группу Детали доставки */
/* ======================================= */
add_filter( 'woocommerce_checkout_fields' , 'custom_checkout_fields' );
function custom_checkout_fields( $fields ) {

	/* Поле ДОМ */
	$fields['billing']['billing_house'] = array(
		'type' => 'text',
		'label' => __('Дом', 'woocommerce'),
		'placeholder' => '',
		'required' => true,
		'class' => array('form-row-wide'),
		'clear' => true
	);
	/* Поле ДОМ End */

	/* Поле Улица */
	$fields['billing']['billing_street'] = array(
		'type' => 'text',
		'label' => __('Улица', 'woocommerce'),
		'placeholder' => '',
		'required' => true,
		'class' => array('form-row-wide'),
		'clear' => true
	);
	/* Поле Улица End */

	/* Поле Время доставки */
	$fields['billing']['shipping_date'] = array(
		'type' => 'text',
		'label' => __('Время доставки', 'woocommerce'),
		'placeholder' => '',
		'required' => true,
		'class' => array(''),
		'clear' => true
	);
	/* Поле Время доставки End */

	/* Поле Варианты оплаты */
	if ( WC()->cart->needs_payment() ) {
		$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
		if ( ! empty( $available_gateways ) ) {
			foreach ($available_gateways as $gateway) {
				$opt = [];
				foreach ($available_gateways as $gateway) {
					$opt[esc_attr($gateway->id)] = $gateway->get_title();
				}
			}
		}

		$fields['billing']['payment_method'] = array(
			'type' => 'select',
			'label' => __('Варианты оплаты', 'woocommerce'),
			'placeholder' => '',
			'required' => false,
			'class' => array('form-row'),
			'clear' => true,
			'options' => $opt,
		);

		return $fields;
	}
	/* Поле Варианты оплаты End */

}
/* =========================================== */
/* Добавляем поле в группу Детали доставки End */
/* =========================================== */




/* ============================================= */
/* Сохраняем метаданные заказа со значением поля */
/* ============================================= */
add_action( 'woocommerce_checkout_update_order_meta', 'billing_apartment_update_order_meta' );
function billing_apartment_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['billing_house'] ) ) {
		update_post_meta( $order_id, 'billing_house', sanitize_text_field( $_POST['billing_house'] ) );
	}
	if ( ! empty( $_POST['billing_street'] ) ) {
		update_post_meta( $order_id, 'billing_street', sanitize_text_field( $_POST['billing_street'] ) );
	}
	if ( ! empty( $_POST['shipping_date'] ) ) {
		update_post_meta( $order_id, 'shipping_date', sanitize_text_field( $_POST['shipping_date'] ) );
	}

	/*Поле Варианты оплаты проверить сохраняется ли*/
}
/* ================================================= */
/* Сохраняем метаданные заказа со значением поля End */
/* ================================================= */




/* ================================================ */
/* Проверка поля при отправке заказа (обязательное) */
/* ================================================ */
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');
function my_custom_checkout_field_process() {
	if ( ! $_POST['billing_house'] ) {
		wc_add_notice( '<strong>Поле Дом</strong> является обязательным полем.', 'error' );
	}
	if ( ! $_POST['billing_street'] ) {
		wc_add_notice( '<strong>Поле Улица</strong> является обязательным полем.', 'error' );
	}
	if ( ! $_POST['shipping_date'] ) {
		wc_add_notice( '<strong>Поле Время доставки</strong> является обязательным полем.', 'error' );
	}
}
/* ==================================================== */
/* Проверка поля при отправке заказа (обязательное) End */
/* ==================================================== */




/* ==================================================================== */
/* Выводим значения полей на странице редактирования заказа (в админке) */
/* ==================================================================== */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'custom_field_display_admin_order_meta', 10, 1 );
function custom_field_display_admin_order_meta($order){

	global $woocommerce, $post;
	$order = new WC_Order($post->ID);
	$order_id = trim(str_replace('#', '', $order->get_order_number()));

	echo '<p><strong>'.__('Время доставки').':</strong> ' . get_post_meta( $order_id, 'shipping_date', true ) . '</p>';
	echo '<p><strong>'.__('Улица').':</strong> ' . get_post_meta( $order_id, 'billing_street', true ) . '</p>';
	echo '<p><strong>'.__('Дом').':</strong> ' . get_post_meta( $order_id, 'billing_house', true ) . '</p>';
}
/* ======================================================================== */
/* Выводим значения полей на странице редактирования заказа (в админке) End */
/* ======================================================================== */





/* ================================================= */
/* Выводим значения полей в шаблоне письма с заказом */
/* ================================================= */
add_filter('woocommerce_email_order_meta_keys', 'email_checkout_field_order_meta_keys');
function email_checkout_field_order_meta_keys( $keys ) {
	$keys['Время доставки'] = 'shipping_date';
	$keys['Улица'] = 'billing_street';
	$keys['Дом'] = 'billing_house';

	return $keys;
}
/* ===================================================== */
/* Выводим значения полей в шаблоне письма с заказом End */
/* ===================================================== */




add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );
function custom_remove_woo_checkout_fields( $fields ) {
	unset($fields['billing']['billing_country']);  //удаляем! тут хранится значение страны оплаты
	unset($fields['shipping']['shipping_country']); ////удаляем! тут хранится значение страны доставки

	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['order']['order_comments']);

	$fields['billing']['e_deliverydate']['label'] = 'Время доставки';
	$fields['billing']['e_deliverydate']['required'] = true;

	$fields['billing']['billing_city']['label'] = 'Город';

	$fields['billing']['billing_address_2']['label'] = 'Кв.';

	$fields['billing']['billing_phone']['class'] = array( 'form-row-last' );

	$fields['billing']['billing_last_name']['class'] = array( 'form-row' );

	return $fields;
}




add_filter( 'woocommerce_checkout_fields', 'custom_move_checkout_fields' );
function custom_move_checkout_fields( $fields ) {
	// Lets display the email first. You can move these around depending on your needs.
	$billing_order = array(
		"billing_first_name",
		"billing_phone",
		"billing_last_name",
		"billing_email",
		"billing_city",
		"shipping_date",
		"payment_method",
		"billing_street",
		"billing_house",
		"billing_address_2",

	);

	// This makes sure above orders are maintained.
	foreach($billing_order as $billing_field) {
		$billing_fields[$billing_field] = $fields["billing"][$billing_field];
	}

	$fields["billing"] = $billing_fields;

	return $fields;
}

// Billing Fields.
//add_filter( 'woocommerce_checkout_fields' , 'custom_order_fields' );
/*function custom_order_fields( $fields ) {
	$fields['billing']['billing_first_name']['priority'] = 1;
	$fields['billing']['billing_phone']['priority'] = 2;
	$fields['billing']['billing_last_name']['priority'] = 3;
	$fields['billing']['billing_email']['priority'] = 4;
	$fields['billing']['billing_city']['priority'] = 5;
	$fields['billing']['billing_house']['priority'] = 6;
	$fields['billing']['billing_address_2']['priority'] = 7;
	/*$fields['billing_phone']['required'] = false;
	$fields['billing_phone']['maxlength'] = 10;
	$fields['billing_state']['class'] = array( 'form-row-first' );
	$fields['billing_postcode']['maxlength'] = 4;
	$fields['billing_postcode']['class'] = array( 'form-row-last' );
	//Order Billing fields
	$fields['billing_email']['priority'] = 33;
	$fields['billing_phone']['priority'] = 37;
	$fields['billing_country']['priority'] = 100;*/









	/*unset($fields['billing']['billing_phone']);
	unset($fields['order']['order_comments']);
	unset($fields['billing']['billing_address_2']);

	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_email']);
	unset($fields['billing']['billing_city']);

	return $fields;
}*/

/*remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'woocommerce_checkout_fields', 'woocommerce_checkout_payment', 20 );*/





/* ==============================================================================================
========================================== checkout Page End ====================================
================================================================================================*/

function new_post_shipping_method( $methods ) {
	$methods['new_post'] = 'Новая Почта';

	return $methods;
}

add_filter( 'woocommerce_shipping_methods', 'new_post_shipping_method' );


add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments){
	ob_start();
	?>
		<div class="headerTop__cart">
										<?php global $woocommerce; ?>
										<div class="headerTop__cartQtyWrap">
											<img class="headerTop__cartQtyImg" src="<?php bloginfo('template_directory') ?>/images/myicons/cart.png" alt="Cart Icon">
											<span class="headerTop__cartQty"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
										</div>
										<div class="headerTop__cartTotalWrap">
											<span class="headerTop__cartTotalInner">
												<span class="headerTop__cartTotalDivider">&ndash;</span>
												<a class="headerTop__cartTotalLink" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
													<span class="headerTop__cartTotal">
														<?php echo $woocommerce->cart->cart_contents_total; ?>
													</span>
													<span class="headerTop__cartTotalCurrency">
														<?php echo get_woocommerce_currency_symbol(); ?>
													</span>
												</a>
											</span>
										</div>
									</div>
	<?php
	$fragments['.headerTop__cart'] = ob_get_clean();	
	return $fragments;
}








