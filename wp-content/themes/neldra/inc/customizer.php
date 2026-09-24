<?php
/**
 * Neldra Customizer — makes all site copy + placeholder images editable from
 * Appearance → Customize, with no external plugins.
 *
 * Single source of truth: neldra_customizer_config(). Both the Customizer
 * registration AND the templates (via neldra_mod()) read the same defaults,
 * so keys can never drift apart.
 *
 * @package Neldra
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The full content model: panels → sections → fields.
 * field types: text | textarea | url | image
 * Image defaults are full asset URLs so an unedited site shows the placeholders.
 */
function neldra_customizer_config() {
	static $cfg = null;
	if ( null !== $cfg ) {
		return $cfg;
	}
	$img = NELDRA_URI . '/assets/img';
	$prod = $img . '/products';

	$cfg = array(

		/* ============ HOMEPAGE ============ */
		'neldra_home' => array(
			'label'    => __( 'Homepage', 'neldra' ),
			'sections' => array(

				'hero_shop' => array( 'label' => __( 'Hero — Shop side', 'neldra' ), 'fields' => array(
					'hs_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'The Collection' ),
					'hs_title'   => array( 'type' => 'text', 'label' => 'Title', 'default' => 'Shop' ),
					'hs_intro'   => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'Thirty finished pieces across three collections. Made to order, bought online.' ),
					'hs_cta'     => array( 'type' => 'text', 'label' => 'CTA label', 'default' => 'Enter the shop' ),
					'hs_image'   => array( 'type' => 'image', 'label' => 'Image', 'default' => $prod . '/n01-angle.jpg' ),
				) ),
				'hero_contract' => array( 'label' => __( 'Hero — Contract side', 'neldra' ), 'fields' => array(
					'hc_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Neldra Contract' ),
					'hc_title'   => array( 'type' => 'text', 'label' => 'Title', 'default' => 'Contract' ),
					'hc_intro'   => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'Furniture for projects, at scale — supplied, modified or developed from scratch.' ),
					'hc_cta'     => array( 'type' => 'text', 'label' => 'CTA label', 'default' => 'Start a project' ),
					'hc_image'   => array( 'type' => 'image', 'label' => 'Image', 'default' => $img . '/interior.svg' ),
				) ),
				'statement' => array( 'label' => __( 'Brand statement', 'neldra' ), 'fields' => array(
					'st_line1' => array( 'type' => 'text', 'label' => 'Title line 1', 'default' => 'A furniture design' ),
					'st_line2' => array( 'type' => 'text', 'label' => 'Title line 2', 'default' => '& production studio' ),
					'st_lead'  => array( 'type' => 'textarea', 'label' => 'Lead paragraph', 'default' => 'Neldra designs, develops and produces furniture — a direct-to-consumer collection and a project-based Contract division, held together by one quiet, architectural language.' ),
				) ),
				'featured' => array( 'label' => __( 'Featured pieces', 'neldra' ), 'fields' => array(
					'ft_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Selected' ),
					'ft_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Featured pieces' ),
					'ft_link'    => array( 'type' => 'text', 'label' => 'Link label', 'default' => 'View all 30' ),
				) ),
				'collections' => array( 'label' => __( 'Collections split', 'neldra' ), 'fields' => array(
					'col_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Three collections · ten pieces each' ),
					'col_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Collections' ),
					'col1_label' => array( 'type' => 'text', 'label' => 'Panel 1 — label', 'default' => 'Collection 01' ),
					'col1_meta'  => array( 'type' => 'text', 'label' => 'Panel 1 — meta', 'default' => '10 pieces' ),
					'col1_image' => array( 'type' => 'image', 'label' => 'Panel 1 — image', 'default' => $prod . '/n01-detail-1.jpg' ),
					'col2_label' => array( 'type' => 'text', 'label' => 'Panel 2 — label', 'default' => 'Collection 02' ),
					'col2_meta'  => array( 'type' => 'text', 'label' => 'Panel 2 — meta', 'default' => '10 pieces' ),
					'col2_image' => array( 'type' => 'image', 'label' => 'Panel 2 — image', 'default' => $prod . '/n01-detail-4.jpg' ),
					'col3_label' => array( 'type' => 'text', 'label' => 'Panel 3 — label', 'default' => 'Collection 03' ),
					'col3_meta'  => array( 'type' => 'text', 'label' => 'Panel 3 — meta', 'default' => '10 pieces' ),
					'col3_image' => array( 'type' => 'image', 'label' => 'Panel 3 — image', 'default' => $prod . '/n01-detail-2.jpg' ),
				) ),
				'contract_teaser' => array( 'label' => __( 'Contract teaser', 'neldra' ), 'fields' => array(
					'ct_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Neldra Contract' ),
					'ct_title1'  => array( 'type' => 'text', 'label' => 'Title line 1', 'default' => 'Furniture for' ),
					'ct_title2'  => array( 'type' => 'text', 'label' => 'Title line 2', 'default' => 'projects, at scale' ),
					'ct_lead'    => array( 'type' => 'textarea', 'label' => 'Lead', 'default' => 'For architects, hotels, restaurants, offices and developers. Supply existing pieces in quantity, modify a design, or develop entirely new furniture and collections.' ),
					'ct_cta'     => array( 'type' => 'text', 'label' => 'Button label', 'default' => 'Start a project' ),
					'ct_image'   => array( 'type' => 'image', 'label' => 'Background image', 'default' => $img . '/interior.svg' ),
				) ),
				'projects_teaser' => array( 'label' => __( 'Projects teaser', 'neldra' ), 'fields' => array(
					'pt_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Evidence of execution' ),
					'pt_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Selected projects' ),
					'pt_link'    => array( 'type' => 'text', 'label' => 'Link label', 'default' => 'All projects' ),
				) ),
				'newsletter' => array( 'label' => __( 'Newsletter', 'neldra' ), 'fields' => array(
					'nl_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Be the First to Know' ),
					'nl_sub'     => array( 'type' => 'text', 'label' => 'Subtitle', 'default' => '…about new collections and special offers.' ),
				) ),
			),
		),

		/* ============ CONTRACT PAGE ============ */
		'neldra_contract' => array(
			'label'    => __( 'Contract page', 'neldra' ),
			'sections' => array(
				'cp_hero' => array( 'label' => __( 'Hero', 'neldra' ), 'fields' => array(
					'cph_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Neldra Contract' ),
					'cph_title1'  => array( 'type' => 'text', 'label' => 'Title line 1', 'default' => 'Furniture for projects,' ),
					'cph_title2'  => array( 'type' => 'text', 'label' => 'Title line 2', 'default' => 'at scale' ),
					'cph_intro'   => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'For architecture, hospitality, hotels, restaurants, offices, residential, retail and developers.' ),
					'cph_cta'     => array( 'type' => 'text', 'label' => 'CTA label', 'default' => 'Start a project' ),
					'cph_image'   => array( 'type' => 'image', 'label' => 'Hero image', 'default' => $img . '/interior.svg' ),
				) ),
				'cp_cap' => array( 'label' => __( 'What Neldra can do', 'neldra' ), 'fields' => array(
					'cap_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'What Neldra can do' ),
					'cap_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'From one piece to a whole project' ),
					'cap1_t' => array( 'type' => 'text', 'label' => 'Row 1 title', 'default' => 'Standard products' ),
					'cap1_n' => array( 'type' => 'text', 'label' => 'Row 1 note', 'default' => 'Existing Neldra pieces supplied in project quantity.' ),
					'cap2_t' => array( 'type' => 'text', 'label' => 'Row 2 title', 'default' => 'Modified products' ),
					'cap2_n' => array( 'type' => 'text', 'label' => 'Row 2 note', 'default' => 'An existing design adapted to project requirements.' ),
					'cap3_t' => array( 'type' => 'text', 'label' => 'Row 3 title', 'default' => 'Custom furniture' ),
					'cap3_n' => array( 'type' => 'text', 'label' => 'Row 3 note', 'default' => 'Entirely new furniture developed for the project.' ),
					'cap4_t' => array( 'type' => 'text', 'label' => 'Row 4 title', 'default' => 'Custom collections' ),
					'cap4_n' => array( 'type' => 'text', 'label' => 'Row 4 note', 'default' => 'Several coherent pieces designed together.' ),
					'cap5_t' => array( 'type' => 'text', 'label' => 'Row 5 title', 'default' => 'Large-scale production' ),
					'cap5_n' => array( 'type' => 'text', 'label' => 'Row 5 note', 'default' => 'Dozens to hundreds of consistent units.' ),
					'cap6_t' => array( 'type' => 'text', 'label' => 'Row 6 title', 'default' => 'Project delivery' ),
					'cap6_n' => array( 'type' => 'text', 'label' => 'Row 6 note', 'default' => 'Production, logistics & installation where included.' ),
				) ),
				'cp_levels' => array( 'label' => __( 'Service levels', 'neldra' ), 'fields' => array(
					'sl_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Three service levels' ),
					'sl_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'How we work' ),
					'sl1_k' => array( 'type' => 'text', 'label' => 'Level 1 kicker', 'default' => 'Level 01' ),
					'sl1_t' => array( 'type' => 'text', 'label' => 'Level 1 title', 'default' => 'Standard' ),
					'sl1_d' => array( 'type' => 'textarea', 'label' => 'Level 1 desc', 'default' => 'An existing piece in quantity — quotation, schedule, logistics, coordination.' ),
					'sl2_k' => array( 'type' => 'text', 'label' => 'Level 2 kicker', 'default' => 'Level 02' ),
					'sl2_t' => array( 'type' => 'text', 'label' => 'Level 2 title', 'default' => 'Modified' ),
					'sl2_d' => array( 'type' => 'textarea', 'label' => 'Level 2 desc', 'default' => 'A design adapted to the project after a feasibility assessment.' ),
					'sl3_k' => array( 'type' => 'text', 'label' => 'Level 3 kicker', 'default' => 'Level 03' ),
					'sl3_t' => array( 'type' => 'text', 'label' => 'Level 3 title', 'default' => 'Custom' ),
					'sl3_d' => array( 'type' => 'textarea', 'label' => 'Level 3 desc', 'default' => 'Concept → 3D → engineering → prototype → approval → production.' ),
				) ),
				'cp_process' => array( 'label' => __( 'Process', 'neldra' ), 'fields' => array(
					'pr_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'The custom process' ),
					'pr_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'From brief to installation' ),
					'pr1' => array( 'type' => 'text', 'label' => 'Step 1', 'default' => 'Brief' ),
					'pr1n' => array( 'type' => 'text', 'label' => 'Step 1 note', 'default' => 'Understand the project.' ),
					'pr2' => array( 'type' => 'text', 'label' => 'Step 2', 'default' => 'Design direction' ),
					'pr2n' => array( 'type' => 'text', 'label' => 'Step 2 note', 'default' => 'Aesthetic, proportions, materials, function.' ),
					'pr3' => array( 'type' => 'text', 'label' => 'Step 3', 'default' => 'Concept & 3D' ),
					'pr3n' => array( 'type' => 'text', 'label' => 'Step 3 note', 'default' => 'Initial concepts and detailed models.' ),
					'pr4' => array( 'type' => 'text', 'label' => 'Step 4', 'default' => 'Technical & quote' ),
					'pr4n' => array( 'type' => 'text', 'label' => 'Step 4 note', 'default' => 'Made manufacturable; project quotation.' ),
					'pr5' => array( 'type' => 'text', 'label' => 'Step 5', 'default' => 'Prototype & approval' ),
					'pr5n' => array( 'type' => 'text', 'label' => 'Step 5 note', 'default' => 'A physical sample where required.' ),
					'pr6' => array( 'type' => 'text', 'label' => 'Step 6', 'default' => 'Production, QC & logistics' ),
					'pr6n' => array( 'type' => 'text', 'label' => 'Step 6 note', 'default' => 'Manufacture, inspect, deliver, install.' ),
				) ),
				'cp_form' => array( 'label' => __( 'Request form', 'neldra' ), 'fields' => array(
					'cf_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Start a project' ),
					'cf_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Tell us about your project' ),
				) ),
			),
		),

		/* ============ PROJECTS PAGE ============ */
		'neldra_projects' => array(
			'label'    => __( 'Projects page', 'neldra' ),
			'sections' => array(
				'pp_hero' => array( 'label' => __( 'Hero & categories', 'neldra' ), 'fields' => array(
					'ph_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'Selected work · Evidence of execution' ),
					'ph_title'   => array( 'type' => 'text', 'label' => 'Title', 'default' => 'Projects' ),
					'ph_intro'   => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'A record of what Neldra has designed, developed and delivered — from competition-winning pieces to large-scale production for hotels, restaurants and architecture.' ),
					'pc1_t' => array( 'type' => 'text', 'label' => 'Category 1', 'default' => 'Competition-winning designs' ),
					'pc1_c' => array( 'type' => 'text', 'label' => 'Category 1 count', 'default' => '08' ),
					'pc2_t' => array( 'type' => 'text', 'label' => 'Category 2', 'default' => 'Custom-made furniture' ),
					'pc2_c' => array( 'type' => 'text', 'label' => 'Category 2 count', 'default' => '24' ),
					'pc3_t' => array( 'type' => 'text', 'label' => 'Category 3', 'default' => 'Delivered & sold projects' ),
					'pc3_c' => array( 'type' => 'text', 'label' => 'Category 3 count', 'default' => '40+' ),
					'pc4_t' => array( 'type' => 'text', 'label' => 'Category 4', 'default' => 'Large-scale production' ),
					'pc4_c' => array( 'type' => 'text', 'label' => 'Category 4 count', 'default' => '12' ),
					'pc5_t' => array( 'type' => 'text', 'label' => 'Category 5', 'default' => 'Hospitality & architecture' ),
					'pc5_c' => array( 'type' => 'text', 'label' => 'Category 5 count', 'default' => '18' ),
				) ),
				'pp_cta' => array( 'label' => __( 'Closing CTA', 'neldra' ), 'fields' => array(
					'pcta_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'Have a project?' ),
					'pcta_lead'    => array( 'type' => 'textarea', 'label' => 'Lead', 'default' => 'From a single competition piece to hundreds of units — Neldra can design, develop and produce it.' ),
					'pcta_btn'     => array( 'type' => 'text', 'label' => 'Button label', 'default' => 'Start a project' ),
				) ),
			),
		),

		/* ============ FOOTER ============ */
		'neldra_footer' => array(
			'label'    => __( 'Footer', 'neldra' ),
			'sections' => array(
				'footer' => array( 'label' => __( 'Footer', 'neldra' ), 'fields' => array(
					'fo_tagline' => array( 'type' => 'textarea', 'label' => 'Tagline', 'default' => 'Furniture design & production. Made to order. Delivered worldwide.' ),
				) ),
			),
		),
	);

	/* ---- Appearance: colors + layout ---- */
	$cfg['neldra_appearance'] = array(
		'label'    => __( 'Appearance & colors', 'neldra' ),
		'sections' => array(
			'colors' => array( 'label' => __( 'Colors', 'neldra' ), 'fields' => neldra_color_fields() ),
			'layout' => array( 'label' => __( 'Layout & spacing', 'neldra' ), 'fields' => array(
				'layout_width'   => array( 'type' => 'number', 'label' => 'Content max width (px)', 'default' => 1600, 'input_attrs' => array( 'min' => 1000, 'max' => 2200, 'step' => 20 ) ),
				'layout_spacing' => array( 'type' => 'select', 'label' => 'Section spacing (vertical rhythm)', 'default' => 'default', 'choices' => array( 'compact' => 'Compact', 'default' => 'Default', 'spacious' => 'Spacious' ) ),
			) ),
		),
	);

	/* ---- Shop page ---- */
	$cfg['neldra_shop'] = array(
		'label'    => __( 'Shop page', 'neldra' ),
		'sections' => array(
			'shop' => array( 'label' => __( 'Shop header & grid', 'neldra' ), 'fields' => array(
				'sh_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'The Collection' ),
				'sh_title'   => array( 'type' => 'text', 'label' => 'Title', 'default' => 'Shop' ),
				'sh_lead'    => array( 'type' => 'textarea', 'label' => 'Intro', 'default' => 'Thirty finished pieces, produced specifically for each order. Set the density that suits how you like to browse.' ),
				'sh_columns' => array( 'type' => 'select', 'label' => 'Default columns', 'default' => '3', 'choices' => array( '2' => '2 columns', '3' => '3 columns', '4' => '4 columns', '5' => '5 columns' ) ),
				'sh_density' => array( 'type' => 'checkbox', 'label' => 'Show the density switch', 'default' => true ),
			) ),
		),
	);

	/* ---- Homepage: section order & visibility ---- */
	$place = array();
	$pos   = 1;
	foreach ( neldra_home_sections() as $id => $label ) {
		$place[ 'home_show_' . $id ]  = array( 'type' => 'checkbox', 'label' => sprintf( 'Show: %s', $label ), 'default' => true );
		$place[ 'home_order_' . $id ] = array( 'type' => 'number', 'label' => sprintf( 'Order: %s', $label ), 'default' => $pos * 10, 'input_attrs' => array( 'min' => 1, 'max' => 99, 'step' => 1 ) );
		$pos++;
	}
	$cfg['neldra_home']['sections']['placement'] = array( 'label' => __( 'Section order & visibility', 'neldra' ), 'fields' => $place );

	return $cfg;
}

