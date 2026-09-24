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

## 4. Flush permalinks (makes /projects/ etc. work)
**Settings → Permalinks →** choose **Post name →** **Save Changes**. (Do this once now, and again any time links 404.)

## 5. Set the homepage
1. **Pages → Add New →** title **Home** → Publish.
2. **Settings → Reading → Your homepage displays → A static page →** Homepage = **Home**.
   (The theme's `front-page.php` renders the split-screen hero automatically.)

## 6. Create the Contract page (rich layout)
1. **Pages → Add New →** title **Contract** (this sets the slug `contract`, which the nav links to).
2. In the sidebar **Page Attributes → Template →** select **Contract**.
3. **Publish.** (This uses `page-contract.php` — hero, capabilities, service levels, process, request form.)

## 7. Create the About page
**Pages → Add New →** title **About** → add your text → Publish. (Uses the default page template.)

## 8. Build the menus
**Appearance → Menus →** Create menu → add these items → set location:
- **Primary Navigation:** Shop, Collections, Contract, Projects, About.
  - *Shop* = the WooCommerce Shop page. *Collections* = Shop page (or a custom link `/shop/`). *Projects* = a **Custom Link** to `/projects/`. *Contract* / *About* = your pages.
- **Footer Navigation:** whatever footer links you want.
(Until you assign a menu, the theme shows a sensible fallback menu.)

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

## What you can edit yourself (no code)
- **Products, prices, variants, stock, orders, coupons** → WooCommerce.
- **Projects** → the Projects post type.
- **About** (and any normal page) → the block editor.
- **Menus, site title, logo** → Appearance → Menus / Customize.
- **Collections** grouping → Products → Collections.

## What currently lives in the template code (ask to make no-code)
The **homepage hero copy**, the **Collections panel images/labels**, the **Contract page wording**, and the **newsletter text** are coded into the templates for pixel-perfect control. If you want to edit these from the admin too, the next step is to add **ACF fields / a Customizer panel** for them — say the word and I'll wire that in so everything is editable without touching code.

---

## Moving the whole thing between hosts later
Use a migration plugin (**All-in-One WP Migration** or **Duplicator**) to export/import the full site (theme + products + projects + settings + media) in one package.
