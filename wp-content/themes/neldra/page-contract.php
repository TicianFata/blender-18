<?php
/**
 * Template Name: Contract
 * Contract landing — capability, sectors, service levels, process + project request.
 * Assign this template to a Page (or name the page slug "contract").
 *
 * @package Neldra
 */
get_header();
$img = NELDRA_URI . '/assets/img';
?>
<main id="main">

	<!-- Hero statement -->
	<section class="hero" data-hero style="display:block;min-height:100svh">
		<div class="panel panel--contract" style="flex:none;min-height:100svh;align-items:center">
			<div class="panel__media"><div class="ph ph--contract"></div><img src="<?php echo esc_url( $img ); ?>/interior.svg" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.85"></div>
			<div class="panel__label wrap" style="max-width:var(--wrap);padding-top:clamp(7rem,14vh,10rem);padding-bottom:clamp(5rem,10vh,8rem)">
				<span class="meta"><?php esc_html_e( 'Neldra Contract', 'neldra' ); ?></span>
				<span class="panel__title" style="font-size:clamp(2.6rem,7vw,6.5rem)"><?php esc_html_e( 'Furniture for projects,', 'neldra' ); ?><br><?php esc_html_e( 'at scale', 'neldra' ); ?></span>
				<span class="panel__intro" style="opacity:.9;transform:none;max-width:44ch"><?php esc_html_e( 'For architecture, hospitality, hotels, restaurants, offices, residential, retail and developers.', 'neldra' ); ?></span>
				<span style="margin-top:1.6rem;display:inline-block"><a class="btn btn--on-dark" href="#start"><?php esc_html_e( 'Start a project', 'neldra' ); ?></a></span>
			</div>
		</div>
	</section>

	<!-- What Neldra can do -->
	<section class="section wrap">
		<div class="section-head"><div><p class="meta" data-reveal><?php esc_html_e( 'What Neldra can do', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'From one piece to a whole project', 'neldra' ); ?></h2></div></div>
		<ul class="rows" data-reveal>
			<li><span class="row__title"><?php esc_html_e( 'Standard products', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Existing Neldra pieces supplied in project quantity.', 'neldra' ); ?></span></li>
			<li><span class="row__title"><?php esc_html_e( 'Modified products', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'An existing design adapted to project requirements.', 'neldra' ); ?></span></li>
			<li><span class="row__title"><?php esc_html_e( 'Custom furniture', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Entirely new furniture developed for the project.', 'neldra' ); ?></span></li>
			<li><span class="row__title"><?php esc_html_e( 'Custom collections', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Several coherent pieces designed together.', 'neldra' ); ?></span></li>
			<li><span class="row__title"><?php esc_html_e( 'Large-scale production', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Dozens to hundreds of consistent units.', 'neldra' ); ?></span></li>
			<li><span class="row__title"><?php esc_html_e( 'Project delivery', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Production, logistics & installation where included.', 'neldra' ); ?></span></li>
		</ul>
	</section>

	<!-- Service levels -->
	<section class="block-dark bleed">
		<div class="section wrap">
			<div class="section-head"><div><p class="meta" data-reveal><?php esc_html_e( 'Three service levels', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'How we work', 'neldra' ); ?></h2></div></div>
			<div class="grid grid--3">
				<div data-reveal><p class="meta"><?php esc_html_e( 'Level 01', 'neldra' ); ?></p><h3 style="margin:.6rem 0"><?php esc_html_e( 'Standard', 'neldra' ); ?></h3><p class="body-soft" style="color:rgba(244,244,243,.6);font-size:.9rem"><?php esc_html_e( 'An existing piece in quantity — quotation, schedule, logistics, coordination.', 'neldra' ); ?></p></div>
				<div data-reveal data-reveal-delay="1"><p class="meta"><?php esc_html_e( 'Level 02', 'neldra' ); ?></p><h3 style="margin:.6rem 0"><?php esc_html_e( 'Modified', 'neldra' ); ?></h3><p class="body-soft" style="color:rgba(244,244,243,.6);font-size:.9rem"><?php esc_html_e( 'A design adapted to the project after a feasibility assessment.', 'neldra' ); ?></p></div>
				<div data-reveal data-reveal-delay="2"><p class="meta"><?php esc_html_e( 'Level 03', 'neldra' ); ?></p><h3 style="margin:.6rem 0"><?php esc_html_e( 'Custom', 'neldra' ); ?></h3><p class="body-soft" style="color:rgba(244,244,243,.6);font-size:.9rem"><?php esc_html_e( 'Concept → 3D → engineering → prototype → approval → production.', 'neldra' ); ?></p></div>
			</div>
		</div>
	</section>

	<!-- Process -->
	<section class="section wrap">
		<div class="section-head"><div><p class="meta" data-reveal><?php esc_html_e( 'The custom process', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'From brief to installation', 'neldra' ); ?></h2></div></div>
		<ol class="rows" data-reveal>
			<li><span class="row__title">01 — <?php esc_html_e( 'Brief', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Understand the project.', 'neldra' ); ?></span></li>
			<li><span class="row__title">02 — <?php esc_html_e( 'Design direction', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Aesthetic, proportions, materials, function.', 'neldra' ); ?></span></li>
			<li><span class="row__title">03 — <?php esc_html_e( 'Concept & 3D', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Initial concepts and detailed models.', 'neldra' ); ?></span></li>
			<li><span class="row__title">04 — <?php esc_html_e( 'Technical & quote', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Made manufacturable; project quotation.', 'neldra' ); ?></span></li>
			<li><span class="row__title">05 — <?php esc_html_e( 'Prototype & approval', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'A physical sample where required.', 'neldra' ); ?></span></li>
			<li><span class="row__title">06 — <?php esc_html_e( 'Production, QC & logistics', 'neldra' ); ?></span><span class="row__note"><?php esc_html_e( 'Manufacture, inspect, deliver, install.', 'neldra' ); ?></span></li>
		</ol>
	</section>

	<!-- Start a project -->
	<section class="section--tight wrap" id="start">
		<div class="section-head"><div><p class="meta" data-reveal><?php esc_html_e( 'Start a project', 'neldra' ); ?></p><h2 data-reveal><?php esc_html_e( 'Tell us about your project', 'neldra' ); ?></h2></div></div>
		<?php
		// If a form plugin shortcode is set (Options → see INSTALL.md), render it.
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