/**
 * Reorderable / toggleable homepage sections (the hero is always first).
 */
function neldra_home_sections() {
	return array(
		'statement'       => __( 'Brand statement', 'neldra' ),
		'featured'        => __( 'Featured pieces', 'neldra' ),
		'collections'     => __( 'Collections split', 'neldra' ),
		'contract_teaser' => __( 'Contract teaser', 'neldra' ),
		'projects_teaser' => __( 'Projects teaser', 'neldra' ),
		'newsletter'      => __( 'Newsletter', 'neldra' ),
	);
}

/**
 * Editable colour palette → mapped to CSS variables (see neldra_inline_css).
 */
function neldra_color_fields() {
	return array(
		'color_bg'         => array( 'type' => 'color', 'label' => 'Background (white)', 'default' => '#FFFFFF' ),
		'color_bg_soft'    => array( 'type' => 'color', 'label' => 'Soft background', 'default' => '#F7F7F6' ),
		'color_grey_light' => array( 'type' => 'color', 'label' => 'Light grey (lines)', 'default' => '#E8E9EA' ),
		'color_grey_mid'   => array( 'type' => 'color', 'label' => 'Mid grey', 'default' => '#A5A7A9' ),
		'color_text'       => array( 'type' => 'color', 'label' => 'Text (charcoal)', 'default' => '#161616' ),
		'color_text_soft'  => array( 'type' => 'color', 'label' => 'Secondary text', 'default' => '#6B6C6E' ),
		'color_dark'       => array( 'type' => 'color', 'label' => 'Dark sections', 'default' => '#131313' ),
		'color_on_dark'    => array( 'type' => 'color', 'label' => 'Text on dark', 'default' => '#F4F4F3' ),
		'color_accent'     => array( 'type' => 'color', 'label' => 'Cold accent', 'default' => '#8A97A0' ),
	);
}

