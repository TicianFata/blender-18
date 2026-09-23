<?php
/**
 * Footer.
 *
 * @package Neldra
 */
?>
<footer class="site-footer">
	<div class="wrap">
		<div class="footer-grid">
			<div class="footer-brand">
				<span class="brand">NELDRA</span>
				<p class="body-soft" style="font-size:.85rem;max-width:32ch"><?php esc_html_e( 'Furniture design & production. Made to order. Delivered worldwide.', 'neldra' ); ?></p>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Shop', 'neldra' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => '', 'link_before' => '<span class="link">', 'link_after' => '</span>' ) );
				} else {
					echo '<ul>';
					echo '<li><a class="link" href="' . esc_url( home_url( '/shop/' ) ) . '">' . esc_html__( 'All pieces', 'neldra' ) . '</a></li>';
					echo '<li><a class="link" href="' . esc_url( home_url( '/shop/' ) ) . '">' . esc_html__( 'Collection 01', 'neldra' ) . '</a></li>';
					echo '<li><a class="link" href="' . esc_url( home_url( '/shop/' ) ) . '">' . esc_html__( 'Collection 02', 'neldra' ) . '</a></li>';
					echo '<li><a class="link" href="' . esc_url( home_url( '/shop/' ) ) . '">' . esc_html__( 'Collection 03', 'neldra' ) . '</a></li>';
					echo '</ul>';
				}
				?>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Contract', 'neldra' ); ?></h4>
				<ul>
					<li><a class="link" href="<?php echo esc_url( home_url( '/contract/' ) ); ?>"><?php esc_html_e( 'Start a project', 'neldra' ); ?></a></li>
					<li><a class="link" href="<?php echo esc_url( home_url( '/contract/' ) ); ?>"><?php esc_html_e( 'Capabilities', 'neldra' ); ?></a></li>
					<li><a class="link" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects', 'neldra' ); ?></a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Studio', 'neldra' ); ?></h4>
				<ul>
					<li><a class="link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'neldra' ); ?></a></li>
					<li><a class="link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'neldra' ); ?></a></li>
					<li><a class="link" href="<?php echo esc_url( home_url( '/care/' ) ); ?>"><?php esc_html_e( 'Care & warranty', 'neldra' ); ?></a></li>
					<li><a class="link" href="<?php echo esc_url( home_url( '/shipping/' ) ); ?>"><?php esc_html_e( 'Shipping', 'neldra' ); ?></a></li>
				</ul>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> &mdash; <?php esc_html_e( 'All rights reserved', 'neldra' ); ?></span>
			<span class="lang-switch" data-lang>
				<?php
				// Language switch: integrates with Polylang/WPML when active; static otherwise.
				if ( function_exists( 'pll_the_languages' ) ) {
					pll_the_languages( array( 'dropdown' => 0, 'show_flags' => 0, 'show_names' => 1 ) );
				} else {
					echo '<button aria-pressed="true">EN</button><button aria-pressed="false">HU</button>';
				}
				?>
			</span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
