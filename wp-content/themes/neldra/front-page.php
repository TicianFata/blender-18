<?php
/**
 * Front page — split-screen hero + reorderable editorial sections.
 * Copy, images, colours, spacing, section order & visibility are all editable
 * in Appearance → Customize.
 *
 * @package Neldra
 */
get_header();
?>
<main id="main">
	<?php
	neldra_home_hero();

	// Render the toggleable sections in the order set in the Customizer.
	$map = array(
		'statement'       => 'neldra_home_statement',
		'featured'        => 'neldra_home_featured',
		'collections'     => 'neldra_home_collections',
		'contract_teaser' => 'neldra_home_contract_teaser',
		'projects_teaser' => 'neldra_home_projects_teaser',
		'newsletter'      => 'neldra_home_newsletter',
	);
	$ordered = array();
	foreach ( $map as $id => $cb ) {
		if ( neldra_mod( 'home_show_' . $id ) ) {
			$ordered[ $id ] = (int) neldra_mod( 'home_order_' . $id );
		}
	}
	asort( $ordered );
	foreach ( array_keys( $ordered ) as $id ) {
		call_user_func( $map[ $id ] );
	}
	?>
</main>
<?php
get_footer();

/* ---------------------------------------------------------------------------
 * Homepage section partials
 * ------------------------------------------------------------------------- */

function neldra_home_hero() {
	$shop_url     = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	$contract_url = home_url( '/contract/' );
	?>
	<section class="hero" data-hero aria-label="<?php esc_attr_e( 'Choose Shop or Contract', 'neldra' ); ?>">
		<a class="panel panel--shop" data-panel="shop" href="<?php echo esc_url( $shop_url ); ?>" style="background:<?php echo esc_attr( neldra_mod( 'hero_shop_bg' ) ); ?>">
			<div class="panel__media">
				<div class="ph ph--shop" style="background:<?php echo esc_attr( neldra_mod( 'hero_shop_bg' ) ); ?>"></div>
				<img src="<?php echo esc_url( neldra_mod( 'hs_image' ) ); ?>" alt="<?php echo esc_attr( neldra_mod( 'hs_title' ) ); ?>" style="position:absolute;left:50%;top:50%;width:84%;transform:translate(-50%,-50%);object-fit:contain">
			</div>
			<div class="panel__label">
				<span class="meta"><?php echo esc_html( neldra_mod( 'hs_eyebrow' ) ); ?></span>
				<span class="panel__title"><?php echo esc_html( neldra_mod( 'hs_title' ) ); ?></span>
				<span class="panel__intro"><?php echo esc_html( neldra_mod( 'hs_intro' ) ); ?></span>
				<span class="panel__enter"><?php echo esc_html( neldra_mod( 'hs_cta' ) ); ?> <i class="arrow"></i></span>
			</div>
		</a>
		<a class="panel panel--contract" data-panel="contract" href="<?php echo esc_url( $contract_url ); ?>">
			<div class="panel__media">
				<div class="ph ph--contract" style="background:<?php echo esc_attr( neldra_mod( 'hero_contract_bg' ) ); ?>"></div>
				<img src="<?php echo esc_url( neldra_mod( 'hc_image' ) ); ?>" alt="<?php echo esc_attr( neldra_mod( 'hc_title' ) ); ?>" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.9">
			</div>
			<div class="panel__label">
				<span class="meta"><?php echo esc_html( neldra_mod( 'hc_eyebrow' ) ); ?></span>
				<span class="panel__title"><?php echo esc_html( neldra_mod( 'hc_title' ) ); ?></span>
				<span class="panel__intro"><?php echo esc_html( neldra_mod( 'hc_intro' ) ); ?></span>
				<span class="panel__enter"><?php echo esc_html( neldra_mod( 'hc_cta' ) ); ?> <i class="arrow"></i></span>
			</div>
		</a>
		<div class="scroll-hint" aria-hidden="true"><span><?php esc_html_e( 'Scroll', 'neldra' ); ?></span><i></i></div>
	</section>
	<?php
}

function neldra_home_statement() {
	?>
	<section class="statement wrap">
		<h1 class="display upper" data-reveal><?php echo esc_html( neldra_mod( 'st_line1' ) ); ?><br><?php echo esc_html( neldra_mod( 'st_line2' ) ); ?></h1>
		<p class="lead" data-reveal data-reveal-delay="1"><?php echo esc_html( neldra_mod( 'st_lead' ) ); ?></p>
	</section>
	<?php
}