/** Sanitizers for the extra control types. */
function neldra_sanitize_checkbox( $v ) { return ( isset( $v ) && ( true === $v || '1' === $v || 1 === $v ) ) ? 1 : 0; }
function neldra_sanitize_number( $v ) { return is_numeric( $v ) ? $v + 0 : 0; }

/** Convert #rrggbb to "r, g, b". */
function neldra_hex_to_rgb( $hex ) {
	$hex = ltrim( (string) $hex, '#' );
	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( 6 !== strlen( $hex ) ) {
		return '22, 22, 22';
	}
	return hexdec( substr( $hex, 0, 2 ) ) . ', ' . hexdec( substr( $hex, 2, 2 ) ) . ', ' . hexdec( substr( $hex, 4, 2 ) );
}

/**
 * Output the editable colours + layout as CSS variables, right after the theme
 * stylesheet, so they override the defaults without changing the .css file.
 */
function neldra_inline_css() {
	$spacing_map = array(
		'compact'  => 'clamp(3.5rem, 8vw, 7rem)',
		'default'  => 'clamp(5rem, 12vw, 12rem)',
		'spacious' => 'clamp(7rem, 16vw, 16rem)',
	);
	$spacing = neldra_mod( 'layout_spacing' );
	$section_y = isset( $spacing_map[ $spacing ] ) ? $spacing_map[ $spacing ] : $spacing_map['default'];
	$width = (int) neldra_mod( 'layout_width' );
	$text  = neldra_mod( 'color_text' );
	$rgb   = neldra_hex_to_rgb( $text );

	$css  = ':root{';
	$css .= '--c-bg:' . esc_html( neldra_mod( 'color_bg' ) ) . ';';
	$css .= '--c-bg-soft:' . esc_html( neldra_mod( 'color_bg_soft' ) ) . ';';
	$css .= '--c-grey-light:' . esc_html( neldra_mod( 'color_grey_light' ) ) . ';';
	$css .= '--c-grey-mid:' . esc_html( neldra_mod( 'color_grey_mid' ) ) . ';';
	$css .= '--c-text:' . esc_html( $text ) . ';';
	$css .= '--c-text-soft:' . esc_html( neldra_mod( 'color_text_soft' ) ) . ';';
	$css .= '--c-dark:' . esc_html( neldra_mod( 'color_dark' ) ) . ';';
	$css .= '--c-on-dark:' . esc_html( neldra_mod( 'color_on_dark' ) ) . ';';
	$css .= '--c-accent:' . esc_html( neldra_mod( 'color_accent' ) ) . ';';
	$css .= '--c-line:rgba(' . $rgb . ',.10);';
	$css .= '--c-line-soft:rgba(' . $rgb . ',.06);';
	$css .= '--wrap:' . ( $width ? $width : 1600 ) . 'px;';
	$css .= '--section-y:' . $section_y . ';';
	$css .= '}';
	return $css;
}
add_action( 'wp_enqueue_scripts', function () {
	if ( wp_style_is( 'neldra', 'enqueued' ) ) {
		wp_add_inline_style( 'neldra', neldra_inline_css() );
	}
}, 20 );

