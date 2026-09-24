<?php
/**
 * Projects archive — editorial, image-led portfolio with scroll parallax.
 * Copy editable in Appearance → Customize → Projects page.
 *
 * @package Neldra
 */
get_header();
$img      = NELDRA_URI . '/assets/img';
$products = $img . '/products';
$contract = home_url( '/contract/' );
?>
<main id="main" style="padding-top:var(--header-h)">

	<section class="proj-hero wrap">
		<p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'ph_eyebrow' ) ); ?></p>
		<h1 class="hero-title upper" data-reveal data-reveal-delay="1"><?php echo esc_html( neldra_mod( 'ph_title' ) ); ?></h1>
		<p class="lead" data-reveal data-reveal-delay="2"><?php echo esc_html( neldra_mod( 'ph_intro' ) ); ?></p>
	</section>

	<section class="wrap section--tight">
		<ul class="rows" data-reveal>
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<li><span class="row__title"><?php echo esc_html( neldra_mod( "pc{$i}_t" ) ); ?></span><span class="meta"><?php echo esc_html( neldra_mod( "pc{$i}_c" ) ); ?></span></li>
			<?php endfor; ?>
		</ul>
	</section>

	<?php if ( have_posts() ) : ?>
		<?php
		$i = 0;
		while ( have_posts() ) : the_post();
			$i++;
			$rev      = ( $i % 2 === 0 ) ? ' pblock--rev' : '';
			$location = get_post_meta( get_the_ID(), 'location', true );
			$year     = get_post_meta( get_the_ID(), 'year', true );
			$cat      = get_post_meta( get_the_ID(), 'category', true );
			$media    = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'neldra-editorial' ) : $products . '/n01-angle.jpg';
			?>
			<section class="section wrap">
				<div class="pblock<?php echo esc_attr( $rev ); ?>" data-reveal>
					<figure class="pfig pfig--wide" style="margin:0"><img data-parallax="0.08" src="<?php echo esc_url( $media ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"></figure>
					<div class="pblock__text">
						<span class="pblock__num"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span>
						<p class="meta"><?php echo esc_html( $cat ? $cat : get_the_date( 'Y' ) ); ?></p>
						<h3><?php the_title(); ?></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
						<p class="meta" style="margin-top:1rem"><?php echo esc_html( trim( $location . ' · ' . $year, ' ·' ) ); ?></p>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	<?php else : ?>
		<section class="section--tight">
			<figure class="pfig pfig--cine fullbleed" data-reveal><img data-parallax="0.1" src="<?php echo esc_url( $products ); ?>/n01-detail-4.jpg" alt="Hotel Aurea"></figure>
			<div class="wrap"><div class="pcap" data-reveal><span class="pcap__name">Hotel Aurea — Lounge</span><span class="pcap__tag meta">Budapest · 2025 · Large-scale production · 120 units</span></div></div>
		</section>
		<section class="section wrap">
			<div class="pblock" data-reveal>
				<figure class="pfig pfig--wide" style="margin:0"><img data-parallax="0.08" src="<?php echo esc_url( $products ); ?>/n01-angle.jpg" alt="N01 Platform Sofa"></figure>
				<div class="pblock__text"><span class="pblock__num">01</span><p class="meta"><?php esc_html_e( 'Competition-winning design', 'neldra' ); ?></p><h3>N01 · Platform Sofa</h3><p><?php esc_html_e( 'Awarded for its floating twin-slab construction. Now a permanent piece in the Neldra Collection.', 'neldra' ); ?></p></div>
			</div>
		</section>
		<section class="section--tight wrap">
			<div class="ptwo" data-reveal>
				<figure class="pfig pfig--tall" style="margin:0"><img data-parallax="0.09" src="<?php echo esc_url( $products ); ?>/n01-detail-1.jpg" alt="Custom detail"></figure>
				<figure class="pfig pfig--tall" style="margin:0"><img data-parallax="0.12" src="<?php echo esc_url( $products ); ?>/n01-detail-2.jpg" alt="Custom detail"></figure>
			</div>
			<div class="pcap" data-reveal><span class="pcap__name">Maison Vera — Bar Seating</span><span class="pcap__tag meta">Vienna · 2025 · Custom-made furniture</span></div>
		</section>
	<?php endif; ?>

	<section class="block-dark bleed">
		<div class="section wrap center">
			<h2 class="display upper" data-reveal><?php echo esc_html( neldra_mod( 'pcta_heading' ) ); ?></h2>
			<p class="lead" data-reveal data-reveal-delay="1" style="margin:1.5rem auto 0;color:var(--c-on-dark)"><?php echo esc_html( neldra_mod( 'pcta_lead' ) ); ?></p>
			<p data-reveal data-reveal-delay="2" style="margin-top:2.5rem"><a class="btn btn--on-dark" href="<?php echo esc_url( $contract ); ?>"><?php echo esc_html( neldra_mod( 'pcta_btn' ) ); ?></a></p>
		</div>
	</section>

</main>
<?php get_footer();
