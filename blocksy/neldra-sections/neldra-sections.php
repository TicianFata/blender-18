<?php
/**
 * Plugin Name: Neldra Sections
 * Description: Drop-in editorial sections for any theme (built for Blocksy) — the two-sided animated hero and the collections hover split, plus parallax, scroll reveals and self-hosted fonts. Use the [neldra_hero] and [neldra_collections] shortcodes (or Shortcode blocks).
 * Version: 1.0.0
 * Author: Neldra
 * License: GPL-2.0-or-later
 * Text Domain: neldra-sections
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NELDRA_SEC_URL', plugin_dir_url( __FILE__ ) );
define( 'NELDRA_SEC_VER', '1.0.0' );

/** Register + enqueue front-end assets. */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'neldra-sections', NELDRA_SEC_URL . 'assets/sections.css', array(), NELDRA_SEC_VER );
	wp_enqueue_script( 'neldra-sections', NELDRA_SEC_URL . 'assets/sections.js', array(), NELDRA_SEC_VER, true );
} );

/** Small helper: default image URL bundled with the plugin. */
function neldra_sec_img( $file ) {
	return NELDRA_SEC_URL . 'assets/img/' . $file;
}

/**
 * [neldra_hero] — the two-sided animated hero.
 */
add_shortcode( 'neldra_hero', function ( $atts ) {
	$a = shortcode_atts( array(
		'shop_label'     => 'The Collection',
		'shop_title'     => 'Shop',
		'shop_text'      => 'Thirty finished pieces across three collections. Made to order, bought online.',
		'shop_cta'       => 'Enter the shop',
		'shop_link'      => home_url( '/shop/' ),
		'shop_img'       => neldra_sec_img( 'n01-angle.jpg' ),
		'contract_label' => 'Neldra Contract',
		'contract_title' => 'Contract',
		'contract_text'  => 'Furniture for projects, at scale — supplied, modified or developed from scratch.',
		'contract_cta'   => 'Start a project',
		'contract_link'  => home_url( '/contract/' ),
		'contract_img'   => neldra_sec_img( 'interior.svg' ),
		'scroll'         => 'Scroll',
	), $atts, 'neldra_hero' );

	ob_start(); ?>
	<div class="neldra">
		<section class="nl-hero" data-hero aria-label="<?php esc_attr_e( 'Choose a side', 'neldra-sections' ); ?>">
			<a class="nl-panel nl-panel--shop" data-panel="shop" href="<?php echo esc_url( $a['shop_link'] ); ?>">
				<div class="nl-panel__media"><div class="nl-ph nl-ph--shop"></div><img src="<?php echo esc_url( $a['shop_img'] ); ?>" alt="<?php echo esc_attr( $a['shop_title'] ); ?>" style="position:absolute;left:50%;top:50%;width:84%;transform:translate(-50%,-50%);object-fit:contain"></div>
				<div class="nl-panel__label">
					<span class="nl-meta"><?php echo esc_html( $a['shop_label'] ); ?></span>
					<span class="nl-panel__title"><?php echo esc_html( $a['shop_title'] ); ?></span>
					<span class="nl-panel__intro"><?php echo esc_html( $a['shop_text'] ); ?></span>
					<span class="nl-panel__enter"><?php echo esc_html( $a['shop_cta'] ); ?> <i class="nl-arrow"></i></span>
				</div>
			</a>
			<a class="nl-panel nl-panel--contract" data-panel="contract" href="<?php echo esc_url( $a['contract_link'] ); ?>">
				<div class="nl-panel__media"><div class="nl-ph nl-ph--contract"></div><img src="<?php echo esc_url( $a['contract_img'] ); ?>" alt="<?php echo esc_attr( $a['contract_title'] ); ?>" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.9"></div>
				<div class="nl-panel__label">
					<span class="nl-meta"><?php echo esc_html( $a['contract_label'] ); ?></span>
					<span class="nl-panel__title"><?php echo esc_html( $a['contract_title'] ); ?></span>
					<span class="nl-panel__intro"><?php echo esc_html( $a['contract_text'] ); ?></span>
					<span class="nl-panel__enter"><?php echo esc_html( $a['contract_cta'] ); ?> <i class="nl-arrow"></i></span>
				</div>
			</a>
			<div class="nl-scroll" aria-hidden="true"><span><?php echo esc_html( $a['scroll'] ); ?></span><i></i></div>
		</section>
	</div>
	<?php
	return ob_get_clean();
} );

/**
 * [neldra_collections] — 3-panel hover-expand split.
 */
add_shortcode( 'neldra_collections', function ( $atts ) {
	$a = shortcode_atts( array(
		'eyebrow'  => 'Three collections · ten pieces each',
		'heading'  => 'Collections',
		'p1_label' => 'Collection 01', 'p1_meta' => '10 pieces', 'p1_img' => neldra_sec_img( 'n01-detail-1.jpg' ), 'p1_link' => home_url( '/shop/' ),
		'p2_label' => 'Collection 02', 'p2_meta' => '10 pieces', 'p2_img' => neldra_sec_img( 'n01-detail-4.jpg' ), 'p2_link' => home_url( '/shop/' ),
		'p3_label' => 'Collection 03', 'p3_meta' => '10 pieces', 'p3_img' => neldra_sec_img( 'n01-detail-2.jpg' ), 'p3_link' => home_url( '/shop/' ),
	), $atts, 'neldra_collections' );

	ob_start(); ?>
	<div class="neldra">
		<div class="nl-cols-head" data-reveal>
			<span class="nl-meta"><?php echo esc_html( $a['eyebrow'] ); ?></span>
			<h2><?php echo esc_html( $a['heading'] ); ?></h2>
		</div>
		<div class="nl-cols" data-reveal>
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<a class="nl-cpanel" href="<?php echo esc_url( $a[ "p{$i}_link" ] ); ?>">
					<div class="nl-cpanel__media"><img src="<?php echo esc_url( $a[ "p{$i}_img" ] ); ?>" alt="<?php echo esc_attr( $a[ "p{$i}_label" ] ); ?>"></div>
					<div class="nl-cpanel__label"><span class="nl-cpanel__name"><?php echo esc_html( $a[ "p{$i}_label" ] ); ?></span><span class="nl-meta"><?php echo esc_html( $a[ "p{$i}_meta" ] ); ?></span></div>
				</a>
			<?php endfor; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
} );
