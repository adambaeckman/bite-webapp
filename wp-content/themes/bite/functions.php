<?php
/**
 * BITE Theme functions and definitions
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
 * @package Raccoon
 * @subpackage BITE_Theme
 * @since BITE Theme 1.0
 */


/**
 * BITE Theme only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'bitetheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/bitetheme
		 * If you're building a theme based on bitetheme, use a find and replace
		 * to change 'bitetheme' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'bitetheme' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', 'bitetheme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css' ) );
	}
endif; // bitetheme_setup
add_action( 'after_setup_theme', 'bitetheme_setup' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since BITE Theme 1.1
 */
function bitetheme_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'bitetheme_javascript_detection', 0 );


/* ---------------------------------------------------------------------------------------------------
---------------------------------- SCRIPT AND STYLE ENQUEUES -----------------------------------------
------------------------------------------------------------------------------------------------------ */

/**
 * Enqueue scripts and styles.
 *
 * @since BITE Theme 1.0
 */
function bitetheme_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'bitetheme-style', get_stylesheet_uri() );

	// Load CSS browser selector JS
	wp_enqueue_script( 'bitetheme-browser-selector', get_template_directory_uri() . '/js/vendor/css_browser_selector.js', array( 'jquery' ), '20160912', true );

	// Load our main JS functions after jQuery.
	wp_enqueue_script( 'bitetheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160815', true );

	// Template specific JS
	// ----------------------------------------------

    // Custom contact form enqueued first for every page that might need it
    // Default template, Contact template, Application template, Singular vacancy
    if ( basename(get_page_template()) === 'page.php' || is_page_template( 'template-contact.php' ) || is_page_template( 'template-application.php' ) || is_singular( 'vacancy' ) ) :
        // Vendor: jquery-textarea-autosize.js for autoresizing textareas
        wp_enqueue_script( 'bitetheme-textarea-autosize', get_template_directory_uri() . '/js/vendor/jquery-textarea-autosize.js', array( 'jquery' ), '20160913', true );

        // Custom CF7 script
        wp_enqueue_script( 'bitetheme-custom-cf7', get_template_directory_uri() . '/js/custom-cf7.js', array( 'jquery' ), '20160913', true );
    endif;

	// Projects
	if ( is_page_template( 'template-projects.php' ) ) :
		// Vendor: shuffle.js for mosaic layout/filtering
		wp_enqueue_script( 'bitetheme-shuffle', get_template_directory_uri() . '/js/vendor/jquery.shuffle.modernizr.min.js', array( 'jquery' ), '20160913', true );

		// Project template script
		wp_enqueue_script( 'bitetheme-projects-script', get_template_directory_uri() . '/js/projects.js', array( 'jquery' ), '20160913', true );
	endif;

	// Single project
	if ( is_singular( 'project' ) ) :
		// Single project template script
		wp_enqueue_script( 'bitetheme-single-project-script', get_template_directory_uri() . '/js/single-project.js', array( 'jquery' ), '20160913', true );
	endif;

	// Contact
	if ( is_page_template( 'template-contact.php' ) ) :
		// Google map with API key
		wp_enqueue_script( 'bitetheme-google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCdSQex136ccf7UMRKwvl-lL84cduMabDA', array( 'jquery' ), '20160913', true );

		// Contact template script
		wp_enqueue_script( 'bitetheme-contact-script', get_template_directory_uri() . '/js/contact.js', array( 'jquery' ), '20160913', true );

		// Localize contact script to be able to use template url
		wp_localize_script('bitetheme-contact-script', 'baseUrls', array( 'theme' => get_template_directory_uri() ));
	endif;

    // Vacancies
    if ( is_page_template( 'template-vacancies.php' ) ) :
        // Vendor: jQuery DataTables script
        wp_enqueue_script( 'bitetheme-datatables-script', get_template_directory_uri() . '/js/vendor/datatables.min.js', array( 'jquery' ), '20160913', true );

        // Vacancies template script
        wp_enqueue_script( 'bitetheme-vacancies', get_template_directory_uri() . '/js/vacancies.js', array( 'jquery' ), '20160913', true );
    endif;

}
add_action( 'wp_enqueue_scripts', 'bitetheme_scripts' );



