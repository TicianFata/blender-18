<?php
/**
 * Header: overlay navigation + menu/search/cart overlays.
 *
 * @package Neldra
 */
$is_home       = is_front_page();
$header_state  = $is_home ? 'site-header--overlay' : 'site-header--solid';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="btn--ghost" href="#main" style="position:absolute;left:-9999px"><?php esc_html_e( 'Skip to content', 'neldra' ); ?></a>

<div class="scrim" data-scrim></div>

<div class="overlay" id="menu-overlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Menu', 'neldra' ); ?>">
	<button class="overlay__close" data-close><?php esc_html_e( 'Close', 'neldra' ); ?> &times;</button>
	<div class="overlay__body">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'menu-list stack',
			) );
		} else {
			neldra_fallback_menu( 'menu-list stack' );
		}
		?>
	</div>
</div>

<div class="overlay" id="search-overlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Search', 'neldra' ); ?>">
	<button class="overlay__close" data-close><?php esc_html_e( 'Close', 'neldra' ); ?> &times;</button>
	<div class="overlay__body wrap">
		<p class="meta" style="margin-bottom:1rem"><?php esc_html_e( 'Search', 'neldra' ); ?></p>
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input class="search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Search products & projects…', 'neldra' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'neldra' ); ?>">
		</form>
	</div>
</div>

<aside class="drawer" id="cart-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Cart', 'neldra' ); ?>">
	<div style="display:flex;justify-content:space-between;align-items:center">
		<span class="meta"><?php esc_html_e( 'Cart', 'neldra' ); ?></span>
		<button class="overlay__close" data-close><?php esc_html_e( 'Close', 'neldra' ); ?> &times;</button>
	</div>
	<div class="overlay__body">
		<?php
		if ( function_exists( 'WC' ) && WC()->cart && ! WC()->cart->is_empty() ) {
			woocommerce_mini_cart();
		} else {
			echo '<p class="body-soft" style="font-size:.9rem">' . esc_html__( 'Your cart is empty.', 'neldra' ) . '</p>';
		}
		?>
	</div>
	<a class="btn btn--solid" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Explore the collection', 'neldra' ); ?></a>
</aside>

<header class="site-header <?php echo esc_attr( $header_state ); ?>" data-header>
	<div class="site-header__inner wrap">
		<?php if ( has_custom_logo() ) : ?>
			<div class="brand-logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Neldra home', 'neldra' ); ?>">NELDRA</a>
		<?php endif; ?>

		<nav class="nav-primary" aria-label="<?php esc_attr_e( 'Primary', 'neldra' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => '',
					'link_before'    => '<span class="link">',
					'link_after'     => '</span>',
				) );
			} else {
				neldra_fallback_menu( '', true );
			}
			?>
		</nav>

		<div class="nav-util">
			<button data-open="search-overlay" aria-label="<?php esc_attr_e( 'Open search', 'neldra' ); ?>"><?php esc_html_e( 'Search', 'neldra' ); ?></button>
			<button data-open="cart-drawer" aria-label="<?php esc_attr_e( 'Open cart', 'neldra' ); ?>">
				<?php esc_html_e( 'Cart', 'neldra' ); ?>&nbsp;(<span class="cart-count"><?php echo function_exists( 'WC' ) && WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?></span>)
			</button>
			<button class="nav-toggle" data-open="menu-overlay" aria-label="<?php esc_attr_e( 'Open menu', 'neldra' ); ?>"><?php esc_html_e( 'Menu', 'neldra' ); ?></button>
		</div>
	</div>
</header>
<?php
/**
 * Fallback nav used until menus are assigned in Appearance → Menus.
 */
function neldra_fallback_menu( $class = '', $link_class = false ) {
	$items = array(
		'shop'     => __( 'Shop', 'neldra' ),
		'shop2'    => __( 'Collections', 'neldra' ),
		'contract' => __( 'Contract', 'neldra' ),
		'projects' => __( 'Projects', 'neldra' ),
		'about'    => __( 'About', 'neldra' ),
	);
	$urls = array(
		'shop'     => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ),
		'shop2'    => home_url( '/shop/' ),
		'contract' => home_url( '/contract/' ),
		'projects' => home_url( '/projects/' ),
		'about'    => home_url( '/about/' ),
	);
	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( $items as $key => $label ) {
		$open  = $link_class ? '<a class="link" href="' : '<a href="';
		echo '<li>' . $open . esc_url( $urls[ $key ] ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
