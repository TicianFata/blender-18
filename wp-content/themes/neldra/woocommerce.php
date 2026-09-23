<?php
/**
 * WooCommerce wrapper template.
 *
 * WooCommerce renders shop/category/product content through
 * woocommerce_content(). Our before/after hooks (functions.php) add the
 * <main class="wrap"> wrapper so the shop inherits the site's spacing and the
 * quiet, editorial catalogue treatment. Fine-grained overrides (product loop
 * item, single-product layout, add-to-cart) live in /woocommerce/ template
 * overrides added in a later phase.
 *
 * @package Neldra
 */
get_header();
?>
	<?php woocommerce_content(); ?>
<?php
get_footer();
