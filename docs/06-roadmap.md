# 06 — Build Roadmap

Phased so we can get a beautiful, working core online early, then layer polish. Each phase ends with something reviewable (pushed to a branch / staging).

## Phase 0 — Foundations & decisions
- Resolve the [Open Questions](./07-open-questions.md) (font license, currency, tax, languages, real product data, hosting).
- Provision hosting + staging; install WordPress, WooCommerce, ACF Pro, form plugin.
- Set up the custom theme skeleton `neldra` (Git-tracked): design tokens (CSS custom properties from [02](./02-design-system.md)), self-hosted Montserrat, `--font-display` wired for Cenzo/fallback, base typography + spacing.
- Wire GSAP + ScrollTrigger + Lenis; motion tokens; `prefers-reduced-motion` scaffolding.

## Phase 1 — Design system & global shell
- Header/overlay nav, footer, search overlay, cart drawer.
- Base page transition system (Barba or fetch-swap) with graceful no-JS fallback.
- Component library: buttons, links, thin-rule accordion, floating product card, project card, grid-density switch.
- **Deliverable:** clickable styled shell + a11y/reduced-motion verified.

## Phase 2 — Homepage split-screen (signature)
- Full-screen two-panel hero with real moving boundary; hover/focus expand; click-to-enter transition.
- Mobile stacked/tap version; reduced-motion static version.
- Below-fold reveal sections.
- **Deliverable:** the hero interaction tuned to feel premium (this is the make-or-break moment).

## Phase 3 — Shop, Collections & Product
- WooCommerce archive restyled: floating cards, grid-density switch (2/3/4/5) with FLIP re-flow, minimal filters.
- Collections index + single collection (editorial hero → spacious grid).
- Single product: large gallery, quiet info column, variants, quantity, expandable sections, dual CTA (ADD TO CART + FOR PROJECTS).
- White-blend image pipeline for catalogue shots.
- **Deliverable:** a customer can browse → configure → add to cart with the test product + a few dummies.

## Phase 4 — Checkout & order flow
- Restyle cart/checkout to the white system; Stripe (+ optional PayPal); VAT/shipping config.
- Made-to-order messaging; order confirmation; (planned) custom order statuses.
- **Deliverable:** a full test purchase end-to-end in Stripe test mode.

## Phase 5 — Contract & Projects
- Contract landing (hero statement, sectors, capabilities, service levels, process sequence).
- Multi-step "START A PROJECT" form with conditional logic + file uploads + product prefill; team email + auto-acknowledge; optional CRM.
- Projects CPT + index (portfolio grid) + single case study.
- **Deliverable:** a project enquiry submits cleanly with files; a project case study renders.

## Phase 6 — Content, About & polish
- About page; legal/support pages; SEO (schema, meta, OG for big imagery); sitemaps.
- Load real 30-product data + photography + editorial/Contract/project imagery.
- Multilingual (if confirmed).

## Phase 7 — Performance, QA & launch
- Image optimization (WebP/AVIF, srcset), critical CSS, defer JS, caching/CDN.
- Cross-browser + device QA; Core Web Vitals; motion at 60fps; reduced-motion & no-JS passes; accessibility audit.
- Analytics/consent; backups; go-live checklist; DNS cutover.

## Ongoing
- Add real products/projects as they're ready; monitor performance; iterate on motion tuning.

---

### Notes on sequencing
- Phases 2–4 (hero → shop → checkout) deliver the core consumer product early.
- Phase 5 (Contract/Projects) can run partly in parallel once the design system (Phase 1) is stable.
- Real content (Phase 6) is gated on the client providing product data + photography — flagged in Open Questions so it doesn't block the front-end build (we build with the test sofa + placeholders).
