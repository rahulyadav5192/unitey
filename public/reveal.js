/* ================================================================
   UNITEY  ·  Scroll reveal (shared by every page)
   ----------------------------------------------------------------
   - Every .rv element reveals when its top edge crosses 88% of
     the viewport, so timing is identical on every page.
   - Elements that enter the viewport in the same frame are revealed
     as one group, staggered in reading order (row by row, left to
     right). Elements that enter on their own get no delay.
   - Once revealed, .rv-done hands transitions back to the element
     (so hover effects on cards are not delayed or overridden).
   API:  Reveal.replay(container)  — re-run reveals inside a container
         (used when switching tabs/panels).
   ================================================================ */
(function () {
  var STEP = 0.1;        // seconds between items in a group
  var MAX_STEPS = 4;     // cap so large groups never lag behind
  var DURATION = 850;    // must match .rv transition in styles.css
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var queue = [];
  var scheduled = false;

  function flush() {
    scheduled = false;
    var items = queue.map(function (el) {
      var r = el.getBoundingClientRect();
      return { el: el, row: Math.round(r.top / 60), left: r.left };
    });
    queue = [];
    items.sort(function (a, b) { return a.row - b.row || a.left - b.left });

    items.forEach(function (item, i) {
      var el = item.el;
      var delay = reduce ? 0 : Math.min(i, MAX_STEPS) * STEP;
      el.style.setProperty('--rv-delay', delay + 's');
      el.classList.add('in');
      clearTimeout(el._rvTimer);
      el._rvTimer = setTimeout(function () {
        el.classList.add('rv-done');
      }, delay * 1000 + DURATION + 50);
    });
  }

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      io.unobserve(e.target);
      queue.push(e.target);
    });
    if (queue.length && !scheduled) {
      scheduled = true;
      requestAnimationFrame(flush);
    }
  }, { threshold: 0, rootMargin: '0px 0px -12% 0px' });

  function observe(root) {
    (root || document).querySelectorAll('.rv:not(.in)').forEach(function (el) {
      io.observe(el);
    });
  }

  function replay(root) {
    if (!root) return;
    root.querySelectorAll('.rv').forEach(function (el) {
      io.unobserve(el);
      clearTimeout(el._rvTimer);
      el.classList.remove('in', 'rv-done');
    });
    void root.offsetWidth;
    observe(root);
  }

  window.Reveal = { observe: observe, replay: replay };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { observe() });
  } else {
    observe();
  }
})();
