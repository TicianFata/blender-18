<?php
/**
 * Projects archive — editorial, image-led portfolio with scroll parallax.
 * Mirrors the static prototype (projects.html). Renders `project` posts when
 * they exist, otherwise falls back to placeholder blocks using product photos.
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
		<p class="meta" data-reveal><?php esc_html_e( 'Selected work · Evidence of execution', 'neldra' ); ?></p>
		<h1 class="hero-title upper" data-reveal data-reveal-delay="1"><?php esc_html_e( 'Projects', 'neldra' ); ?></h1>
		<p class="lead" data-reveal data-reveal-delay="2"><?php esc_html_e( 'A record of what Neldra has designed, developed and delivered — from competition-winning pieces to large-scale production for hotels, restaurants and architecture.', 'neldra' ); ?></p>
	</section>

	<section class="wrap section--tight">
		<ul class="rows" data-reveal>
			<li><span class="row__title"><?php esc_html_e( 'Competition-winning designs', 'neldra' ); ?></span><span class="meta">08</span></li>
			<li><span class="row__title"><?php esc_html_e( 'Custom-made furniture', 'neldra' ); ?></span><span class="meta">24</span></li>
			<li><span class="row__title"><?php esc_html_e( 'Delivered & sold projects', 'neldra' ); ?></span><span class="meta">40+</span></li>
			<li><span class="row__title"><?php esc_html_e( 'Large-scale production', 'neldra' ); ?></span><span class="meta">12</span></li>
			<li><span class="row__title"><?php esc_html_e( 'Hospitality & architecture', 'neldra' ); ?></span><span class="meta">18</span></li>
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
		<!-- Placeholder blocks (until real projects are published) -->
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

	<!-- Recent, horizontal scroll -->
	<section class="section wrap">
		<div class="section-head"><div><p class="meta" data-reveal><?php esc_html_e( 'More work', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'In production & delivered', 'neldra' ); ?></h2></div><span class="meta" data-reveal><?php esc_html_e( 'Scroll →', 'neldra' ); ?></span></div>
		<div class="pstrip" data-reveal>
			<?php
			$strip = array( 'n01-front.jpg', 'n01-angle2.jpg', 'n01-back.jpg', 'n01-detail-1.jpg', 'n01-detail-4.jpg' );
			foreach ( $strip as $s ) {
				printf( '<figure><div class="pfig"><img data-parallax="0.06" src="%s/%s" alt=""></div></figure>', esc_url( $products ), esc_attr( $s ) );
			}
			?>
		</div>
	</section>

	<section class="block-dark bleed">
		<div class="section wrap center">
			<h2 class="display upper" data-reveal><?php esc_html_e( 'Have a project?', 'neldra' ); ?></h2>
			<p class="lead" data-reveal data-reveal-delay="1" style="margin:1.5rem auto 0;color:var(--c-on-dark)"><?php esc_html_e( 'From a single competition piece to hundreds of units — Neldra can design, develop and produce it.', 'neldra' ); ?></p>
			<p data-reveal data-reveal-delay="2" style="margin-top:2.5rem"><a class="btn btn--on-dark" href="<?php echo esc_url( $contract ); ?>"><?php esc_html_e( 'Start a project', 'neldra' ); ?></a></p>
		</div>
	</section>

</main>
<?php get_footer();
