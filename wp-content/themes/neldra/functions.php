<?php
/**
 * Neldra theme setup, assets and integrations.
 *
 * @package Neldra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NELDRA_VERSION', '0.5.0' );
define( 'NELDRA_DIR', get_template_directory() );
define( 'NELDRA_URI', get_template_directory_uri() );

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

	wp_enqueue_style( 'neldra', $css, array(), NELDRA_VERSION );

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
	$contract = function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/contract/' );
	printf(
		'<a class="btn" style="margin-top:1rem" href="%s">%s</a>',
		esc_url( home_url( '/contract/' ) ),
		esc_html__( 'For projects · Request a project quote', 'neldra' )
	);
}

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
