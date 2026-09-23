# 04 — Motion / Animation Spec

Guiding rule: **motion communicates quality, not complexity.** Everything is eased, compositor-only (`transform`/`opacity`), and fully disabled under `prefers-reduced-motion`. No bounce, spin, particles, glow, or heavy parallax.

## Motion tokens
| Token | Value | Use |
|-------|-------|-----|
| `--ease-brand` | `cubic-bezier(0.22, 1, 0.36, 1)` (expo-out feel) | Reveals, panel expansion |
| `--ease-soft` | `cubic-bezier(0.4, 0, 0.2, 1)` | UI, hovers |
| `--dur-fast` | 200ms | Hover, small UI |
| `--dur-base` | 400ms | Reveals, fades |
| `--dur-slow` | 650ms | Split-screen boundary, page transitions |
| Scroll smoothing | Lenis, lerp ≈ 0.08–0.1 | Deliberate, not floaty |

Stagger for grouped reveals: 60–90ms between items.

---

## 1. Split-screen hero (signature interaction)

**Structure:** two panels in a flex row; the boundary is real (panel widths animate), not just image zoom inside fixed boxes.

**Desktop behavior**
- Default `50% / 50%`.
- Pointer over SHOP → SHOP grows to ~`62–65%`, CONTRACT shrinks to ~`35–38%`; reverse on the other side.
- Transition: width via `flex-basis`/`transform` over **550–700ms** with `--ease-brand`. Tune visually within the 500–800ms guidance.
- Inside the expanding panel, image scales very subtly (`scale(1.0 → ~1.04)`) and/or shifts a few px — restrained.
- Panel label (`SHOP` / `CONTRACT`) + one-line intent fade/track slightly on expand.
- Click / Enter → page transition into that side.
- Implementation note: animate with `transform: scaleX` on layered wrappers or `flex-grow` tween via GSAP; avoid animating `width` on heavy image nodes directly (jank). Prefer a GPU-friendly technique + `will-change`.

**Keyboard/a11y:** panels are real links/buttons — Tab to focus, visible focus ring, Enter to enter. Focusing a panel triggers the same expand as hover.

**Mobile / touch:** no hover → two stacked full-width sections (SHOP over CONTRACT). First tap emphasizes/selects (subtle scale + label emphasis), second tap (or a clear "Enter" affordance) navigates. Alternatively single-tap enters with a brief press-state. Keep both sections large.

**Reduced motion:** static 50/50, no scale; hover just changes label emphasis. Fully usable.

---

## 2. Page transitions
- Barba.js (or custom fetch-swap): outgoing content fades/slides out ~300ms, incoming fades/rises in ~400–500ms, so Shop→Product feels like one continuous white space.
- Split-screen → destination: the chosen panel can expand to full width as the transition cover, then reveal the new page (premium "enter the room" moment).
- Must degrade to normal navigation if JS fails.

---

## 3. Scroll reveals
- Sections/images/titles fade + rise (`opacity 0→1`, `translateY 24–40px → 0`) on entering viewport, `--dur-base`, `--ease-brand`, once.
- Grouped items (product grid, project cards) stagger 60–90ms.
- Editorial titles may reveal by line/word (subtle), not letter-by-letter theatrics.
- Restrained parallax only on large editorial images (a few % of travel), never on text or UI.

---

## 4. Product & catalogue motion
- **Card hover:** cross-fade to alternate image + `scale(1.02–1.04)`, `--dur-fast`/`--ease-soft`. Name & price do not move.
- **Grid-density switch (2/3/4/5):** items re-flow with a smooth FLIP-style position/scale tween (~400ms); proportions never distort.
- **Gallery (product page):** soft cross-fade between images; minimal, near-invisible nav; optional subtle zoom-on-view for detail shots.

---

## 5. Navigation & overlays
- **Menu / search overlay:** full-screen quiet reveal — background fades in, links stagger up 60ms each, `--ease-brand`.
- **Cart drawer:** slides in from right `--dur-base`, contents fade/stagger.
- **Nav on scroll (internal pages):** may condense subtly; color adapts from over-hero to dark-on-white without a jarring bar appearing.

---

## 6. Micro-interactions
- Buttons/links: quiet underline draw or opacity shift on hover (`--dur-fast`), no glow.
- Custom cursor (optional, desktop only): a small dot that grows softly over interactive/drag areas — very restrained, off on touch & reduced-motion.
- Form steps (Contract): steps cross-fade horizontally; progress indicator updates calmly.

---

## Performance & QA rules
- Animate only `transform`/`opacity`; use `will-change` sparingly and remove after.
- Target 60fps; test the split-screen on mid-tier laptop + mobile.
- Everything degrades: no-JS = usable site; reduced-motion = calm static site.
- Lazy-load below-fold media; never animate an element before its image has reserved space (no layout shift).
