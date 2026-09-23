# Neldra — WordPress theme

A premium, editorial WordPress + WooCommerce theme for **Neldra**, a furniture
design & production studio with a direct-to-consumer Collection and a
project-based Contract division.

## Highlights
- **Split-screen entrance** with a real moving boundary (Shop ⇄ Contract).
- **White architectural gallery** aesthetic — furniture floats on white.
- **Quiet, restrained motion**: scroll reveals, hover, page-level transitions, custom cursor — all `prefers-reduced-motion` aware.
- **Grid-density switch** (2/3/4/5) on the shop/collection archives.
- Bilingual-ready (**EN / HU**), Polylang/WPML integrated.
- Self-hosted fonts (no external requests): **Jost** (Cenzo stand-in) + **Montserrat**, both with latin-ext for Hungarian.

## Requirements
- WordPress 6.4+, PHP 8.1+
- WooCommerce 8+
- Recommended: ACF Pro (extended product/project fields), a form plugin (Gravity/WPForms) for *Start a Project*, Polylang/WPML for EN/HU.

## Install
1. Copy this folder to `wp-content/themes/neldra` and activate it.
2. Install & activate WooCommerce; run its setup (currency **EUR**; add **HUF** via a multi-currency plugin or a second store/locale — see `/docs`).
3. **Appearance → Menus:** create a *Primary* menu (Shop, Collections, Contract, Projects, About) and a *Footer* menu. Until then a sensible fallback menu is shown.
4. **Settings → Reading:** set a static front page (uses `front-page.php` automatically).
5. Create pages: `Contract`, `About` (+ legal/support). The `project` CPT and `collection`/`sector` taxonomies register automatically.
6. Flush permalinks (Settings → Permalinks → Save).

## The display font (TRT Cenzo)
The headline font is wired as a **drop-in**: place the licensed
`trt-cenzo-demo-light.woff2` in `assets/fonts/` and it is used automatically
(and preloaded). Until then the stack falls back to **Jost**, a close geometric
sans. The referenced "TRT Cenzo **Demo**" is personal-use-only with a limited
glyph set — license the full **Cenzo** family before launch. See
`/docs/02-design-system.md`.

## Structure
```
neldra/
├── style.css            theme header
├── functions.php        setup, asset enqueue, font preload, WooCommerce tweaks,
│                        Projects CPT + collection/sector taxonomies
├── theme.json           editor color/type tokens
├── header.php           overlay nav + menu/search/cart overlays
├── footer.php           quiet typographic footer + EN/HU switch
├── front-page.php       split-screen hero + editorial sections
├── woocommerce.php      shop/product wrapper (inherits site spacing)
├── index.php, page.php  fallback templates
├── languages/           i18n (EN/HU) notes + POT target
└── assets/
    ├── css/neldra.css   design system (single source of truth)
    ├── js/neldra.js     interactions (vanilla; GSAP/Lenis upgrade path documented)
    ├── fonts/           self-hosted woff2 + @font-face
    └── img/             sofa.svg + interior.svg placeholders (swap for real photography)
```

## Assets are shared with the static prototype
The repo root also contains a **static prototype** (`index.html`, `shop.html`,
`product.html`, `contract.html`) that references the **same** `assets/` — so the
design is viewable without a WordPress install (e.g. via GitHub Pages). Editing
the CSS/JS updates both.

## Production motion upgrade
The prototype JS is dependency-free. For production, GSAP + ScrollTrigger and
Lenis smooth-scroll can replace the vanilla reveal/scroll logic without markup
changes (classes/`data-` hooks already match). See `/docs/04-animations.md`.
