<?php
/**
 * Default page template.
 *
 * @package Neldra
 */
get_header();
?>
<main id="main" class="wrap" style="padding-top:calc(var(--header-h) + 2rem)">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<header class="section--tight">
				<p class="meta" data-reveal><?php bloginfo( 'name' ); ?></p>
				<h1 class="display upper" data-reveal><?php the_title(); ?></h1>
			</header>
			<div class="content-body lead" data-reveal style="max-width:70ch">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php get_footer();
