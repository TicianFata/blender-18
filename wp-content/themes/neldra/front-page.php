<?php
/**
 * Front page — the split-screen entrance + editorial sections.
 * Mirrors the static prototype (index.html) using theme data.
 *
 * @package Neldra
 */
get_header();

$shop_url     = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$contract_url = home_url( '/contract/' );
$img          = NELDRA_URI . '/assets/img';
?>
<main id="main">

	<!-- Split-screen hero -->
	<section class="hero" data-hero aria-label="<?php esc_attr_e( 'Choose Shop or Contract', 'neldra' ); ?>">
		<a class="panel panel--shop" data-panel="shop" href="<?php echo esc_url( $shop_url ); ?>">
			<div class="panel__media">
				<img src="<?php echo esc_url( $img ); ?>/products/n01-angle.jpg" alt="Neldra N01 Platform Sofa" style="position:absolute;left:50%;top:50%;width:84%;transform:translate(-50%,-50%);object-fit:contain">
			</div>
			<div class="panel__label">
				<span class="meta"><?php esc_html_e( 'The Collection', 'neldra' ); ?></span>
				<span class="panel__title"><?php esc_html_e( 'Shop', 'neldra' ); ?></span>
				<span class="panel__intro"><?php esc_html_e( 'Thirty finished pieces across three collections. Made to order, bought online.', 'neldra' ); ?></span>
				<span class="panel__enter"><?php esc_html_e( 'Enter the shop', 'neldra' ); ?> <i class="arrow"></i></span>
			</div>
		</a>
		<a class="panel panel--contract" data-panel="contract" href="<?php echo esc_url( $contract_url ); ?>">
			<div class="panel__media">
				<div class="ph ph--contract"><span class="ph__note"><?php esc_html_e( 'Contract image · placeholder', 'neldra' ); ?></span></div>
				<img src="<?php echo esc_url( $img ); ?>/interior.svg" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.9">
			</div>
			<div class="panel__label">
				<span class="meta"><?php esc_html_e( 'Neldra Contract', 'neldra' ); ?></span>
				<span class="panel__title"><?php esc_html_e( 'Contract', 'neldra' ); ?></span>
				<span class="panel__intro"><?php esc_html_e( 'Furniture for projects, at scale — supplied, modified or developed from scratch.', 'neldra' ); ?></span>
				<span class="panel__enter"><?php esc_html_e( 'Start a project', 'neldra' ); ?> <i class="arrow"></i></span>
			</div>
		</a>
		<div class="scroll-hint" aria-hidden="true"><span><?php esc_html_e( 'Scroll', 'neldra' ); ?></span><i></i></div>
	</section>

	<!-- Brand statement -->
	<section class="statement wrap">
		<h1 class="display upper" data-reveal><?php esc_html_e( 'A furniture design', 'neldra' ); ?><br><?php esc_html_e( '& production studio', 'neldra' ); ?></h1>
		<p class="lead" data-reveal data-reveal-delay="1"><?php esc_html_e( 'Neldra designs, develops and produces furniture — a direct-to-consumer collection and a project-based Contract division, held together by one quiet, architectural language.', 'neldra' ); ?></p>
	</section>

	<!-- Featured pieces -->
	<section class="section wrap" aria-label="<?php esc_attr_e( 'Featured pieces', 'neldra' ); ?>">
		<div class="section-head">
			<div>
				<p class="meta" data-reveal><?php esc_html_e( 'Selected', 'neldra' ); ?></p>
				<h2 data-reveal><?php esc_html_e( 'Featured pieces', 'neldra' ); ?></h2>
			</div>
			<a class="link meta" href="<?php echo esc_url( $shop_url ); ?>" data-reveal><?php esc_html_e( 'View all 30', 'neldra' ); ?> <i class="arrow"></i></a>
		</div>
		<div class="grid grid--3">
			<?php neldra_featured_products( 3 ); ?>
		</div>
	</section>

	<!-- Collections (3-panel split, expands on hover) -->
	<section class="section wrap" aria-label="<?php esc_attr_e( 'Collections', 'neldra' ); ?>">
		<div class="section-head">
			<div><p class="meta" data-reveal><?php esc_html_e( 'Three collections · ten pieces each', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'Collections', 'neldra' ); ?></h2></div>
		</div>
		<div class="collections-split" data-reveal>
			<?php
			$cols = array(
				array( 'Collection 01', 'n01-detail-1.jpg' ),
				array( 'Collection 02', 'n01-detail-4.jpg' ),
				array( 'Collection 03', 'n01-detail-2.jpg' ),
			);
			foreach ( $cols as $c ) {
				printf(
					'<a class="cpanel" href="%s"><div class="cpanel__media"><img src="%s/products/%s" alt="%s"></div><div class="cpanel__label"><span class="cpanel__name">%s</span><span class="meta">%s</span></div></a>',
					esc_url( $shop_url ), esc_url( $img ), esc_attr( $c[1] ), esc_attr( $c[0] ), esc_html( $c[0] ), esc_html__( '10 pieces', 'neldra' )
				);
			}
			?>
		</div>
	</section>

	<!-- Contract teaser -->
	<section class="block-dark bleed" id="contract" aria-label="<?php esc_attr_e( 'Contract', 'neldra' ); ?>">
		<div class="contract-teaser wrap">
			<div class="panel__media" style="opacity:.5">
				<img src="<?php echo esc_url( $img ); ?>/interior.svg" alt="" style="position:absolute;right:0;top:0;width:56%;height:100%;object-fit:cover">
			</div>
			<div class="contract-teaser__content" style="position:relative;z-index:2">
				<p class="meta" data-reveal><?php esc_html_e( 'Neldra Contract', 'neldra' ); ?></p>
				<h2 class="display upper" data-reveal data-reveal-delay="1"><?php esc_html_e( 'Furniture for', 'neldra' ); ?><br><?php esc_html_e( 'projects, at scale', 'neldra' ); ?></h2>
				<p class="lead" data-reveal data-reveal-delay="2"><?php esc_html_e( 'For architects, hotels, restaurants, offices and developers. Supply existing pieces in quantity, modify a design, or develop entirely new furniture and collections.', 'neldra' ); ?></p>
				<p data-reveal data-reveal-delay="3" style="margin-top:2.5rem"><a class="btn btn--on-dark" href="<?php echo esc_url( $contract_url ); ?>"><?php esc_html_e( 'Start a project', 'neldra' ); ?></a></p>
			</div>
		</div>
	</section>

	<!-- Projects teaser -->
	<section class="section wrap" id="projects" aria-label="<?php esc_attr_e( 'Projects', 'neldra' ); ?>">
		<div class="section-head">
			<div><p class="meta" data-reveal><?php esc_html_e( 'Evidence of execution', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'Selected projects', 'neldra' ); ?></h2></div>
			<a class="link meta" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" data-reveal><?php esc_html_e( 'All projects', 'neldra' ); ?> <i class="arrow"></i></a>
		</div>
		<div class="grid grid--2">
			<?php neldra_featured_projects( 2 ); ?>
		</div>
	</section>

	<!-- Newsletter -->
	<section class="newsletter wrap center" id="newsletter">
		<h2 class="display" data-reveal><?php esc_html_e( 'Be the First to Know', 'neldra' ); ?></h2>
		<p class="newsletter__sub" data-reveal data-reveal-delay="1"><?php esc_html_e( '…about new collections and special offers.', 'neldra' ); ?></p>
		<form class="newsletter__form" data-reveal data-reveal-delay="2" data-newsletter method="post" action="">
			<input type="email" name="email" class="newsletter__input" placeholder="<?php esc_attr_e( 'Email address', 'neldra' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'neldra' ); ?>" required>
			<button type="submit" class="newsletter__btn" aria-label="<?php esc_attr_e( 'Subscribe', 'neldra' ); ?>"><span class="arrow"></span></button>
		</form>
	</section>

