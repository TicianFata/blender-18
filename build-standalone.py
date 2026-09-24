#!/usr/bin/env python3
"""Inline CSS + JS + fonts + SVGs into single self-contained HTML files."""
import base64, re, pathlib

ROOT = pathlib.Path("/projects/sandbox")
ASSETS = ROOT / "wp-content/themes/neldra/assets"
FONTS = ASSETS / "fonts"

def b64(path):
    return base64.b64encode(path.read_bytes()).decode()

# --- Build fonts CSS with base64 data URIs ---
fonts_css = (FONTS / "fonts.css").read_text()
# drop the Cenzo drop-in @font-face (file not present)
fonts_css = re.sub(r'/\* --- TRT Cenzo Demo.*?\}\n', '', fonts_css, flags=re.S)
for name in ["jost-latin.woff2", "jost-latin-ext.woff2",
             "montserrat-latin.woff2", "montserrat-latin-ext.woff2"]:
    data = "data:font/woff2;base64," + b64(FONTS / name)
    fonts_css = fonts_css.replace(f'url("{name}")', f'url({data})')

# --- Main CSS: replace @import with inlined fonts CSS ---
css = (ASSETS / "css/neldra.css").read_text()
css = css.replace('@import url("../fonts/fonts.css");', fonts_css)

# --- JS ---
js = (ASSETS / "js/neldra.js").read_text()

# --- SVGs as data URIs ---
def svg_data(name):
    return "data:image/svg+xml;base64," + b64(ASSETS / "img" / name)
sofa = svg_data("sofa.svg")
interior = svg_data("interior.svg")

PREFIX = "wp-content/themes/neldra/assets"
# Product photos are large; reference them from the public repo raw URL
# instead of base64-embedding megabytes into every standalone file.
RAW_IMG = "https://raw.githubusercontent.com/TicianFata/blender-18/main/wp-content/themes/neldra/assets/img/"

def build(src_name):
    html = (ROOT / src_name).read_text()
    # remove font preloads
    html = re.sub(r'\s*<link rel="preload"[^>]*>\n', '\n', html)
    # inline stylesheet (function replacement avoids backslash interpretation)
    html = re.sub(r'<link rel="stylesheet"[^>]*>',
                  lambda _: f'<style>\n{css}\n</style>', html)
    # inline script
    html = re.sub(r'<script src="[^"]*neldra\.js[^"]*"></script>',
                  lambda _: f'<script>\n{js}\n</script>', html)
    # product photos -> raw repo URL (keeps standalone files small)
    html = html.replace(f'{PREFIX}/img/products/', RAW_IMG + 'products/')
    # inline the small vector placeholders as data URIs (offline-friendly)
    html = html.replace(f'{PREFIX}/img/sofa.svg', sofa)
    html = html.replace(f'{PREFIX}/img/interior.svg', interior)
    out = ROOT / "standalone" / src_name
    out.parent.mkdir(exist_ok=True)
    out.write_text(html)
    return out, len(html.encode())

for page in ["index.html", "shop.html", "product.html", "contract.html"]:
    out, size = build(page)
    print(f"{out.relative_to(ROOT)}  ({size//1024} KB)")
