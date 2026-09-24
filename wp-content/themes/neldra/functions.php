<?php
/**
 * Neldra theme setup, assets and integrations.
 *
 * @package Neldra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NELDRA_VERSION', '1.0.0' );
define( 'NELDRA_DIR', get_template_directory() );
define( 'NELDRA_URI', get_template_directory_uri() );

// Customizer: makes all site copy + placeholder images editable in wp-admin.
require_once NELDRA_DIR . '/inc/customizer.php';

/**
 * Theme supports, menus, i18n (EN/HU).
 */
function neldra_setup() {
	load_theme_textdomain( 'neldra', NELDRA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'neldra' ),
		'footer'  => __( 'Footer Navigation', 'neldra' ),
	) );

	// Editorial image sizes.
	add_image_size( 'neldra-hero', 2400, 1600, true );
	add_image_size( 'neldra-editorial', 1800, 1125, true );
	add_image_size( 'neldra-product', 1000, 750, false ); // uncropped: preserves the float-on-white look.
}
add_action( 'after_setup_theme', 'neldra_setup' );

/**
 * Enqueue styles and scripts. Fonts are preloaded for fast first paint.
 */
function neldra_assets() {
	$css = NELDRA_URI . '/assets/css/neldra.css';
	$js  = NELDRA_URI . '/assets/js/neldra.js';

	// Load our stylesheet AFTER WooCommerce's, so our overrides win without !important.
	$deps = array();
	if ( class_exists( 'WooCommerce' ) ) {
		$deps = array( 'woocommerce-general', 'woocommerce-layout', 'woocommerce-smallscreen' );
	}
	wp_enqueue_style( 'neldra', $css, $deps, NELDRA_VERSION );

	wp_enqueue_script( 'neldra', $js, array(), NELDRA_VERSION, true );

	// Expose a few strings/settings to JS.
	wp_localize_script( 'neldra', 'NELDRA', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'home'    => esc_url( home_url( '/' ) ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'neldra_assets' );

/**
 * Preload the two critical fonts (display + body) in <head>.
 */
function neldra_preload_fonts() {
	$fonts = array( 'jost-latin.woff2', 'montserrat-latin.woff2' );
	// Prefer the licensed display font if it has been dropped in.
	if ( file_exists( NELDRA_DIR . '/assets/fonts/trt-cenzo-demo-light.woff2' ) ) {
		array_unshift( $fonts, 'trt-cenzo-demo-light.woff2' );
	}
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" as="font" type="font/woff2" href="%s" crossorigin>' . "\n",
			esc_url( NELDRA_URI . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'neldra_preload_fonts', 1 );

/**
 * Body classes to drive per-template styling (mirrors the prototype's data-page).
 */
function neldra_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'page-home';
	} elseif ( function_exists( 'is_product' ) && is_product() ) {
		$classes[] = 'page-product';
	} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$classes[] = 'page-shop';
	}
	return $classes;
}
add_filter( 'body_class', 'neldra_body_classes' );

/* -------------------------------------------------------------------------
 * WooCommerce presentation tweaks (quiet, editorial catalogue)
 * ---------------------------------------------------------------------- */

// Remove default WooCommerce wrappers; we provide our own in woocommerce.php.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'neldra_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'neldra_wc_wrapper_end', 10 );
function neldra_wc_wrapper_start() {
	echo '<main id="main" class="wrap" style="padding-top:var(--header-h)">';
}
function neldra_wc_wrapper_end() {
	echo '</main>';
}

// Products per page = 30 (the full collection) with generous spacing.
add_filter( 'loop_shop_per_page', function () {
	return 30;
} );

// "Made to order" badge in place of stock noise.
add_action( 'woocommerce_after_shop_loop_item_title', 'neldra_made_to_order_label', 5 );
function neldra_made_to_order_label() {
	echo '<span class="product__tag meta">' . esc_html__( 'Made to order', 'neldra' ) . '</span>';
}

// Secondary "For projects" CTA on the single product page.
add_action( 'woocommerce_after_add_to_cart_button', 'neldra_contract_cta' );
function neldra_contract_cta() {
	printf(
		'<a class="btn" style="margin-top:1rem" href="%s">%s</a>',
		esc_url( home_url( '/contract/' ) ),
		esc_html__( 'For projects · Request a project quote', 'neldra' )
	);
}

// Default column count for the shop grid (editable in Customize → Shop page).
function neldra_shop_columns() {
	$c = (int) neldra_mod( 'sh_columns' );
	return ( $c >= 2 && $c <= 5 ) ? $c : 3;
}

// Shop/collection loop wrapper -> our grid markup (enables the density switch).
add_filter( 'woocommerce_product_loop_start', function ( $html ) {
	return '<ul class="products grid grid--' . esc_attr( neldra_shop_columns() ) . '" data-grid>';
} );

// Hide WooCommerce's default page title — we render our own editable intro.
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Editable shop intro (eyebrow + title + lead), inside the products header.
add_action( 'woocommerce_archive_description', 'neldra_shop_intro', 20 );
function neldra_shop_intro() {
	if ( ! is_shop() && ! is_product_taxonomy() ) {
		return;
	}
	echo '<div class="shop-intro" data-reveal>';
	echo '<p class="meta">' . esc_html( neldra_mod( 'sh_eyebrow' ) ) . '</p>';
	echo '<h1 class="display upper">' . esc_html( neldra_mod( 'sh_title' ) ) . '</h1>';
	$lead = neldra_mod( 'sh_lead' );
	if ( $lead ) {
		echo '<p class="lead">' . esc_html( $lead ) . '</p>';
	}
	echo '</div>';
}

