# Translations (EN / HU)

The theme is fully internationalised — every UI string uses the `neldra` text
domain (`__()`, `esc_html_e()`, etc.).

## To enable Hungarian

1. Install **Polylang** (or WPML). The header language switch and
   `footer.php` already integrate with `pll_the_languages()` when Polylang is
   active; otherwise a static EN/HU control is shown.
2. Generate the translation template:
   ```
   wp i18n make-pot . languages/neldra.pot
   ```
3. Create `neldra-hu_HU.po` / `.mo` from the POT and translate.
4. Content (products, projects, pages) is translated inside Polylang/WPML.

The self-hosted fonts (Jost + Montserrat) already include the **latin-ext**
subset, so Hungarian accents (á é í ó ö ő ú ü ű) render correctly. Confirm the
licensed **TRT Cenzo** file also covers latin-ext before launch.