function neldra_home_featured() {
	$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	?>
	<section class="section wrap" aria-label="<?php esc_attr_e( 'Featured pieces', 'neldra' ); ?>">
		<div class="section-head">
			<div>
				<p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'ft_eyebrow' ) ); ?></p>
				<h2 data-reveal><?php echo esc_html( neldra_mod( 'ft_heading' ) ); ?></h2>
			</div>
			<a class="link meta" href="<?php echo esc_url( $shop_url ); ?>" data-reveal><?php echo esc_html( neldra_mod( 'ft_link' ) ); ?> <i class="arrow"></i></a>
		</div>
		<div class="grid grid--3"><?php neldra_featured_products( 3 ); ?></div>
	</section>
	<?php
}

function neldra_home_collections() {
	$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	?>
	<section class="section wrap" aria-label="<?php esc_attr_e( 'Collections', 'neldra' ); ?>">
		<div class="section-head">
			<div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'col_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'col_heading' ) ); ?></h2></div>
		</div>
		<div class="collections-split" data-reveal>
			<?php
			for ( $i = 1; $i <= 3; $i++ ) {
				printf(
					'<a class="cpanel" href="%s"><div class="cpanel__media"><img src="%s" alt="%s"></div><div class="cpanel__label"><span class="cpanel__name">%s</span><span class="meta">%s</span></div></a>',
					esc_url( $shop_url ),
					esc_url( neldra_mod( "col{$i}_image" ) ),
					esc_attr( neldra_mod( "col{$i}_label" ) ),
					esc_html( neldra_mod( "col{$i}_label" ) ),
					esc_html( neldra_mod( "col{$i}_meta" ) )
				);
			}
			?>
		</div>
	</section>
	<?php
}

function neldra_home_contract_teaser() {
	$contract_url = home_url( '/contract/' );
	?>
	<section class="block-dark bleed" id="contract" aria-label="<?php esc_attr_e( 'Contract', 'neldra' ); ?>">
		<div class="contract-teaser wrap">
			<div class="panel__media" style="opacity:.5">
				<img src="<?php echo esc_url( neldra_mod( 'ct_image' ) ); ?>" alt="" style="position:absolute;right:0;top:0;width:56%;height:100%;object-fit:cover">
			</div>
			<div class="contract-teaser__content" style="position:relative;z-index:2">
				<p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'ct_eyebrow' ) ); ?></p>
				<h2 class="display upper" data-reveal data-reveal-delay="1"><?php echo esc_html( neldra_mod( 'ct_title1' ) ); ?><br><?php echo esc_html( neldra_mod( 'ct_title2' ) ); ?></h2>
				<p class="lead" data-reveal data-reveal-delay="2"><?php echo esc_html( neldra_mod( 'ct_lead' ) ); ?></p>
				<p data-reveal data-reveal-delay="3" style="margin-top:2.5rem"><a class="btn btn--on-dark" href="<?php echo esc_url( $contract_url ); ?>"><?php echo esc_html( neldra_mod( 'ct_cta' ) ); ?></a></p>
			</div>
		</div>
	</section>
	<?php
}

function neldra_home_projects_teaser() {
	?>
	<section class="section wrap" id="projects" aria-label="<?php esc_attr_e( 'Projects', 'neldra' ); ?>">
		<div class="section-head">
			<div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'pt_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'pt_heading' ) ); ?></h2></div>
			<a class="link meta" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" data-reveal><?php echo esc_html( neldra_mod( 'pt_link' ) ); ?> <i class="arrow"></i></a>
		</div>
		<div class="grid grid--2"><?php neldra_featured_projects( 2 ); ?></div>
	</section>
	<?php
}

function neldra_home_newsletter() {
	?>
	<section class="newsletter wrap center" id="newsletter">
		<h2 class="display" data-reveal><?php echo esc_html( neldra_mod( 'nl_heading' ) ); ?></h2>
		<p class="newsletter__sub" data-reveal data-reveal-delay="1"><?php echo esc_html( neldra_mod( 'nl_sub' ) ); ?></p>
		<form class="newsletter__form" data-reveal data-reveal-delay="2" data-newsletter method="post" action="">
			<input type="email" name="email" class="newsletter__input" placeholder="<?php esc_attr_e( 'Email address', 'neldra' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'neldra' ); ?>" required>
			<button type="submit" class="newsletter__btn" aria-label="<?php esc_attr_e( 'Subscribe', 'neldra' ); ?>"><span class="arrow"></span></button>
		</form>
	</section>
	<?php
}