// Grid-density control (2/3/4/5) — toggleable, default from the Customizer.
add_action( 'woocommerce_before_shop_loop', 'neldra_grid_control', 25 );
function neldra_grid_control() {
	if ( ( ! is_shop() && ! is_product_taxonomy() ) || ! neldra_mod( 'sh_density' ) ) {
		return;
	}
	$active = neldra_shop_columns();
	echo '<div class="grid-control" data-grid-control style="margin-bottom:2.5rem">';
	echo '<span class="grid-control__label">' . esc_html__( 'Density', 'neldra' ) . '</span>';
	foreach ( array( 2, 3, 4, 5 ) as $n ) {
		printf( '<button data-cols="%1$d" aria-pressed="%2$s">%1$d</button>', $n, $n === $active ? 'true' : 'false' );
	}
	echo '</div>';
}

// Made-to-order line in the single product summary.
add_action( 'woocommerce_single_product_summary', 'neldra_single_made_to_order', 6 );
function neldra_single_made_to_order() {
	echo '<p class="meta" style="margin:.5rem 0 0">' . esc_html__( 'Collection · Made to order', 'neldra' ) . '</p>';
}

// Cleaner: drop WooCommerce's default result-count/sorting noise on the shop.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/* -------------------------------------------------------------------------
 * Projects portfolio (Contract case studies)
 * ---------------------------------------------------------------------- */
add_action( 'init', 'neldra_register_projects' );
function neldra_register_projects() {
	register_post_type( 'project', array(
		'labels'       => array(
			'name'          => __( 'Projects', 'neldra' ),
			'singular_name' => __( 'Project', 'neldra' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-building',
		'rewrite'      => array( 'slug' => 'projects' ),
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	register_taxonomy( 'sector', 'project', array(
		'labels'       => array(
			'name'          => __( 'Sectors', 'neldra' ),
			'singular_name' => __( 'Sector', 'neldra' ),
		),
		'public'       => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'sector' ),
	) );

	// Collection taxonomy on products (Collection 01/02/03).
	register_taxonomy( 'collection', 'product', array(
		'labels'       => array(
			'name'          => __( 'Collections', 'neldra' ),
			'singular_name' => __( 'Collection', 'neldra' ),
		),
		'public'       => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'collection' ),
	) );
}

/**
 * NOTE ON ACF: the extended product fields (Materials, Finishes, Dimensions,
 * Production, Care, Warranty, Technical docs) and Project fields (Location,
 * Year, Sector, Scope, Units) are provided via ACF field groups. Export the
 * ACF JSON into /acf-json when ACF Pro is installed. See docs/05-woocommerce-and-contract.md.
 */


/* -------------------------------------------------------------------------
 * First-run setup: auto-create pages, menu, front page, flush permalinks.
 * Runs once after the theme is activated so the site matches the design
 * without manual page creation.
 * ---------------------------------------------------------------------- */
add_action( 'after_switch_theme', function () {
	update_option( 'neldra_needs_setup', 1 );
} );

add_action( 'init', function () {
	if ( ! get_option( 'neldra_needs_setup' ) ) {
		return;
	}
	neldra_first_run();
	delete_option( 'neldra_needs_setup' );
	flush_rewrite_rules();
}, 99 );

/**
 * Create the pages, assign templates, set the front page, and build the menu.
 */
function neldra_first_run() {
	// --- Pages ---
	$home = neldra_ensure_page( 'home', __( 'Home', 'neldra' ) );
	$contract = neldra_ensure_page( 'contract', __( 'Contract', 'neldra' ) );
	if ( $contract ) {
		update_post_meta( $contract, '_wp_page_template', 'page-contract.php' );
	}
	neldra_ensure_page( 'about', __( 'About', 'neldra' ) );

	// --- Static front page ---
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
	}

	// --- Primary menu ---
	$menu_name = 'Neldra Main';
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) ) {
			$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
			$items = array(
				array( 'title' => __( 'Shop', 'neldra' ),        'url' => $shop_url ),
				array( 'title' => __( 'Collections', 'neldra' ), 'url' => $shop_url ),
				array( 'title' => __( 'Contract', 'neldra' ),    'url' => home_url( '/contract/' ) ),
				array( 'title' => __( 'Projects', 'neldra' ),    'url' => home_url( '/projects/' ) ),
				array( 'title' => __( 'About', 'neldra' ),       'url' => home_url( '/about/' ) ),
			);
			foreach ( $items as $it ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'  => $it['title'],
					'menu-item-url'    => $it['url'],
					'menu-item-status' => 'publish',
					'menu-item-type'   => 'custom',
				) );
			}
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}

/**
 * Create a published page by slug if it does not already exist. Returns its ID.
 */
function neldra_ensure_page( $slug, $title ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return $existing->ID;
	}
	return wp_insert_post( array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' => '',
	) );
}
