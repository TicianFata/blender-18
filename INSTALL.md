# Deploying NELDRA to your WordPress + WooCommerce

Everything is already a real WordPress theme (`wp-content/themes/neldra/`). You install it, add WooCommerce, and configure a few pages/menus. The static `*.html` files at the repo root are **only the preview** — WordPress does not use them; ignore them for the live site.

Download the theme here:
**`neldra-theme.zip`** → https://github.com/TicianFata/blender-18/blob/main/neldra-theme.zip (click **Download raw file**).

---

## 0. Choose your WordPress type (important)

- **Self-hosted WordPress.org** (a host like Hostinger, SiteGround, Kinsta, Cloudways, WP Engine, etc.) → **recommended.** Full control: custom themes + WooCommerce + plugins all allowed. Follow every step below.
- **WordPress.com** → custom theme upload + WooCommerce require the **Business or Commerce plan**. Free/Personal/Premium **cannot** upload this theme or run WooCommerce. If you're on .com, upgrade to Business+ first, then the steps are the same (Appearance → Themes → Upload).

If you don't have hosting yet: buy a hosting plan that offers **1-click WordPress install** + PHP 8.1+ + MySQL/MariaDB.

---

## 1. Install WordPress
Use your host's 1-click WordPress installer (or install manually). Log in at `yourdomain.com/wp-admin`.

## 2. Install WooCommerce
1. **Plugins → Add New**, search **WooCommerce** → **Install** → **Activate**.
2. Run the WooCommerce setup wizard:
   - Store address / country.
   - **Currency: EUR** (this is the base currency).
   - Product type: Physical.
3. WooCommerce auto-creates the **Shop, Cart, Checkout, My Account** pages. Leave them — the theme styles them.

> **HUF as well:** WooCommerce has one *base* currency. To show **EUR + HUF**, add a free multi-currency plugin (e.g. **CURCY – Multi Currency for WooCommerce**) after setup, and add HUF as a second currency with your exchange rate.

## 3. Upload & activate the Neldra theme
1. **Appearance → Themes → Add New → Upload Theme**.
2. Choose **`neldra-theme.zip`** → **Install Now** → **Activate**.
   (The theme ships with the fonts and the placeholder sofa photos, so it looks right immediately.)

