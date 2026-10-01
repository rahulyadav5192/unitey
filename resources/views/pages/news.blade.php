<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $cms['seo']['title'] }}</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <style>
    /* HERO OVERRIDES */
    .hero-bg {
      opacity: .3
    }

    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 1;
      pointer-events: none;
      background: linear-gradient(160deg, rgba(8, 11, 28, .5) 0%, rgba(8, 11, 28, .5) 55%, rgba(14, 19, 48, .5) 100%)
    }

    .hero-in {
      max-width: 780px;
      padding-top: 140px;
      padding-bottom: 100px
    }

    /* FEATURED LATEST */
    .feat-section {
      padding: 60px 28px 0;
      background: var(--paper)
    }

    .feat-latest {
      max-width: var(--max);
      height: 100%;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 440px;
      background: var(--paper-2);
      border: 1px solid var(--line);
      border-radius: 10px;
      text-decoration: none;
      overflow: hidden;
      color: inherit;
    }

    .feat-latest-img {
      aspect-ratio: 5 / 4;
      overflow: hidden;
      position: relative
    }

    .feat-latest-img img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 1.2s var(--ease)
    }

    .feat-latest:hover .feat-latest-img img {
      transform: scale(1.04)
    }

    .feat-latest-body {
      padding: 16px 56px;
      display: flex;
      flex-direction: column;
      justify-content: center;

    }

    .feat-tag {
      font-size: 10px;
      letter-spacing: .18em;
      text-transform: uppercase;
      font-weight: 700;
      color: var(--orange);
      margin-bottom: 20px;
      display: block
    }

    .feat-latest-body h2 {
      font-size: clamp(22px, 2.4vw, 36px);
      font-weight: 800;
      letter-spacing: -.035em;
      line-height: 1.15;
      color: var(--ink);
      margin-bottom: 16px
    }

    .feat-date {
      font-size: 11px;
      color: var(--muted-2);
      letter-spacing: .06em;
      margin-bottom: 32px;
      display: block
    }

    .feat-read {
      font-size: 10px;
      letter-spacing: .18em;
      text-transform: uppercase;
      font-weight: 700;
      color: var(--navy);
      display: inline-flex;
      align-items: center;
      gap: 10px;
      border-bottom: 1px solid var(--line);
      padding-bottom: 4px;
      transition: border-color .35s var(--ease);
      align-self: flex-start
    }

    .feat-latest:hover .feat-read {
      border-color: var(--orange)
    }

    /* UNITEY INTRO */
    .unitey-intro {
      padding: 80px 28px 64px;
      text-align: center;
      background: var(--paper)
    }

    .ui-eyebrow {
      font-size: 10px;
      letter-spacing: .22em;
      text-transform: uppercase;
      font-weight: 700;
      color: var(--orange);
      margin-bottom: 16px;
      display: block
    }

    .unitey-intro p {
      font-size: 16px;
      line-height: 1.82;
      color: var(--muted);
      max-width: 640px;
      margin: 0 auto
    }

    /* NEWS GRID */
    .news-section {
      padding: 0 0 100px;
      background: var(--paper)
    }

    .news-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px
    }

    .news-card {
      background: var(--paper-2);
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid var(--line);
      transition: box-shadow .35s var(--ease), transform .35s var(--ease)
    }

    .news-card:hover {
      box-shadow: 0 8px 32px rgba(0, 0, 0, .08);
      transform: translateY(-3px)
    }

    .news-card-img {
      overflow: hidden;
      position: relative
    }

    .news-card-img img {
      width: 100%;
      aspect-ratio: 3/2;
      object-fit: cover;
      display: block;
      transition: transform 1.1s var(--ease)
    }

    .news-card:hover .news-card-img img {
      transform: scale(1.05)
    }

    .news-card-body {
      padding: 24px 28px 32px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      flex: 1
    }

    .news-tag {
      font-size: 9.5px;
      letter-spacing: .18em;
      text-transform: uppercase;
      font-weight: 700;
      color: var(--orange);
      display: block
    }

    .news-card h3 {
      font-size: clamp(15px, 1.3vw, 17px);
      font-weight: 700;
      letter-spacing: -.022em;
      line-height: 1.38;
      color: var(--ink);
      flex: 1
    }

    .news-date {
      font-size: 11px;
      color: var(--muted-2);
      letter-spacing: .04em;
      margin-top: auto;
      padding-top: 16px;
      border-top: 1px solid var(--line);
      display: block
    }

    .feat-excerpt {
      font-size: 14.5px;
      line-height: 1.8;
      color: var(--muted);
      margin-bottom: 22px
    }

    .news-excerpt {
      font-size: 13px;
      line-height: 1.72;
      color: var(--muted);
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* LOAD MORE */
    .load-more-row {
      padding: 60px 0 80px;
      text-align: center;
      border-top: 1px solid var(--line)
    }

    @@media(max-width:1000px) {
      .news-grid {
        grid-template-columns: repeat(2, 1fr)
      }

      .feat-latest {
        grid-template-columns: 1fr
      }

      .feat-latest-img {
        min-height: 280px
      }

      .newsletter-in {
        grid-template-columns: 1fr;
        gap: 52px
      }
    }

    @@media(max-width:640px) {
      .hero-h1 {
        font-size: clamp(32px, 9vw, 52px)
      }

      .hero-in {
        padding-top: 120px;
        padding-bottom: 80px
      }

      .news-grid {
        grid-template-columns: 1fr
      }

      .feat-section {
        padding: 40px 20px 0
      }

      .feat-latest-body {
        padding: 36px 24px
      }

      .unitey-intro {
        padding: 44px 20px 32px
      }

      .news-section {
        padding-bottom: 72px
      }

      .load-more-row {
        padding: 40px 0 48px
      }

      /* mobile rhythm */
      .feat-latest-img {
        min-height: 220px
      }

      .feat-tag {
        margin-bottom: 12px
      }

      .feat-latest-body h2 {
        margin-bottom: 10px
      }

      .feat-date {
        margin-bottom: 20px
      }

      .ui-eyebrow {
        margin-bottom: 10px
      }

      .news-grid {
        gap: 16px
      }

      .news-card-body {
        padding: 20px 20px 24px;
        gap: 8px
      }

      .news-date {
        padding-top: 12px
      }
    }
  </style>
</head>

<body>

  @include('partials.nav')

  @include('partials.news-main')

  <!-- FOOTER -->
  @include('partials.footer')

  <script src="{{ asset('reveal.js') }}"></script>

  <script>
    const hdr = document.getElementById('hdr');
    let lastY = window.scrollY;
    addEventListener('scroll', () => {
      const y = window.scrollY;
      hdr.classList.toggle('solid', y > 60);
      if (y > lastY && y > 80) hdr.classList.add('nav-hidden');
      else if (y < lastY || y <= 80) hdr.classList.remove('nav-hidden');
      lastY = y;
    }, { passive: true });
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('navLinks');
    burger.addEventListener('click', () => { burger.classList.toggle('open'); navLinks.classList.toggle('open') });

    // close on link tap
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      navLinks.classList.remove('open');
      burger.classList.remove('open');
    }));
    // close on outside tap
    document.addEventListener('click', e => {
      if (!burger.contains(e.target) && !navLinks.contains(e.target)) {
        navLinks.classList.remove('open');
        burger.classList.remove('open');
      }
    });

    // Load more — revealed cards animate in as one group via reveal.js
    document.getElementById('loadMoreBtn')?.addEventListener('click', function () {
      document.querySelectorAll('.news-older').forEach(card => { card.style.display = '' });
      this.closest('.load-more-row').style.display = 'none';
      Reveal.observe(document.getElementById('newsGrid'));
    });
  </script>
</body>

</html>