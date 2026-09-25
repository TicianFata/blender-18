/* Neldra Sections — split hero, collections hover, parallax, reveals.
   Dependency-free; only touches elements inside a .neldra wrapper. */
(function () {
  "use strict";
  var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var coarse = window.matchMedia("(pointer: coarse)").matches;
  var $  = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  function initHero() {
    $$("[data-hero]").forEach(function (hero) {
      var panels = $$(".nl-panel", hero);
      function activate(name) {
        hero.setAttribute("data-hover", name);
        panels.forEach(function (p) { p.classList.toggle("is-active", p.getAttribute("data-panel") === name); });
      }
      function clear() { hero.removeAttribute("data-hover"); panels.forEach(function (p) { p.classList.remove("is-active"); }); }
      panels.forEach(function (panel) {
        var name = panel.getAttribute("data-panel");
        if (!coarse) {
          panel.addEventListener("mouseenter", function () { activate(name); });
          panel.addEventListener("focus", function () { activate(name); });
        }
        panel.addEventListener("click", function (e) {
          if (coarse && !panel.classList.contains("is-active")) { e.preventDefault(); activate(name); }
        });
        if (!coarse && !reduce) {
          var media = $(".nl-panel__media", panel);
          panel.addEventListener("mousemove", function (e) {
            var r = panel.getBoundingClientRect();
            var dx = (e.clientX - r.left) / r.width - 0.5, dy = (e.clientY - r.top) / r.height - 0.5;
            if (media) media.style.transform = "scale(1.05) translate(" + (dx * -14) + "px," + (dy * -14) + "px)";
          });
          panel.addEventListener("mouseleave", function () { if (media) media.style.transform = ""; });
        }
      });
      if (!coarse) hero.addEventListener("mouseleave", clear);
    });
  }

  function initCollections() {
    $$(".nl-cols").forEach(function (split) {
      if (coarse) return;
      var panels = $$(".nl-cpanel", split);
      function activate(panel) { split.classList.add("is-hovering"); panels.forEach(function (p) { p.classList.toggle("is-active", p === panel); }); }
      function clear() { split.classList.remove("is-hovering"); panels.forEach(function (p) { p.classList.remove("is-active"); }); }
      panels.forEach(function (panel) {
        panel.addEventListener("mouseenter", function () { activate(panel); });
        panel.addEventListener("focus", function () { activate(panel); });
      });
      split.addEventListener("mouseleave", clear);
    });
  }

  function initParallax() {
    if (reduce) return;
    var els = $$(".neldra [data-parallax]");
    if (!els.length) return;
    var ticking = false;
    function update() {
      var vh = window.innerHeight;
      els.forEach(function (el) {
        var host = el.parentElement, r = host.getBoundingClientRect();
        if (r.bottom < -100 || r.top > vh + 100) return;
        var speed = parseFloat(el.getAttribute("data-parallax")) || 0.1;
        var y = -(r.top + r.height / 2 - vh / 2) * speed, max = r.height * 0.12;
        if (y > max) y = max; else if (y < -max) y = -max;
        el.style.transform = "translate3d(0," + y.toFixed(1) + "px,0)";
      });
      ticking = false;
    }
    function onScroll() { if (!ticking) { requestAnimationFrame(update); ticking = true; } }
    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", onScroll);
    update();
  }

  function initReveals() {
    var items = $$(".neldra [data-reveal]");
    if (!items.length) return;
    if (reduce || !("IntersectionObserver" in window)) { items.forEach(function (el) { el.classList.add("is-visible"); }); return; }
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add("is-visible"); io.unobserve(en.target); } });
    }, { rootMargin: "0px 0px -12% 0px", threshold: 0.08 });
    items.forEach(function (el) { io.observe(el); });
  }

  document.addEventListener("DOMContentLoaded", function () {
    initHero(); initCollections(); initParallax(); initReveals();
  });
})();