## 4. Setup is automatic on activation ✨
As soon as you activate the theme it **auto-creates** everything so the site matches the design:
- Creates **Home** and sets it as the static front page (split-screen hero).
- Creates the **Contract** page *with the Contract template already assigned* (hero, capabilities, service levels, process, request form).
- Creates the **About** page.
- Builds the **primary menu** — Shop · Collections · Contract · Projects · About — and assigns it.
- Flushes permalinks so **/contract/**, **/projects/**, **/shop/** all resolve.

Then just re-save permalinks once to be safe: **Settings → Permalinks → Save Changes.**

> It never duplicates: if a page/menu already exists it's reused. Edit or reorder anything under **Pages** / **Appearance → Menus**. Shop & Product pages come from **WooCommerce** (next step) and are already styled to the Neldra design (3-up floating grid + density switch on the shop, gallery-left / info-right + dual CTA on the product).

## 9. Add products (this fills Shop / Collections / Product pages)
1. **Products → Categories:** these are your product types (Sofas, Chairs, …) — optional.
2. **Create the collection grouping:** the theme registers a **Collections** taxonomy. Go to **Products → Collections** and add **Collection 01, Collection 02, Collection 03**.
3. **Products → Add New** for each piece:
   - Name, price, description.
   - **Product image** + **Product gallery** (these appear on the product page + zoom lightbox).
   - Assign a **Collection** (right sidebar).
   - Variations (finish / material) → set the product type to **Variable product** and add attributes/variations.
   - Set **"Made to order"** by allowing backorders (Inventory tab) or leaving stock management off.
4. The **Shop** page now lists them with the 2/3/4/5 density switch; each product page has **Add to cart** + **For projects** CTAs.

## 10. Add projects (fills the Projects page)
1. In the admin sidebar you'll see **Projects** (added by the theme). **Projects → Add New**.
2. Title, a short **excerpt** (kept minimal), a **Featured image** (the big photo).
3. Optional detail fields (location, year, category) via **ACF** (see plugins below) or the native **Custom Fields** panel using keys `location`, `year`, `category`.
4. `/projects/` renders them automatically (newest first) with parallax + reveals.

## 11. Recommended plugins
| Purpose | Plugin |
|---|---|
| Custom fields (product/project extras) | **ACF (Advanced Custom Fields)** |
| Contract "Start a Project" form + file uploads | **WPForms** or **Gravity Forms** |
| Multi-currency (EUR + HUF) | **CURCY – Multi Currency for WooCommerce** |
| Languages (EN + HU) | **Polylang** (theme is already integrated) |
| SEO | **Rank Math** or **Yoast** |
| Speed/cache | **WP Rocket** / your host's caching + an image optimizer (WebP) |
| Payments | **WooCommerce Stripe** (cards, Apple/Google Pay) |

## 12. Wire the Contract form (real submissions)
1. Build a form in **WPForms/Gravity** (fields per the page: contact, project type, scale, needs, description, file upload).
2. Copy its **shortcode**.
3. Tell the theme to use it: add this once (Tools → or via a snippet plugin), replacing the shortcode:
   ```php
   update_option( 'neldra_contract_form_shortcode', '[your_form_shortcode]' );
   ```
   The Contract page then renders your real form (with email/CRM delivery + uploads) instead of the visual placeholder.

## 13. Newsletter (homepage "Be the First to Know")
Connect Mailchimp/Klaviyo/etc. Easiest: use their WordPress plugin/embed, or point the form at your provider. (Currently it just shows an on-screen "thank you.") Tell your developer which provider and it's a small wiring job.

## 14. The headline font (before launch)
The theme uses a drop-in slot for the licensed **TRT Cenzo** file. Once you have the licensed `.woff2`, upload it to:
`wp-content/themes/neldra/assets/fonts/trt-cenzo-demo-light.woff2`
(via your host's File Manager / FTP, or a "File Manager" plugin). It's picked up + preloaded automatically. Until then it falls back to **Jost**.

---

## Editing your content (no code) — Appearance → Customize
Every piece of copy and each placeholder image is now editable in **Appearance → Customize**, with live preview. Panels:

- **Appearance & colors** — the whole palette via colour pickers (background, soft background, greys, text, secondary text, dark sections, text-on-dark, cold accent). **Layout & spacing** — content max-width + section rhythm (Compact / Default / Spacious).
- **Homepage** — Hero (Shop side / Contract side: eyebrow, title, intro, CTA, **image**), Brand statement, Featured heading, **Collections split** (3 panels: label, meta, **image**), Contract teaser (titles, lead, button, **image**), Projects teaser, Newsletter — **plus a "Section order & visibility" panel** to show/hide and reorder every homepage section.
- **Shop page** — eyebrow, title, intro, **default column count (2–5)**, and a toggle for the density switch.
- **Contract page** — Hero (+ **image**), "What Neldra can do" (all 6 rows), Service levels (all 3), Process (all 6 steps), Request-form headings.
- **Projects page** — Hero + all 5 category rows/counts, closing CTA.
- **Footer** — tagline.

Images use a normal media picker (upload or choose from the library). Leave a field blank to fall back to the built-in default. Colour/spacing changes apply site-wide instantly (live preview).

Also editable as usual:
- **Products, prices, variants, stock, orders, coupons** → WooCommerce.
- **Projects** (case studies) → the **Projects** post type (title, excerpt, featured image; optional `location` / `year` / `category` custom fields).
- **About** / any normal page → the block editor.
- **Menus, site title, logo** → Appearance → Menus / Customize → Site Identity.
- **Collections** grouping → Products → Collections.

> Tip: the **Contract "Start a Project" form** and the **newsletter** still need a plugin connected to actually receive submissions (see steps 12–13). Everything else is fully editable from the dashboard.

---

## Moving the whole thing between hosts later
Use a migration plugin (**All-in-One WP Migration** or **Duplicator**) to export/import the full site (theme + products + projects + settings + media) in one package.
