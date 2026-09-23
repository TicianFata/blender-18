/* ==========================================================================
   NELDRA — interactions
   Vanilla, dependency-free, progressive-enhancement.
   Production note: the split-screen + reveals mirror what GSAP/ScrollTrigger
   and Lenis will drive in the WordPress build (see /docs/04-animations.md).
   ========================================================================== */
(function () {
  "use strict";

  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var coarse = window.matchMedia("(pointer: coarse)").matches;
  var $  = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ----------------------------------------------------------------------
     Split-screen hero
     ---------------------------------------------------------------------- */
  function initHero() {
    var hero = $("[data-hero]");
    if (!hero) return;
    var panels = $$(".panel", hero);

    function activate(name) {
      hero.setAttribute("data-hover", name);
      panels.forEach(function (p) {
        p.classList.toggle("is-active", p.getAttribute("data-panel") === name);
      });
    }
    function clear() {
      hero.removeAttribute("data-hover");
      panels.forEach(function (p) { p.classList.remove("is-active"); });
    }

    panels.forEach(function (panel) {
      var name = panel.getAttribute("data-panel");

      if (!coarse) {
        panel.addEventListener("mouseenter", function () { activate(name); });
        panel.addEventListener("focus", function () { activate(name); });
      }

      // Touch: first tap previews, second tap enters.
      panel.addEventListener("click", function (e) {
        if (coarse && !panel.classList.contains("is-active")) {
          e.preventDefault();
          activate(name);
        }
      });

      // Subtle pointer parallax on the media (desktop, motion on)
      if (!coarse && !reduce) {
        var media = $(".panel__media", panel);
        panel.addEventListener("mousemove", function (e) {
          var r = panel.getBoundingClientRect();
          var dx = (e.clientX - r.left) / r.width - 0.5;
          var dy = (e.clientY - r.top) / r.height - 0.5;
          if (media) media.style.transform = "scale(1.05) translate(" + (dx * -14) + "px," + (dy * -14) + "px)";
        });
        panel.addEventListener("mouseleave", function () {
          if (media) media.style.transform = "";
        });
      }
    });

    if (!coarse) hero.addEventListener("mouseleave", clear);
  }

  /* ----------------------------------------------------------------------
     Header: overlay -> solid, hide on scroll down / show on scroll up
     ---------------------------------------------------------------------- */
  function initHeader() {
    var header = $("[data-header]");
    if (!header) return;
    var overlayStart = header.classList.contains("site-header--overlay");
    var hero = $("[data-hero]");
    var threshold = hero ? hero.offsetHeight - 120 : 120;
    var last = 0;

    function onScroll() {
      var y = window.pageYOffset;
      if (overlayStart) {
        if (y > threshold) {
          header.classList.remove("site-header--overlay");
          header.classList.add("site-header--solid");
        } else {
          header.classList.add("site-header--overlay");
          header.classList.remove("site-header--solid");
        }
      }
      // hide/show
      if (y > last && y > (overlayStart ? threshold + 200 : 200)) {
        header.classList.add("is-hidden");
      } else {
        header.classList.remove("is-hidden");
      }
      last = y;
    }
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  /* ----------------------------------------------------------------------
     Scroll reveals
     ---------------------------------------------------------------------- */
  function initReveals() {
    var items = $$("[data-reveal]");
    if (!items.length) return;
    if (reduce || !("IntersectionObserver" in window)) {
      items.forEach(function (el) { el.classList.add("is-visible"); });
      return;
    }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.classList.add("is-visible");
          io.unobserve(en.target);
        }
      });
    }, { rootMargin: "0px 0px -12% 0px", threshold: 0.08 });
    items.forEach(function (el) { io.observe(el); });
  }

  /* ----------------------------------------------------------------------
     Overlays: menu, search, cart drawer
     ---------------------------------------------------------------------- */
  function initOverlays() {
    var scrim = $("[data-scrim]");
    function open(el) { if (el) el.classList.add("is-open"); if (scrim) scrim.classList.add("is-open"); document.documentElement.style.overflow = "hidden"; }
    function close() {
      $$(".overlay, .drawer").forEach(function (el) { el.classList.remove("is-open"); });
      if (scrim) scrim.classList.remove("is-open");
      document.documentElement.style.overflow = "";
    }
    $$("[data-open]").forEach(function (btn) {
      btn.addEventListener("click", function () { open($("#" + btn.getAttribute("data-open"))); });
    });
    $$("[data-close]").forEach(function (btn) { btn.addEventListener("click", close); });
    if (scrim) scrim.addEventListener("click", close);
    document.addEventListener("keydown", function (e) { if (e.key === "Escape") close(); });
    // focus the search field when the search overlay opens
    var searchBtn = $('[data-open="search-overlay"]');
    if (searchBtn) searchBtn.addEventListener("click", function () {
      setTimeout(function () { var i = $("#search-overlay .search-input"); if (i) i.focus(); }, 300);
    });
  }

  /* ----------------------------------------------------------------------
     Grid density switch (shop / collection)
     ---------------------------------------------------------------------- */
  function initGridControl() {
    var control = $("[data-grid-control]");
    var grid = $("[data-grid]");
    if (!control || !grid) return;
    var stored = localStorage.getItem("neldra-cols");
    if (stored) setCols(stored);

    function setCols(n) {
      grid.className = grid.className.replace(/grid--\d/g, "").trim();
      grid.classList.add("grid", "grid--" + n);
      $$("button", control).forEach(function (b) {
        b.setAttribute("aria-pressed", b.getAttribute("data-cols") === String(n) ? "true" : "false");
      });
      localStorage.setItem("neldra-cols", n);
    }
    $$("button", control).forEach(function (b) {
      b.addEventListener("click", function () { setCols(b.getAttribute("data-cols")); });
    });
  }

  /* ----------------------------------------------------------------------
     Accordion (product info)
     ---------------------------------------------------------------------- */
  function initAccordion() {
    $$(".acc__head").forEach(function (head) {
      head.addEventListener("click", function () {
        var item = head.closest(".acc__item");
        var body = $(".acc__body", item);
        var open = item.getAttribute("aria-expanded") === "true";
        item.setAttribute("aria-expanded", open ? "false" : "true");
        body.style.maxHeight = open ? "0px" : (body.scrollHeight + "px");
      });
    });
  }

  /* ----------------------------------------------------------------------
     Quantity stepper
     ---------------------------------------------------------------------- */
  function initQty() {
    $$(".qty").forEach(function (q) {
      var input = $("input", q);
      $$("button", q).forEach(function (b) {
        b.addEventListener("click", function () {
          var v = parseInt(input.value, 10) || 1;
          v += b.getAttribute("data-step") === "up" ? 1 : -1;
          input.value = Math.max(1, v);
        });
      });
    });
  }

  /* ----------------------------------------------------------------------
     Language switch (visual only in the prototype)
     ---------------------------------------------------------------------- */
  function initLang() {
    var sw = $("[data-lang]");
    if (!sw) return;
    $$("button", sw).forEach(function (b) {
      b.addEventListener("click", function () {
        $$("button", sw).forEach(function (x) { x.setAttribute("aria-pressed", "false"); });
        b.setAttribute("aria-pressed", "true");
      });
    });
  }

  /* ----------------------------------------------------------------------
     Custom cursor (desktop enhancement)
     ---------------------------------------------------------------------- */
  function initCursor() {
    if (coarse || reduce) return;
    var dot = document.createElement("div");
    dot.className = "cursor";
    document.body.appendChild(dot);
    document.body.classList.add("has-cursor");
    var x = 0, y = 0, cx = 0, cy = 0;
    document.addEventListener("mousemove", function (e) { x = e.clientX; y = e.clientY; });
    (function loop() {
      cx += (x - cx) * 0.2; cy += (y - cy) * 0.2;
      dot.style.transform = "translate(" + cx + "px," + cy + "px) translate(-50%,-50%)";
      requestAnimationFrame(loop);
    })();
    $$("a, button, [data-panel]").forEach(function (el) {
      el.addEventListener("mouseenter", function () { dot.classList.add("is-hover"); });
      el.addEventListener("mouseleave", function () { dot.classList.remove("is-hover"); });
    });
  }

  /* ---------------------------------------------------------------------- */
  document.addEventListener("DOMContentLoaded", function () {
    initHero();
    initHeader();
    initReveals();
    initOverlays();
    initGridControl();
    initAccordion();
    initQty();
    initLang();
    initCursor();
  });
})();
