# 05 — WooCommerce & Contract

Two distinct purchasing processes, one brand. A normal buyer must never be forced through a project brief; a project client must never be forced through consumer checkout.

---

## A. SHOP — WooCommerce setup

### Catalogue structure
- **30 products**, grouped by custom taxonomy **`collection`**: Collection 01 / 02 / 03 (10 each).
- Also standard product **categories** by type (e.g. Sofas, Chairs, Tables, Lounge, Storage) for filtering/search.
- Product type: **Variable product** where finish/material/size apply; Simple where not.

### Product fields
**Native WooCommerce:** name, price, short description, long description, gallery images, SKU (e.g. `N01`), variations (finish, material, size), stock = *made-to-order* (see below), dimensions/weight (for shipping).

**ACF extra fields** (surfaced as expandable sections):
- Materials, Finishes (with swatch label/image), Dimensions (structured: W×D×H, seat height, etc.), Production time, Shipping info, Assembly info, Care, Warranty, Technical docs (file — shown only if present), In-situ/editorial images.

### Made-to-order positioning
- Products are **produced after ordering**, not warehouse stock. Configure via **"Backorder"/on-demand** or a made-to-order/pre-order approach so items are always purchasable and messaged as *"Made to order — produced specifically for your order."*
- Display **production time / lead time** once commercially confirmed (do not invent numbers).

### Standard order flow (customer-facing → back-end)
```
PRODUCT → CART → CHECKOUT → PAYMENT → ORDER CONFIRMED
                                          │  (back-end)
                                          ▼
                 PRODUCTION → QC → PACKAGING → DELIVERY → DELIVERED
```
- **Cart:** products, qty, subtotal, VAT, shipping, total.
- **Checkout:** name, email, phone, billing + shipping address, optional company.
- **Confirmation:** order number + line items + status `ORDER CONFIRMED` (e.g. `ORDER #1047 — N01 Chair × 2`).
- **Order statuses:** extend WooCommerce with custom statuses to mirror the real workflow — `Confirmed → In Production → Quality Control → Packaging → Shipped → Delivered` (customer sees friendly status; internal team drives it). Statuses are optional/phase 2 but planned for.
- **Payments:** Stripe (cards + Apple/Google Pay), optional PayPal. Currency EUR assumed (spec uses € / Budapest) — confirm.
- **VAT/tax:** configure per the business's country + EU rules — needs accountant input (Open Questions).

### The dual CTA on product pages
- **ADD TO CART** (primary consumer path).
- **FOR PROJECTS / REQUEST PROJECT QUOTE** (secondary) → opens the Contract "Start a Project" form **pre-filled with this product** (and optionally the quantity if the user typed a large one). This is the bridge: same product, two journeys.

---

## B. CONTRACT — lead generation (NOT checkout)

Contract turns a visitor into a **qualified project lead**. No cart, no online price — a project quotation happens off-site after conversation.

### Service levels
- **L1 Standard** — existing product in project quantity (e.g. 100 × N01). Needs: qty quote, schedule, logistics, coordination.
- **L2 Modified** — existing design adapted (e.g. widened 50mm, new finish). Neldra assesses feasibility first.
- **L3 Custom** — new furniture: Concept → 3D → Engineering → Prototype → Approval → Production.
- **Custom Collection** — several coherent pieces developed as one project (larger Custom scope).

### "START A PROJECT" form (multi-step)
Built with Gravity/WPForms; multi-step, conditional, file uploads. Fields:

**Step 1 — Contact:** Name · Company · Email · Phone · Website
**Step 2 — Project:** Project name · Location · Project type (sector)
**Step 3 — Scale:** 1–10 · 10–50 · 50–100 · 100–500 · 500+
**Step 4 — What do you need?** Existing products · Modified products · Custom furniture · Custom collection · Large-scale production · Full furniture package (multi-select)
**Step 5 — Description:** free-form requirements
**Step 6 — Files (optional):** floor plans · renders · moodboards · DWG · PDF · specs · reference images (allow large uploads; validate types/size; store securely)
**Prefill:** if arrived from a product's "For projects" CTA, capture that product (+qty) automatically.

### On submission
- Store entry + email the Neldra team (and auto-acknowledge the client).
- Optional: push to CRM (HubSpot/Pipedrive) — see Open Questions.
- Internal qualification reviews: suitability, products, quantities, standard/modified/custom, materials, deadline, location, capacity, technical needs, prototype/sample needs.

### Contract process (shown on page as a sequence)
```
Brief → Design direction → Concept → 3D → Technical dev → Quote
   → Prototype → Client approval → Production → QC → Logistics → Installation*
                                                          (*if in scope)
```
Payments for Contract are **staged** (Deposit → Design/Prototype approval → Production → Final) — handled commercially/contractually, **not** via WooCommerce checkout. The website only needs to communicate this, not process it.

---

## C. Projects (portfolio) — the business loop

Custom post type `project`:
- Fields: hero image, gallery, name, **location**, **year**, **sector** (taxonomy), scope, products/units used, custom-vs-modified, optional narrative, client permission flag.
- Feeds the loop: Project → published case study → architects discover → new Contract enquiry.
- Completed products from custom work may later become standard Collection products (optional long-term path).

---

## D. Content the client must provide
- Real product data for the 30 pieces (names, prices, descriptions, materials, finishes, dimensions, production times) — currently only the test sofa exists.
- Catalogue photography (clean, on white, consistent art direction) + editorial/collection heroes + Contract architectural imagery + project photos.
- Copy for About, Contract, Collections intros, legal/support pages.