</main>
<?php
get_footer();

/**
 * Render featured product cards, or placeholders if WooCommerce/products absent.
 */
function neldra_featured_products( $count = 3 ) {
	$img = NELDRA_URI . '/assets/img';
	$rendered = 0;

	if ( post_type_exists( 'product' ) ) {
		$q = new WP_Query( array(
			'post_type'      => 'product',
			'posts_per_page' => $count,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );
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

	// Placeholders (single-product prototype state).
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

/**
 * Render project cards, or placeholders if none exist yet.
 */
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
	$fallback = array(
		array( 'Hotel Aurea', 'Budapest · 2025' ),
		array( 'Maison Vera', 'Vienna · 2025' ),
	);
	for ( $j = $rendered; $j < $count; $j++ ) {
		$f = $fallback[ $j % 2 ];
		printf(
			'<a class="project" href="%s" data-reveal data-reveal-delay="%d"><div class="project__media"><div class="ph ph--contract" style="position:relative"><span class="ph__note">%s</span></div></div><div class="project__meta"><span class="project__name">%s</span><span class="meta">%s</span></div></a>',
			esc_url( home_url( '/contract/' ) ), (int) $j, esc_html( $f[0] ), esc_html( $f[0] ), esc_html( $f[1] )
		);
	}
}
