# 02 — Design System

The design system exists to enforce the non-negotiables: **white is the field, furniture is the hero, whitespace is a feature, motion is quiet.** Everything below is a token or rule the theme will implement in CSS custom properties.

## Color

The site is a **white architectural gallery**. Color is almost absent by design.

| Token | Value | Use |
|-------|-------|-----|
| `--c-bg` | `#FFFFFF` | Dominant background / the "field" |
| `--c-bg-soft` | `#F7F7F6` | Secondary sections, subtle blocking |
| `--c-grey-light` | `#E8E9EA` | Hairline dividers, disabled states |
| `--c-grey-mid` | `#A5A7A9` | Secondary/quiet text, metadata |
| `--c-text` | `#161616` | Primary text, near-black |
| `--c-line` | `rgba(22,22,22,0.10)` | Extremely subtle borders |

**Cold accent (optional, sparing):** only if an accent is ever needed, it must be cold + desaturated — a blue-grey / pale steel like `#8A97A0` treated as a *material tone*, never a marketing color. No bright/saturated anything. No gradients, no glows.

> Rule: if a screen has more than three grey values visible at once, something is wrong.

## Typography

### Fonts
- **Headlines / editorial titles:** **Cenzo** (the Novenima look), Light weight. Wide letter-spacing, uppercase for the most editorial moments (matches the NELDRA wordmark).
- **Everything else** (body, product info, nav, UI): **Montserrat Light**, self-hosted (SIL OFL — free for commercial use).

### ⚠️ Font licensing — action needed
The **"TRT Cenzo DEMO"** you referenced is a **personal-use-only demo / "mini edition" with a limited glyph set (~58 characters — display caps only, no full accented/lowercase set).** It is **not licensed for a commercial website** and would break on any accented text (e.g. Hungarian á, ő, ű). Options:

1. **License the full retail "Cenzo" family** (by Truetype; commercial print + web license available) — the correct production choice. Confirm the web-font license covers self-hosting + your pageview volume, and that it includes full Latin + any accents you need.
2. **Prototype now with a close free alternative** so we can build immediately, then swap in the licensed Cenzo before launch (a `--font-display` variable makes this a one-line change). Good free stand-ins with a similar thin, wide, architectural feel: *Cormorant*, *Fraunces (light optical)*, or a light grotesk like *Space Grotesk*/*Archivo* if you prefer sans.

**I need your call on this — see [Open Questions](./07-open-questions.md).** Until confirmed, the build will treat Cenzo as `--font-display` with a graceful fallback.

### Type scale (desktop → fluid via `clamp()`)
| Role | Font | Size (desktop) | Tracking | Notes |
|------|------|----------------|----------|-------|
| Display / hero title | Cenzo Light | 64–120px (`clamp`) | +0.04em, often UPPERCASE | Huge editorial moments only |
| Section title | Cenzo Light | 40–64px | +0.03em | Collection/Projects intros |
| Product name | Montserrat Light | 16–18px | +0.02em | Restrained, never shouty |
| Body | Montserrat Light | 15–16px, line-height 1.7 | normal | Long-form, generous leading |
| Meta / labels / nav | Montserrat Light | 12–13px | +0.12em, UPPERCASE | Nav, price labels, product meta |

Hierarchy comes from **scale + space + tracking**, not from many weights or colors.

## Spacing & layout

- **8px base unit.** Section vertical rhythm is large: sections separated by `--space-2xl` (≈ 120–200px desktop, 64–96px mobile). Pages must *breathe*.
- **Max content width** ~1600px, but editorial imagery goes **full-bleed** (edge to edge).
- **Grid:** 12-column with wide gutters for content; imagery frequently breaks the grid to full-viewport.
- Whitespace is treated as a component — never "filled" to look busy.

## The white-blend image treatment (core brand move)

Catalogue product images must **dissolve into the page** — no visible rectangle, furniture appears to float.

Implementation plan:
1. Product studio shots are shot/prepared on pure or near-pure white (the provided sofa images already are).
2. Serve as PNG/WebP with the background matched to `--c-bg` (`#FFFFFF`); no borders, no card background, no drop shadow box.
3. Where a shot's white is slightly off, normalize in processing so the corners read as `#FFFFFF`; optionally a soft mask/feather at edges.
4. The furniture's own soft contact shadow (already present in the provided images) is what grounds it — we keep that, add none of our own.

Result: `WHITE PAGE → furniture → WHITE PAGE`, no seam.

## Imagery scale rhythm (deliberate contrast)

| Context | Image scale |
|---------|-------------|
| Homepage hero | Near full-viewport, edge-to-edge |
| Collection hero | Huge editorial |
| Projects | Huge |
| **Product catalogue grid** | **Intentionally small/medium + lots of whitespace** |
| Product page gallery | Large again |

This big↔small contrast is the visual rhythm of the site.

## Core components (theme parts)

- **Overlay nav** — logo left, SHOP / COLLECTIONS / CONTRACT / PROJECTS / ABOUT center-or-left, SEARCH + CART right. Lightweight, sits over the hero; adapts (dark text) on white internal pages. Not a heavy bar.
- **Split-screen hero** — two panels with a moving boundary (see [04 Animations](./04-animations.md)).
- **Product card** — borderless: floating image + name + price + (subtle) hover to alternate image. No card chrome.
- **Grid-density switch** — 2/3/4/5 column control that changes density only, never distorts proportions. Responsive: mobile offers fewer options.
- **Expandable info sections** — thin-rule accordions for Description/Materials/Dimensions/etc. on the product page.
- **Dual CTA block** — primary `ADD TO CART` + secondary `FOR PROJECTS / REQUEST PROJECT QUOTE`.
- **Project card** — big image + NAME / LOCATION / YEAR only.
- **Footer** — quiet, typographic; final structure TBD (see Open Questions).

## Responsive philosophy
Mobile is not a shrink of desktop — it **preserves hierarchy, whitespace and calm**. The split hero becomes two stacked full-width sections (tap to emphasize/select, then enter). Grids drop to fewer columns while keeping generous spacing.

## Motion tone
Restrained, eased, compositor-only. Full spec in [04 — Animations](./04-animations.md). `prefers-reduced-motion` always honored.