/**
 * Enqueue login page scripts and styles.
 *
 * @since BITE Theme 1.0
 */
function bitetheme_login_enqueue_scripts(){
	wp_enqueue_style( 'login_style', get_template_directory_uri() . '/css/login-style.css', false, '1.0.0' );
}
add_action( 'login_enqueue_scripts', 'bitetheme_login_enqueue_scripts');



/**
 * Enqueue admin area scripts and styles.
 *
 * @since BITE Theme 1.0
 */
if ( is_admin() ) {
     function bitetheme_admin_enqueue_scripts() {
		wp_enqueue_style( 'admin_style', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'bitetheme_admin_enqueue_scripts' );
}



/* ---------------------------------------------------------------------------------------------------
----------------------------------- CUSTOM USER ROLE FOR BITE ----------------------------------------
------------------------------------------------------------------------------------------------------ */

/**
 * Create custom BITE Admin role and set up capabilities based on Editor
 *
 * @since BITE Theme 1.0
 */
if( !get_role('bite-admin') ) {
    function custom_role_bite_admin() {

        if( get_role('bite-admin') ){
            remove_role( 'bite-admin' );
        }

        $editor = get_role( 'editor' );
        $capabilities = $editor->capabilities;
        $biteAdmin = add_role( 'bite-admin', 'BITE Admin', $capabilities );
        $biteAdmin->add_cap( 'manage_options' );
        $biteAdmin->add_cap( 'edit_theme_options' );

    }

    custom_role_bite_admin();
}


/**
 * Remove admin menu items if BITE Admin
 *
 * @since BITE Theme 1.0
 */
if ( is_admin() && get_role('bite-admin') ) :

    if( current_user_can('bite-admin') ) {

        //Remove top level admin menus for BITE Admin
        function bitetheme_remove_menus_for_bite() {
            remove_menu_page('tools.php');
            remove_menu_page('edit.php?post_type=acf-field-group');
            remove_menu_page('aiowpsec');
        }
        add_action('admin_menu', 'bitetheme_remove_menus_for_bite');

        //Remove sub level admin menus for BITE Admin
        function bitetheme_remove_submenus_for_bite() {
            remove_submenu_page( 'options-general.php', 'options-general.php' );
            remove_submenu_page( 'options-general.php', 'options-writing.php' );
            remove_submenu_page( 'options-general.php', 'options-discussion.php' );
            remove_submenu_page( 'options-general.php', 'options-reading.php' );
            remove_submenu_page( 'options-general.php', 'options-discussion.php' );
            remove_submenu_page( 'options-general.php', 'options-media.php' );
            remove_submenu_page( 'options-general.php', 'options-privacy.php' );
            remove_submenu_page( 'options-general.php', 'options-permalink.php' );
        }
        add_action( 'admin_menu', 'bitetheme_remove_submenus_for_bite' );

    }

endif;


/* ---------------------------------------------------------------------------------------------------
--------------------------------------- ACF MODIFICATIONS --------------------------------------------
------------------------------------------------------------------------------------------------------ */

if( class_exists('acf') ) {

    /**
     * Google Map API key for ACF backend
     *
     * @since BITE Theme 1.0
     */
    function bitetheme_acf_init() {
    	acf_update_setting('google_api_key', 'AIzaSyCdSQex136ccf7UMRKwvl-lL84cduMabDA');
    }
    add_action('acf/init', 'bitetheme_acf_init');


    /**
     * Customize the ACF WYSIWYG field's toolbars
     *
     * @since BITE Theme 1.0
     *
     * Possible Toolbar Items:
     *
     * bold
     * italic
     * strikethrough
     * bullist
     * numlist
     * blockquote
     * hr
     * alignleft
     * aligncenter
     * alignright
     * link
     * unlink
     * wp_more
     * spellchecker
     * fullscreen
     * wp_adv
     * formatselect
     * underline
     * alignjustify
     * forecolor
     * pastetext
     * removeformat
     * charmap
     * outdent
     * indent
     * undo
     * redo
     * wp_help
     *
     */
    function bitetheme_acf_toolbars( $toolbars )
    {
    	// remove the 'Basic' toolbar completely
    	unset( $toolbars['Basic' ] );

    	// remove the 'Full' toolbar completely
    	unset( $toolbars['Full' ] );

    	// Add a new toolbar called "BITE Basic"
    	// - this toolbar has only link and unlink.
    	$toolbars['BITE Basic' ] = array();
    	$toolbars['BITE Basic' ][1] = array( 'link', 'unlink', 'bullist' );

    	// Add a new toolbar called "BITE Bold"
    	// - this toolbar has only bold.
    	$toolbars['BITE Bold' ] = array();
    	$toolbars['BITE Bold' ][1] = array( 'bold' );

    	// return $toolbars - IMPORTANT!
    	return $toolbars;
    }
    add_filter( 'acf/fields/wysiwyg/toolbars' , 'bitetheme_acf_toolbars'  );

}

/* ---------------------------------------------------------------------------------------------------
----------------------------------- CONTACT FORM 7 MODIFICATIONS -------------------------------------
------------------------------------------------------------------------------------------------------ */

if( class_exists('WPCF7') ) {

    /**
     * Add joblist to Contact Form 7
     *
     * Usage: [select lediga-jobb]
     *
     * @since BITE Theme 1.0
     */
    function bitetheme_add_job_list_to_contact_form ( $tag, $unused ) {

        // Only continue if it's specified as a vacancy select
        if ( $tag['name'] != 'lediga-jobb' )
            return $tag;

        if ( is_singular( 'vacancy' ) ) {

            // Set default option
            $tag['raw_values'][] = 'Välj jobb ansökan gäller*';
            $tag['values'][] = 'Välj jobb ansökan gäller*';
            $tag['labels'][] = 'Välj jobb ansökan gäller*';

            // If single vacancy, only show the current job as an option
            $tag['raw_values'][] = get_the_title();
            $tag['values'][] = get_the_title();
            $tag['labels'][] = get_the_title();

        }else{

            // Else get all vacancies
            $args = array(
                'posts_per_page'   => -1,
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
                'post_type'   => 'vacancy',
                'post_status' => 'publish'
            );
            $vacancies = get_posts( $args );

            if ( ! $vacancies )
                return $tag;

            // Set default option
            $tag['raw_values'][] = 'Välj jobb ansökan gäller';
            $tag['values'][] = 'Välj jobb ansökan gäller';
            $tag['labels'][] = 'Välj jobb ansökan gäller';

            // Set general application option
            $tag['raw_values'][] = 'Spontanansökan';
            $tag['values'][] = 'Spontanansökan';
            $tag['labels'][] = 'Spontanansökan';

            foreach ( $vacancies as $vacancy ) {
                $tag['raw_values'][] = $vacancy->post_title;
                $tag['values'][] = $vacancy->post_title;
                $tag['labels'][] = $vacancy->post_title;
            }

        }

        return $tag;
    }
    add_filter( 'wpcf7_form_tag', 'bitetheme_add_job_list_to_contact_form', 10, 2);

    /**
     * Dynamic List for Contact Form 7
     *
     * List any post type in a select
     *
     * Usage: [select name post-type:post_type_name]
     *
     * @since BITE Theme 1.0
     */

    /*
    function bitetheme_dynamic_select_list($tag, $unused){

        $options = (array)$tag['options'];

        foreach ($options as $option)
        if (preg_match('%^post-type:([-0-9a-zA-Z_]+)$%', $option, $matches))
            $postType = $matches[1];

        // Check if post-type is set
        if(!isset($postType))
            return $tag;

        // Get all posts from specified Post Type
        $args = array(
            'posts_per_page'   => -1,
            'orderby'     => 'menu_order',
            'order'       => 'ASC',
            'post_type'   => 'project',
            'post_status' => 'publish'
        );
        $posts = get_posts( $args );

        // Check if we have any posts
        if (!$posts)
            return $tag;

        // Get post type group name and make it lower case
        $postTypeName = strtolower($obj = get_post_type_object( $postType )->labels->singular_name);

        // Set default option
        $tag['raw_values'][] = 'Välj '.$postTypeName;
        $tag['values'][] = 'Välj '.$postTypeName;
        $tag['labels'][] = 'Välj '.$postTypeName;

        foreach ($posts as $post) {
            $tag['raw_values'][] = $post->post_title;
            $tag['values'][] = $post->post_title;
            $tag['labels'][] = $post->post_title;
        }

        return $tag;
    }
    add_filter( 'wpcf7_form_tag', 'bitetheme_dynamic_select_list', 10, 2);
    */

}

/* ---------------------------------------------------------------------------------------------------
--------------------------------------- CUSTOM IMAGE SIZES -------------------------------------------
------------------------------------------------------------------------------------------------------ */

/**
 * Add custom image sizes.
 *
 * @since BITE Theme 1.0
 *
 */

if (function_exists('add_image_size')) {
	add_action( 'after_setup_theme', 'bitetheme_custom_image_sizes' );
	function bitetheme_custom_image_sizes() {
		add_image_size( 'desktop-medium', 1200, 1000, false );
	    add_image_size( 'desktop-full', 1920, 1200, false );
	}
}

add_filter('image_size_names_choose', 'bitetheme_image_sizes_names');
function bitetheme_image_sizes_names($sizes) {
	$addsizes = array(
		"desktop-medium" => __("Desktop Medium"),
		"desktop-full" => __("Desktop Fullskärm")
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}


/* ---------------------------------------------------------------------------------------------------
----------------------------------------- CUSTOM POST TYPES ------------------------------------------
------------------------------------------------------------------------------------------------------ */

/**
 * Register Custom Post Types
 *
 * @since BITE Theme 1.0
 *
 */
function bitetheme_cpt_init() {

	// PROJECTS
	register_post_type('project',
		array(
		'labels' => array(
			'name' => 'Referensobjekt',
			'singular_name' => 'Referensobjekt',
			'add_new_item' => 'Skapa nytt referensobjekt',
			'edit_item' => 'Redigera referensobjekt',
			'new_item' => 'Nytt referensobjekt',
			'view_item' => 'Visa referensobjekt',
			'all_items' => 'Alla referensobjekt',
			'not_found' => 'Hittade inga referensobjekt',
			'not_found_in_trash' => 'Inga referensobjekt hittades i papperskorgen',
			'parent_item_colon' => 'Förälder',
		),
		'description' => 'Referensobjekt från BITE',
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'referensobjekt'),
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-book',
		'supports' => array('title', 'revisions'),
		'capability_type' => 'post'
	));

	// VACANCIES
	register_post_type('vacancy',
		array(
		'labels' => array(
			'name' => 'Lediga jobb',
			'singular_name' => 'Ledigt jobb',
			'add_new_item' => 'Skapa nytt ledigt jobb',
			'edit_item' => 'Redigera ledigt jobb',
			'new_item' => 'Nytt ledigt jobb',
			'view_item' => 'Visa ledigt jobb',
			'all_items' => 'Alla lediga jobb',
			'not_found' => 'Hittade inga lediga jobb',
			'not_found_in_trash' => 'Inga lediga jobb hittades i papperskorgen',
			'parent_item_colon' => 'Förälder',
		),
		'description' => 'Lediga jobb hos BITE',
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'vacancy'),
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-megaphone',
		'supports' => array('title', 'revisions'),
		'capability_type' => 'post'
	));

	// BOARD MEMBERS
	register_post_type('board-member',
		array(
		'labels' => array(
			'name' => 'Ledningsgrupp',
			'singular_name' => 'Gruppmedlem',
			'add_new_item' => 'Skapa ny gruppmedlem',
			'edit_item' => 'Redigera gruppmedlem',
			'new_item' => 'Ny gruppmedlem',
			'view_item' => 'Visa gruppmedlem',
			'all_items' => 'Alla gruppmedlemar',
			'not_found' => 'Hittade inga gruppmedlemar',
			'not_found_in_trash' => 'Inga gruppmedlemar hittades i papperskorgen',
			'parent_item_colon' => 'Förälder',
		),
		'description' => 'Ledningsgrupp hos BITE',
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'board-member'),
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-groups',
		'supports' => array('title', 'revisions'),
		'capability_type' => 'post'
	));

	// OFFICES
	register_post_type('office',
		array(
		'labels' => array(
			'name' => 'Kontor',
			'singular_name' => 'Kontor',
			'add_new_item' => 'Skapa nytt kontor',
			'edit_item' => 'Redigera kontor',
			'new_item' => 'Nytt kontor',
			'view_item' => 'Visa kontor',
			'all_items' => 'Alla kontor',
			'not_found' => 'Hittade inga kontor',
			'not_found_in_trash' => 'Inga kontor hittades i papperskorgen',
			'parent_item_colon' => 'Förälder',
		),
		'description' => 'Kontor hos BITE',
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'office'),
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-building',
		'supports' => array('title', 'revisions'),
		'capability_type' => 'post'
	));

	// CONTACT DETAILS
	register_post_type('contact-details',
		array(
		'labels' => array(
			'name' => 'Kontaktinfo',
			'singular_name' => 'Kontaktinformation',
			'add_new_item' => 'Skapa ny kontaktinformation',
			'edit_item' => 'Redigera kontaktinformation',
			'new_item' => 'Ny kontaktinformation',
			'view_item' => 'Visa kontaktinformation',
			'all_items' => 'All kontaktinformation',
			'not_found' => 'Hittade ingen kontaktinformation',
			'not_found_in_trash' => 'Ingen kontaktinformation hittades i papperskorgen',
			'parent_item_colon' => 'Förälder',
		),
		'description' => 'Kontaktinformation till BITE som används på sidan',
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'contact-details'),
		'hierarchical' => true,
		'menu_position' => 20,
		'menu_icon' => 'dashicons-phone',
		'supports' => array('title', 'revisions'),
		'capability_type' => 'post'
	));

}
add_action('init', 'bitetheme_cpt_init');


