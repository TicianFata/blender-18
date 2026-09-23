# 03 — Sitemap & Page Plans

## Sitemap

```
HOME  (split-screen entrance: SHOP | CONTRACT)
│
├── SHOP                         WooCommerce shop — all 30 products, grid-density switch
│   ├── COLLECTIONS              index of the 3 collections (editorial)
│   │   ├── Collection 01        editorial hero + 10 products
│   │   ├── Collection 02        editorial hero + 10 products
│   │   └── Collection 03        editorial hero + 10 products
│   └── /product/{name}          single product (buy OR route to Contract)
│
├── CONTRACT                     B2B landing — capability, sectors, process
│   └── START A PROJECT          multi-step project request form (lead gen)
│
├── PROJECTS                     portfolio index (case-study cards)
│   └── /project/{name}          single project case study
│
├── ABOUT                        studio / brand story / design & production
│
├── Utility:  SEARCH  ·  CART  ·  CHECKOUT  ·  ACCOUNT (scope TBD)
└── Legal/Support: Privacy, Terms, Shipping & Returns, Contact, FAQ (scope TBD)
```

Two commercial paths must stay legible everywhere: **SHOP = buy finished pieces online. CONTRACT = project-based supply/modification/custom.**

---

## Global — Navigation & header

- Overlay nav on the homepage (over the hero); adapts to dark-on-white on internal pages. Same type + spacing language throughout.
- Layout: `NELDRA` (logo, restrained size) · center/left links `SHOP COLLECTIONS CONTRACT PROJECTS ABOUT` · right `SEARCH  CART(n)`.
- Search opens a full-screen quiet overlay (type → results as small floating product/project cards).
- Cart: slide-in drawer (right), minimal, matches the white system.
- Footer: quiet typographic block — newsletter (optional), primary links, legal, socials, locale switch (if multilingual). Final links TBD.

---

## HOME — the architectural entrance

**Screen 1 — Split-screen hero (full viewport)**
- Two panels: **LEFT = SHOP** (finished Neldra product on white / controlled editorial), **RIGHT = CONTRACT** (architectural interior — hotel/restaurant/large install).
- Starts ~50/50. Hovering a side moves the **actual boundary** (e.g. 65/35), eased 500–800ms; subtle image scale/parallax within. Click enters that side. (Full behavior + reduced-motion + mobile tap in [04 Animations](./04-animations.md).)
- Minimal label per panel: `SHOP` / `CONTRACT` + one line of intent ("Finished pieces, made to order" / "Furniture for projects, at scale").

**Below the fold (scroll reveals, calm rhythm):**
1. Brand statement — one large Cenzo line: *"A furniture design & production studio."* + short paragraph.
2. Featured pieces — a few floating catalogue products (teasers into Shop).
3. Collections teaser — the 3 collections as large editorial blocks.
4. Contract teaser — one huge architectural image + "Furniture for projects, at scale." → CONTRACT.
5. Projects teaser — 2–3 recent projects (big imagery).
6. Footer.

Rhythm = image → whitespace → title → short text → whitespace → image. Never crowded.

---

## SHOP (WooCommerce archive)

- Light intro (title + one line), then the **product grid**.
- **Grid-density switch: 2 / 3 / 4 / 5 columns** (changes density only, keeps proportions). Mobile: 1–2 cols.
- Product cards are borderless, small/medium, floating on white, generous gutters — "quiet curated catalogue," not a dense shop.
- Filters kept minimal & quiet: by Collection, by type/category, maybe by finish. No noisy sidebar.
- Card hover: cross-fade to alternate image + 2–4% scale; name/price stay put.
- Card shows: image, product name (Montserrat), price, "Made to order" micro-label.

---

## COLLECTIONS

**Index page:** the 3 collections as full-width editorial panels (huge image + name + one line), each → its collection page.

**Single collection page (editorial catalogue feel):**
```
COLLECTION 01
[ LARGE EDITORIAL IMAGE — dominant ]
short collection description (restrained)
… generous whitespace …
[ PRODUCT GRID — 10 products, small & spacious ]
```
Products begin well down the page after the hero breathes. Same density switch as Shop.

---

## PRODUCT PAGE (single product)

Answers practical buying questions without clutter.

**Layout:** large gallery left/top, quiet info column right/below.
- **Gallery:** multiple large images (hero → alt/side → detail → material/finish → in-situ → dimensions). Minimal navigation, no heavy carousel UI. Images float on white.
- **Info column:**
  - Product name (Cenzo or restrained Montserrat), price
  - Short description
  - Variants: finish / material / size selectors (WooCommerce variations)
  - Quantity
  - **Primary CTA: ADD TO CART**
  - **Secondary CTA: FOR PROJECTS / REQUEST PROJECT QUOTE** → prefilled Contract form (this product)
  - "MADE TO ORDER" positioning + production time (when confirmed)
- **Expandable thin-rule sections:** Description · Materials · Dimensions · Finishes · Production · Shipping · Assembly · Care · Warranty (+ technical docs only where files exist).
- **Related:** other pieces in the same collection.

The dual CTA is the hinge between the two business models: 1 chair → cart; 80 chairs → project.

---

## CONTRACT (landing)

Architectural, project-focused — reads like a design studio, not a shop.

1. **Hero statement:** *"FURNITURE FOR PROJECTS, AT SCALE."* over large architectural imagery. Primary CTA `START A PROJECT`.
2. **Who Neldra works with (sectors):** Architecture · Hospitality · Hotels · Restaurants · Offices · Residential · Retail · Developers — as quiet type or small imagery.
3. **What Neldra can do:** Standard products in quantity · Modified products · Custom furniture · Custom collections · Large-scale production · Project delivery (& installation where included).
4. **Service levels:** L1 Standard · L2 Modified · L3 Custom (Custom Collection = larger Custom scope).
5. **Process:** Brief → Design direction → Concept → 3D → Technical → Quote → Prototype → Approval → Production → QC → Logistics → Installation (as a restrained horizontal/scroll sequence).
6. **Selected projects** teaser → PROJECTS.
7. **CTA repeat:** `START A PROJECT`.

**START A PROJECT — multi-step form** (contact → project → scale → needs → description → files). Full fields in [05](./05-woocommerce-and-contract.md). Qualifies the lead before first conversation.

---

## PROJECTS

- **Index:** architecture/design portfolio feel — large images, minimal text. Card = NAME / LOCATION / YEAR (+ sector). Optional filter by sector.
- **Single project (visual case study):** big hero → gallery → concise metadata (location, year, sector, scope, products/units, custom vs modified) → optional narrative → CTA `START A PROJECT`. Closes the loop: project → portfolio → new leads.

---

## ABOUT

Positions Neldra as a **design & production studio** (not "a webshop"). Sections: brand statement, design philosophy, materials & making/production capability, the two divisions (Collection + Contract), studio/contact. Large imagery, lots of air. Contact details + link to both `SHOP` and `START A PROJECT`.

---

## Utility / system pages
- **Cart / Checkout:** WooCommerce, restyled to the white system — minimal fields, calm. Order confirmation communicates *made-to-order* + production→delivery status language.
- **Account:** scope TBD (order history, project enquiries) — see Open Questions.
- **Search results, 404, Legal/Support:** styled to the same system; final content TBD.
