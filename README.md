# NELDRA — Website

A furniture **design & production studio** with two commercial paths under one brand:

- **NELDRA Collection / Shop** — 30 finished products (3 collections × 10), bought online via WooCommerce.
- **NELDRA Contract** — B2B, project-based furniture supply, modification & custom development. Lead-generation, *not* checkout.

Platform: **WordPress + WooCommerce**. Visual world: extremely white, editorial, architectural, quiet, cold, image-driven — closer to a premium fashion/design publication than a normal furniture webshop.

---

## 🔴 Live preview

A **static prototype** of the design + animations is published via GitHub Pages:

> **https://ticianfata.github.io/neldra/**

Pages included: **Home** (split-screen entrance), **Shop** (grid-density switch), **Product** (white-blend gallery + dual CTA), **Contract** (capabilities, service levels, process, project request form). Move your cursor across the homepage hero to watch the boundary between **Shop** and **Contract** expand.

> The prototype and the WordPress theme **share the same CSS/JS/fonts**, so what you see is exactly what the theme renders.

## Repository layout

```
/                         Static prototype (viewable on GitHub Pages)
├── index.html            Home — split-screen hero + editorial sections
├── shop.html             Shop — floating catalogue + 2/3/4/5 density switch
├── product.html          Product — gallery, variants, dual CTA, accordion
├── contract.html         Contract — hero, capabilities, service levels, form
│
├── wp-content/themes/neldra/   The real WordPress + WooCommerce theme
│   └── assets/                 Shared CSS / JS / fonts / SVG placeholders
│
└── docs/                 The full written plan (below)
```

## The written plan

| # | Doc | Covers |
|---|-----|--------|
| 01 | [Architecture](./docs/01-architecture.md) | Stack, theme approach, plugins, hosting, performance, i18n |
| 02 | [Design System](./docs/02-design-system.md) | Color, typography, spacing, grid, components, image treatment |
| 03 | [Sitemap & Pages](./docs/03-sitemap-and-pages.md) | Every page, section by section |
| 04 | [Motion / Animation](./docs/04-animations.md) | Split-screen + all site motion, with timings |
| 05 | [WooCommerce & Contract](./docs/05-woocommerce-and-contract.md) | Product model, order flow, Contract lead flow |
| 06 | [Build Roadmap](./docs/06-roadmap.md) | Phased delivery plan |
| 07 | [Open Questions](./docs/07-open-questions.md) | Decisions still needed |

## Decisions locked in
- **Fonts:** headlines **TRT Cenzo Demo Light** (drop-in slot wired; **Jost** stand-in until you add the licensed file), body **Montserrat Light** (self-hosted). Both cover Hungarian.
- **Currency:** EUR + HUF. **Languages:** EN + HU (theme is i18n-ready, latin-ext fonts included).
- **Catalogue:** built with the single sofa (the "N01" test piece) + placeholders until the other products' photography is ready.

## Theme install
See [`wp-content/themes/neldra/README.md`](./wp-content/themes/neldra/README.md).

## Status
**Prototype + theme foundation built and visually verified** (desktop + mobile). Next up per the [roadmap](./docs/06-roadmap.md): wire WooCommerce checkout, the Contract form plugin, real product data & photography, and swap the vanilla motion for GSAP + Lenis in production.