/**
 * Register Taxonomies for Custom Post Types.
 *
 * @since BITE Theme 1.0
 *
 */
function bitetheme_create_project_taxonomies() {

    // Create taxonomy Category for post type project
	$labels = array(
		'name'              => _x( 'Kategorier', 'taxonomy general name' ),
		'singular_name'     => _x( 'Kategori', 'taxonomy singular name' ),
		'search_items'      => __( 'Sök kategori' ),
		'all_items'         => __( 'Alla kategorier' ),
		'parent_item'       => __( 'Föräldrakategori' ),
		'parent_item_colon' => __( 'Föräldrakategori:' ),
		'edit_item'         => __( 'Editera kategori' ),
		'update_item'       => __( 'Uppdatera kategori' ),
		'add_new_item'      => __( 'Lägg till ny kategori' ),
		'new_item_name'     => __( 'Ny kategori' ),
		'menu_name'         => __( 'Kategorier' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'public'            => false,
		'rewrite'           => array( 'slug' => 'project-category' ),
	);
	register_taxonomy( 'project-category', array( 'project' ), $args );

    // Create taxonomy Job Type for post type vacancy
    $labels = array(
        'name'              => _x( 'Omfattning', 'taxonomy general name' ),
        'singular_name'     => _x( 'Omfattning', 'taxonomy singular name' ),
        'search_items'      => __( 'Sök omfattning' ),
        'all_items'         => __( 'Alla omfattningar' ),
        'parent_item'       => __( 'Förälder' ),
        'parent_item_colon' => __( 'Förälder:' ),
        'edit_item'         => __( 'Editera omfattning' ),
        'update_item'       => __( 'Uppdatera omfattning' ),
        'add_new_item'      => __( 'Lägg till ny omfattning' ),
        'new_item_name'     => __( 'Ny omfattning' ),
        'menu_name'         => __( 'Omfattningar' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array( 'slug' => 'job-type' ),
    );
    register_taxonomy( 'job-type', array( 'vacancy' ), $args );

    // Create taxonomy Job Location for post type vacancy
    $labels = array(
        'name'              => _x( 'Plats', 'taxonomy general name' ),
        'singular_name'     => _x( 'Plats', 'taxonomy singular name' ),
        'search_items'      => __( 'Sök plats' ),
        'all_items'         => __( 'Alla platser' ),
        'parent_item'       => __( 'Förälder' ),
        'parent_item_colon' => __( 'Förälder:' ),
        'edit_item'         => __( 'Editera plats' ),
        'update_item'       => __( 'Uppdatera plats' ),
        'add_new_item'      => __( 'Lägg till ny plats' ),
        'new_item_name'     => __( 'Ny plats' ),
        'menu_name'         => __( 'Platser' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => false,
        'rewrite'           => array( 'slug' => 'job-location' ),
    );
    register_taxonomy( 'job-location', array( 'vacancy' ), $args );



}
add_action( 'init', 'bitetheme_create_project_taxonomies', 0 );



/* ---------------------------------------------------------------------------------------------------
------------------------------------ WORDPRESS MODIFICATIONS -----------------------------------------
------------------------------------------------------------------------------------------------------ */

/**
 * Change the login logo URL and title
 *
 * @since BITE Theme 1.0
 */
function bitetheme_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'bitetheme_login_logo_url' );

function bitetheme_login_logo_url_title() {
    return 'BITE Mark & Anläggning AB';
}
add_filter( 'login_headertitle', 'bitetheme_login_logo_url_title' );


/**
 * Remove the admin bar
 *
 * @since BITE Theme 1.0
 */
add_filter('show_admin_bar', '__return_false');


/**
 * Rename '.page-template-template-name-php' to '.page-template-name'.
 *
 * @since BITE Theme 1.0
 */
function bitetheme_rename_template_body_class($classes) {
	foreach ($classes as $k => $v) {
		if (substr($v, 0, 22) == 'page-template-template') {
			$classes[$k] = 'page-'.substr($v, 14, -4);
		}
	}
	return $classes;
}
add_filter('body_class', 'bitetheme_rename_template_body_class');


/**
 * Disable the horrid Emojicons introduced in WP 4.2
 *
 * @since BITE Theme 1.0
 */
function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


/**
 * Close comments on the front-end
 *
 * @since BITE Theme 1.0
 */
function bitetheme_disable_comments_status()
{
	return false;
}
add_filter('comments_open', 'bitetheme_disable_comments_status', 20, 2);
add_filter('pings_open', 'bitetheme_disable_comments_status', 20, 2);



/* ---------------------------------------------------------------------------------------------------
-------------------------------------- ADMIN MODIFICATIONS -------------------------------------------
------------------------------------------------------------------------------------------------------ */

if ( is_admin() ) :

	/**
	 * Change admin footer
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_remove_footer_admin () {
		echo 'Created by <a href="http://www.raccoon.se" target="_blank">Raccoon</a> | Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';
	}
	add_filter('admin_footer_text', 'bitetheme_remove_footer_admin');


	/**
	 * Remove unwanted admin menu items
	 *
	 * @since BITE Theme 1.0
	 */
	// Remove Posts
	function bitetheme_remove_menu() {
		remove_menu_page('edit.php');
	}
	add_action('admin_menu', 'bitetheme_remove_menu');

	// Remove theme CSS editor
	function bitetheme_remove_menu_elements() {
		remove_submenu_page('themes.php', 'theme-editor.php');
	}
	add_action('admin_init', 'bitetheme_remove_menu_elements', 102);

	// Remove Customizer
	function bitetheme_remove_customize_page(){
		global $submenu;
		unset($submenu['themes.php'][6]); // remove customize link
	}
	add_action( 'admin_menu', 'bitetheme_remove_customize_page');


	/**
	 * Remove items from the WordPress Admin Bar
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_remove_admin_bar_content() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('comments');
	    $wp_admin_bar->remove_menu('new-content');
	    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
		$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
		$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
		$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
		$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	}
	add_action( 'wp_before_admin_bar_render', 'bitetheme_remove_admin_bar_content' );


	/**
	 * Remove welcome panel
	 *
	 * @since BITE Theme 1.0
	 */
	remove_action( 'welcome_panel', 'wp_welcome_panel' );


	/**
	 * Remove dashboard widgets
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_remove_dashboard_widgets() {
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	}
	add_action( 'wp_dashboard_setup', 'bitetheme_remove_dashboard_widgets' );


	/**
	 * Add custom dashboard widget
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_dashboard_widgets() {
	  wp_add_dashboard_widget('bitetheme_dashboard_welcome', 'Välkommen till BITE adminpanel', 'bitetheme_dashboard_welcome');
	}
	add_action('wp_dashboard_setup', 'bitetheme_dashboard_widgets' );

	if ( ! function_exists( 'bitetheme_dashboard_welcome' ) ) {
		function bitetheme_dashboard_welcome() {
			echo '<div class="dashboard-welcome-logo"></div>';
			echo '<div class="dashboard-welcome-text"></div>';
		}
	}


	/**
	 * Remove horrid feature that places checked categories on top.
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_checklist_args( $args ) {

		$args['checked_ontop'] = false;
		return $args;
	}
	add_filter( 'wp_terms_checklist_args', 'bitetheme_checklist_args' );


	/**
	 * Rename Subscriber to Member
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_change_role_name() {
		global $wp_roles;
		if ( ! isset( $wp_roles ) )
			$wp_roles = new WP_Roles();
			$wp_roles->roles['subscriber']['name'] = 'Medlem';
			$wp_roles->role_names['subscriber'] = 'Medlem';
	}
	add_action('init', 'bitetheme_change_role_name');


	/**
	 * Flush Rewrite on Activation
	 *
	 * @since BITE Theme 1.0
	 */
	function bitetheme_rewrite_flush()
	{
		bitetheme_cpt_init();
		flush_rewrite_rules();
	}
	add_action('after_switch_theme', 'bitetheme_rewrite_flush');


	/**
	 * Disable comments completely
	 *
	 * @since BITE Theme 1.0
	 */
	// Disable support for comments and trackbacks in post types
	function bitetheme_disable_comments_post_types_support()
	{
		$post_types = get_post_types();
		foreach ($post_types as $post_type) {
			if (post_type_supports($post_type, 'comments')) {
				remove_post_type_support($post_type, 'comments');
				remove_post_type_support($post_type, 'trackbacks');
			}
		}
	}
	add_action('admin_init',
		'bitetheme_disable_comments_post_types_support');

	// Hide existing comments
	function bitetheme_disable_comments_hide_existing_comments($comments)
	{
		$comments = array();
		return $comments;
	}
	add_filter('comments_array',
		'bitetheme_disable_comments_hide_existing_comments', 10, 2);

	// Remove comments page in menu
	function bitetheme_disable_comments_admin_menu()
	{
		remove_menu_page('edit-comments.php');
	}
	add_action('admin_menu', 'bitetheme_disable_comments_admin_menu');

	// Redirect any user trying to access comments page
	function bitetheme_disable_comments_admin_menu_redirect()
	{
		global $pagenow;
		if ($pagenow === 'edit-comments.php') {
			wp_redirect(admin_url());
			exit;
		}
	}
	add_action('admin_init',
		'bitetheme_disable_comments_admin_menu_redirect');

	// Remove comments metabox from dashboard
	function bitetheme_disable_comments_dashboard()
	{
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	}
	add_action('admin_init', 'bitetheme_disable_comments_dashboard');

	// Remove comments links from admin bar
	function bitetheme_disable_comments_admin_bar()
	{
		if (is_admin_bar_showing()) {
			remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
		}
	}
	add_action('init', 'bitetheme_disable_comments_admin_bar');

endif;

