<?php
/**
 * Generic fallback template (blog/archive/search).
 *
 * @package Neldra
 */
get_header();
?>
<main id="main" class="wrap" style="padding-top:calc(var(--header-h) + 2rem)">
	<?php if ( have_posts() ) : ?>
		<header class="section-head section--tight">
			<div>
				<p class="meta"><?php bloginfo( 'name' ); ?></p>
				<h1 class="display"><?php
					if ( is_search() ) {
						printf( esc_html__( 'Search: %s', 'neldra' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
					} elseif ( is_archive() ) {
						the_archive_title();
					} else {
						esc_html_e( 'Journal', 'neldra' );
					}
				?></h1>
			</div>
		</header>

		<div class="grid grid--3">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'project' ); ?>>
					<a href="<?php the_permalink(); ?>">
						<div class="project__media">
							<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'neldra-editorial' ); } else { echo '<div class="ph ph--shop" style="position:relative"></div>'; } ?>
						</div>
						<div class="project__meta">
							<span class="project__name"><?php the_title(); ?></span>
							<span class="meta"><?php echo esc_html( get_the_date() ); ?></span>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>

		<div class="section--tight center"><?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?></div>
	<?php else : ?>
		<section class="section--tight center">
			<h1 class="display"><?php esc_html_e( 'Nothing found', 'neldra' ); ?></h1>
			<p class="lead" style="margin-inline:auto"><?php esc_html_e( 'Try another search, or return to the collection.', 'neldra' ); ?></p>
			<p style="margin-top:2rem"><a class="btn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Explore the collection', 'neldra' ); ?></a></p>
		</section>
	<?php endif; ?>
</main>
<?php get_footer();