/* ---------------------------------------------------------------------------
 * Product / project card helpers
 * ------------------------------------------------------------------------- */

function neldra_featured_products( $count = 3 ) {
	$img = NELDRA_URI . '/assets/img';
	$rendered = 0;
	if ( post_type_exists( 'product' ) ) {
		$q = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => $count, 'orderby' => 'date', 'order' => 'DESC' ) );
		if ( $q->have_posts() ) {
			$i = 0;
			while ( $q->have_posts() ) {
				$q->the_post();
				$i++;
				$product = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;
				$price   = $product ? $product->get_price_html() : '';
				$thumb   = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'neldra-product', array( 'alt' => get_the_title() ) ) : '<img src="' . esc_url( $img ) . '/products/n01-front.jpg" alt="">';
				printf(
					'<a class="product" href="%s" data-reveal data-reveal-delay="%d"><div class="product__media">%s</div><div class="product__meta"><div class="product__name">%s</div><div class="product__price">%s</div><span class="product__tag meta">%s</span></div></a>',
					esc_url( get_permalink() ), (int) $i, $thumb, esc_html( get_the_title() ), $price, esc_html__( 'Made to order', 'neldra' )
				);
				$rendered++;
			}
			wp_reset_postdata();
		}
	}
	$fallback = array(
		array( 'N01 · Platform Sofa', '€ 8,400', 'n01-angle.jpg' ),
		array( 'N02 · Sectional', '€ 11,200', 'n01-front.jpg' ),
		array( 'N03 · Lounge', '€ 6,900', 'n01-side.jpg' ),
	);
	for ( $j = $rendered; $j < $count; $j++ ) {
		$f = $fallback[ $j % 3 ];
		printf(
			'<a class="product" href="%s" data-reveal data-reveal-delay="%d"><div class="product__media"><img src="%s/products/%s" alt="%s"></div><div class="product__meta"><div class="product__name">%s</div><div class="product__price">%s</div><span class="product__tag meta">%s</span></div></a>',
			esc_url( home_url( '/shop/' ) ), (int) $j, esc_url( $img ), esc_attr( $f[2] ), esc_attr( $f[0] ), esc_html( $f[0] ), esc_html( $f[1] ), esc_html__( 'Made to order', 'neldra' )
		);
	}
}

function neldra_featured_projects( $count = 2 ) {
	$rendered = 0;
	if ( post_type_exists( 'project' ) ) {
		$q = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => $count ) );
		if ( $q->have_posts() ) {
			$i = 0;
			while ( $q->have_posts() ) {
				$q->the_post();
				$i++;
				$location = get_post_meta( get_the_ID(), 'location', true );
				$year     = get_post_meta( get_the_ID(), 'year', true );
				$media    = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'neldra-editorial' ) : '<div class="ph ph--contract" style="position:relative"></div>';
				printf(
					'<a class="project" href="%s" data-reveal data-reveal-delay="%d"><div class="project__media">%s</div><div class="project__meta"><span class="project__name">%s</span><span class="meta">%s</span></div></a>',
					esc_url( get_permalink() ), (int) $i, $media, esc_html( get_the_title() ), esc_html( trim( $location . ' · ' . $year, ' ·' ) )
				);
				$rendered++;
			}
			wp_reset_postdata();
		}
	}
	$fallback = array( array( 'Hotel Aurea', 'Budapest · 2025' ), array( 'Maison Vera', 'Vienna · 2025' ) );
	for ( $j = $rendered; $j < $count; $j++ ) {
		$f = $fallback[ $j % 2 ];
		printf(
			'<a class="project" href="%s" data-reveal data-reveal-delay="%d"><div class="project__media"><div class="ph ph--contract" style="position:relative"></div></div><div class="project__meta"><span class="project__name">%s</span><span class="meta">%s</span></div></a>',
			esc_url( home_url( '/projects/' ) ), (int) $j, esc_html( $f[0] ), esc_html( $f[1] )
		);
	}
}
