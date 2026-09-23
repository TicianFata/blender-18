# 01 — Technical Architecture

## 1. Platform decision

WordPress + WooCommerce, as requested. The premium, animation-heavy front end is the hard part, so the architecture is chosen to give us **full control of markup and motion** while keeping WooCommerce's proven commerce engine.

### Recommended approach: custom block theme (not a page builder)
Build a **custom theme** rather than assembling Elementor/WPBakery. Reasons:

- The split-screen hero, blended-on-white product cards, grid-density switch and page transitions all need precise, hand-written CSS/JS. Page builders fight this and add bloat that kills the "calm, fast, premium" feel.
- A lean theme = fewer render-blocking assets = the fast, quiet load the brand needs.

Two viable models:

| Model | What it is | When to pick it |
|-------|-----------|-----------------|
| **A. Classic PHP theme + Full-Site Editing off** | Traditional `functions.php` + templates, WooCommerce template overrides, enqueue our own CSS/JS. Most control, simplest mental model. | **Recommended default.** Best for bespoke motion + WooCommerce overrides. |
| **B. Block (FSE) theme** | `theme.json` design tokens + block templates. | Only if you want the client editing layouts as blocks later. Adds friction for the custom hero/animations. |

**Recommendation: Model A**, a custom classic theme (working name `neldra`), with a small set of ACF-driven blocks/sections for the editorial content the client will maintain (collection intros, projects, contract copy).

### Front-end animation stack
- **GSAP** (+ ScrollTrigger) for the split-screen, reveals, and scroll choreography — best-in-class easing control, the "eased not abrupt" requirement.
- **Lenis** for smooth (inertia) scrolling — the "smooth and deliberate" scroll.
- **Barba.js** (or a lightweight custom fetch-swap) for **page transitions** so navigating Shop → Product feels like one continuous space rather than full reloads. Optional but high-impact; must degrade gracefully.
- No heavy frameworks (no React SPA). Progressive enhancement: the site works fully without JS; motion is layered on top.

> Motion budget and per-effect timings are specified in [04 — Animations](./04-animations.md).

## 2. Plugin list (kept deliberately small)

| Purpose | Plugin | Notes |
|---------|--------|-------|
| Commerce | **WooCommerce** | Core. |
| Custom fields / content modeling | **ACF Pro** (Advanced Custom Fields) | Product extra fields, Projects, Collections, Contract page content. |
| Contract lead form | **WPForms** or **Gravity Forms** | Multi-step + file uploads (floor plans, DWG, PDF, renders). Gravity handles large uploads & conditional logic best. |
| SEO | **Rank Math** or **Yoast** | Schema for Product + Organization. |
| Performance/cache | Host-level cache + **WP Rocket** (or FlyingPress) | Critical CSS, lazy-load, defer. |
| Images | **ShortPixel/Imagify** + native WebP/AVIF | Huge editorial imagery must be optimized & responsive (`srcset`). |
| Multilingual (if needed) | **WPML** or **Polylang Pro** | Only if EN + HU (or others) confirmed — see Open Questions. |
| Backups/security | Host + **Solid Security** / Wordfence | Standard hardening. |
| Payments | **WooCommerce Stripe** (+ optional PayPal) | Cards, Apple/Google Pay via Stripe. |

Avoid: multi-purpose "mega" plugins, slider plugins, and anything that injects its own CSS framework.

## 3. Data model (high level)

- **Products** (WooCommerce): the 30 pieces. Variable products for finish/material/size variants. Custom taxonomy **`collection`** (Collection 01/02/03) in addition to standard categories.
- **Projects** (custom post type `project`): the Contract portfolio case studies — hero image, gallery, location, year, sector, scope, products used.
- **Sectors** (taxonomy on Projects & used on Contract): Architecture, Hospitality, Hotels, Restaurants, Offices, Residential, Retail, Developers.
- **Contract leads**: form submissions stored as entries + emailed + (optionally) pushed to a CRM.

Full field lists are in [05 — WooCommerce & Contract](./05-woocommerce-and-contract.md).

## 4. Environments & hosting

- **Hosting:** managed WordPress host tuned for WooCommerce (e.g. Kinsta, WP Engine, Cloudways/Gridpane). PHP 8.2+, MariaDB, object cache (Redis), server-level full-page cache with cart/checkout excluded.
- **CDN:** Cloudflare (or host CDN) for the large imagery — this is a media-heavy site.
- **Environments:** local (Docker/LocalWP) → staging → production, with a deploy path (Git-tracked theme, migrations via WP Migrate or host staging push).
- **Backups:** daily + pre-deploy snapshots.

## 5. Performance targets (the "premium = fast & quiet" contract)

- Largest Contentful Paint < 2.5s on the huge hero (use a poster/priority image, preload the hero).
- No layout shift (reserve image aspect ratios).
- Animations run on the compositor (`transform`/`opacity` only), 60fps.
- `prefers-reduced-motion` fully respected — all non-essential motion disabled for those users.
- Ship critical CSS inline for first paint; defer GSAP/Lenis.

## 6. Accessibility & SEO baseline

- Semantic HTML, keyboard-operable split-screen (Tab + Enter to enter Shop/Contract), focus-visible states.
- Color contrast: charcoal text on white passes AA easily; watch text-over-image on the hero (art-direct or add a subtle scrim only where unavoidable).
- Product schema (price, availability = "MadeToOrder"/PreOrder), Organization schema, OpenGraph for the big imagery.