/**
 * Flatten config to key => default for fast reads in templates.
 */
function neldra_defaults() {
	static $flat = null;
	if ( null !== $flat ) {
		return $flat;
	}
	$flat = array();
	foreach ( neldra_customizer_config() as $panel ) {
		foreach ( $panel['sections'] as $section ) {
			foreach ( $section['fields'] as $key => $field ) {
				$flat[ $key ] = $field['default'];
			}
		}
	}
	return $flat;
}

/**
 * Template helper: the saved Customizer value, or the built-in default.
 */
function neldra_mod( $key ) {
	$defaults = neldra_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( $key, $default );
}

/** Sanitizers */
function neldra_sanitize_textarea( $v ) { return sanitize_textarea_field( $v ); }

/**
 * Register everything in the Customizer.
 */
function neldra_customize_register( $wp_customize ) {
	foreach ( neldra_customizer_config() as $panel_id => $panel ) {
		$wp_customize->add_panel( $panel_id, array(
			'title'    => $panel['label'],
			'priority' => 30,
		) );
		foreach ( $panel['sections'] as $section_id => $section ) {
			$full_section = $panel_id . '_' . $section_id;
			$wp_customize->add_section( $full_section, array(
				'title' => $section['label'],
				'panel' => $panel_id,
			) );
			foreach ( $section['fields'] as $key => $field ) {
				$type = $field['type'];
				switch ( $type ) {
					case 'textarea': $sanitize = 'neldra_sanitize_textarea'; break;
					case 'url':
					case 'image':   $sanitize = 'esc_url_raw'; break;
					case 'color':   $sanitize = 'sanitize_hex_color'; break;
					case 'checkbox':$sanitize = 'neldra_sanitize_checkbox'; break;
					case 'number':
					case 'range':   $sanitize = 'neldra_sanitize_number'; break;
					default:        $sanitize = 'sanitize_text_field';
				}

				$wp_customize->add_setting( $key, array(
					'default'           => $field['default'],
					'sanitize_callback' => $sanitize,
					'transport'         => 'refresh',
				) );

				if ( 'image' === $type ) {
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $key, array(
						'label'    => $field['label'],
						'section'  => $full_section,
						'settings' => $key,
					) ) );
				} elseif ( 'color' === $type ) {
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
						'label'    => $field['label'],
						'section'  => $full_section,
						'settings' => $key,
					) ) );
				} else {
					$args = array(
						'label'   => $field['label'],
						'section' => $full_section,
						'type'    => 'text',
					);
					if ( 'textarea' === $type ) { $args['type'] = 'textarea'; }
					elseif ( 'url' === $type ) { $args['type'] = 'url'; }
					elseif ( 'checkbox' === $type ) { $args['type'] = 'checkbox'; }
					elseif ( 'select' === $type ) { $args['type'] = 'select'; $args['choices'] = $field['choices']; }
					elseif ( 'number' === $type ) { $args['type'] = 'number'; }
					elseif ( 'range' === $type ) { $args['type'] = 'range'; }
					if ( isset( $field['input_attrs'] ) ) { $args['input_attrs'] = $field['input_attrs']; }
					if ( isset( $field['description'] ) ) { $args['description'] = $field['description']; }
					$wp_customize->add_control( $key, $args );
				}
			}
		}
	}
}
add_action( 'customize_register', 'neldra_customize_register' );
