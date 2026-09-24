<?php
/**
 * Template Name: Contract
 * Contract landing. All copy/images editable in Appearance → Customize → Contract page.
 *
 * @package Neldra
 */
get_header();
?>
<main id="main">

	<!-- Hero statement -->
	<section class="hero" data-hero style="display:block;min-height:100svh">
		<div class="panel panel--contract" style="flex:none;min-height:100svh;align-items:center">
			<div class="panel__media"><div class="ph ph--contract"></div><img src="<?php echo esc_url( neldra_mod( 'cph_image' ) ); ?>" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.85"></div>
			<div class="panel__label wrap" style="max-width:var(--wrap);padding-top:clamp(7rem,14vh,10rem);padding-bottom:clamp(5rem,10vh,8rem)">
				<span class="meta"><?php echo esc_html( neldra_mod( 'cph_eyebrow' ) ); ?></span>
				<span class="panel__title" style="font-size:clamp(2.6rem,7vw,6.5rem)"><?php echo esc_html( neldra_mod( 'cph_title1' ) ); ?><br><?php echo esc_html( neldra_mod( 'cph_title2' ) ); ?></span>
				<span class="panel__intro" style="opacity:.9;transform:none;max-width:44ch"><?php echo esc_html( neldra_mod( 'cph_intro' ) ); ?></span>
				<span style="margin-top:1.6rem;display:inline-block"><a class="btn btn--on-dark" href="#start"><?php echo esc_html( neldra_mod( 'cph_cta' ) ); ?></a></span>
			</div>
		</div>
	</section>

	<!-- What Neldra can do -->
	<section class="section wrap">
		<div class="section-head"><div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'cap_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'cap_heading' ) ); ?></h2></div></div>
		<ul class="rows" data-reveal>
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<li><span class="row__title"><?php echo esc_html( neldra_mod( "cap{$i}_t" ) ); ?></span><span class="row__note"><?php echo esc_html( neldra_mod( "cap{$i}_n" ) ); ?></span></li>
			<?php endfor; ?>
		</ul>
	</section>

	<!-- Service levels -->
	<section class="block-dark bleed">
		<div class="section wrap">
			<div class="section-head"><div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'sl_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'sl_heading' ) ); ?></h2></div></div>
			<div class="grid grid--3">
				<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
					<div data-reveal data-reveal-delay="<?php echo (int) ( $i - 1 ); ?>"><p class="meta"><?php echo esc_html( neldra_mod( "sl{$i}_k" ) ); ?></p><h3 style="margin:.6rem 0"><?php echo esc_html( neldra_mod( "sl{$i}_t" ) ); ?></h3><p class="body-soft" style="color:rgba(244,244,243,.6);font-size:.9rem"><?php echo esc_html( neldra_mod( "sl{$i}_d" ) ); ?></p></div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<!-- Process -->
	<section class="section wrap">
		<div class="section-head"><div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'pr_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'pr_heading' ) ); ?></h2></div></div>
		<ol class="rows" data-reveal>
			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<li><span class="row__title"><?php echo esc_html( sprintf( '%02d — %s', $i, neldra_mod( "pr{$i}" ) ) ); ?></span><span class="row__note"><?php echo esc_html( neldra_mod( "pr{$i}n" ) ); ?></span></li>
			<?php endfor; ?>
		</ol>
	</section>

	<!-- Start a project -->
	<section class="section--tight wrap" id="start">
		<div class="section-head"><div><p class="meta" data-reveal><?php echo esc_html( neldra_mod( 'cf_eyebrow' ) ); ?></p><h2 data-reveal><?php echo esc_html( neldra_mod( 'cf_heading' ) ); ?></h2></div></div>
		<?php
		$form_shortcode = get_option( 'neldra_contract_form_shortcode' );
		if ( $form_shortcode ) {
			echo '<div data-reveal style="max-width:820px">' . do_shortcode( wp_kses_post( $form_shortcode ) ) . '</div>';
		} else {
			?>
			<form class="stack" data-reveal style="max-width:820px" onsubmit="return false">
				<div class="grid grid--2" style="gap:1.5rem">
					<label class="stack"><span class="meta"><?php esc_html_e( 'Name', 'neldra' ); ?></span><input class="search-input" style="font-size:1.1rem" type="text"></label>
					<label class="stack"><span class="meta"><?php esc_html_e( 'Company', 'neldra' ); ?></span><input class="search-input" style="font-size:1.1rem" type="text"></label>
					<label class="stack"><span class="meta"><?php esc_html_e( 'Email', 'neldra' ); ?></span><input class="search-input" style="font-size:1.1rem" type="email"></label>
					<label class="stack"><span class="meta"><?php esc_html_e( 'Phone', 'neldra' ); ?></span><input class="search-input" style="font-size:1.1rem" type="tel"></label>
				</div>
				<label class="stack" style="margin-top:1.5rem"><span class="meta"><?php esc_html_e( 'Project type', 'neldra' ); ?></span>
					<div class="pdp__row" style="margin-top:.4rem"><button type="button" class="swatch">Hotel</button><button type="button" class="swatch">Restaurant</button><button type="button" class="swatch">Office</button><button type="button" class="swatch">Residential</button><button type="button" class="swatch">Retail</button><button type="button" class="swatch">Developer</button></div>
				</label>
				<label class="stack" style="margin-top:1rem"><span class="meta"><?php esc_html_e( 'Project scale', 'neldra' ); ?></span>
					<div class="pdp__row" style="margin-top:.4rem"><button type="button" class="swatch">1–10</button><button type="button" class="swatch">10–50</button><button type="button" class="swatch">50–100</button><button type="button" class="swatch">100–500</button><button type="button" class="swatch">500+</button></div>
				</label>
				<label class="stack" style="margin-top:1rem"><span class="meta"><?php esc_html_e( 'What do you need?', 'neldra' ); ?></span>
					<div class="pdp__row" style="margin-top:.4rem" data-multi><button type="button" class="swatch">Existing products</button><button type="button" class="swatch">Modified products</button><button type="button" class="swatch">Custom furniture</button><button type="button" class="swatch">Custom collection</button><button type="button" class="swatch">Large-scale production</button><button type="button" class="swatch">Full package</button></div>
				</label>
				<label class="stack" style="margin-top:1.5rem"><span class="meta"><?php esc_html_e( 'Project description', 'neldra' ); ?></span><textarea rows="4" style="width:100%;border:1px solid var(--c-line);font:inherit;padding:1rem;background:transparent"></textarea></label>
				<label class="stack" style="margin-top:1rem"><span class="meta"><?php esc_html_e( 'Files (floor plans, renders, DWG, PDF)', 'neldra' ); ?></span><input type="file" multiple style="font:inherit"></label>
				<div style="margin-top:2rem"><button class="btn btn--solid" type="submit"><?php esc_html_e( 'Submit project request', 'neldra' ); ?></button></div>
				<p class="body-soft" style="font-size:.8rem"><?php esc_html_e( 'Note: connect a form plugin (see theme docs) to receive submissions & file uploads by email/CRM.', 'neldra' ); ?></p>
			</form>
			<?php
		}
		?>
	</section>

</main>
<?php get_footer();
