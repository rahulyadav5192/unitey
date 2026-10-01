<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $cms['seo']['title'] }}</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <style>
    /* ARTICLE HERO */
    .art-hero { padding:160px 28px 0; background:var(--paper) }
    .art-hero-in { max-width:800px; margin:0 auto }
    .art-breadcrumb { display:flex; align-items:center; gap:10px; margin-bottom:40px }
    .art-breadcrumb a { font-size:11px; letter-spacing:.14em; text-transform:uppercase; font-weight:700; color:var(--muted-2); transition:color .3s }
    .art-breadcrumb a:hover { color:var(--navy) }
    .art-breadcrumb span { font-size:11px; color:var(--line) }
    .art-category { font-size:10px; letter-spacing:.22em; text-transform:uppercase; font-weight:700; color:var(--orange); margin-bottom:20px; display:block }
    .art-section-title { font-size:clamp(32px,4vw,52px); font-weight:800; letter-spacing:-.045em; line-height:1.08; color:var(--ink); margin-bottom:20px }
    .art-intro { font-size:clamp(15px,1.3vw,17px); line-height:1.82; color:var(--muted); margin-bottom:60px }

    /* HERO IMAGE */
    .art-hero-img { width:100%; max-width:100%; aspect-ratio:16/7; object-fit:cover; border-radius:10px; margin-bottom:80px; display:block }

    /* ARTICLE BODY */
    .art-body { max-width:720px; margin:0 auto; padding:0 28px 100px }
    .art-text { font-size:clamp(15px,1.3vw,17px); line-height:1.88; color:var(--muted); margin-bottom:44px }
    .art-section-h { font-size:clamp(19px,2vw,26px); font-weight:700; letter-spacing:-.03em; line-height:1.22; color:var(--ink); margin-bottom:20px }
    .art-divider { width:48px; height:2px; background:var(--orange); margin-bottom:44px; border:none }

    /* ARTICLE META */
    .art-meta { display:flex; align-items:center; gap:12px; margin:-40px 0 60px; font-size:12px; letter-spacing:.06em; font-weight:600; color:var(--muted-2) }
    .art-meta-dot { width:3px; height:3px; border-radius:50%; background:var(--line) }

    /* SOURCE LINE */
    .art-source { font-size:13px; line-height:1.7; color:var(--muted-2); padding-top:8px; border-top:1px solid var(--line) }
    .art-source a { color:var(--navy); font-weight:600; transition:color .3s }
    .art-source a:hover { color:var(--orange) }

    /* BACK TO NEWS */
    .art-back { padding:0 28px 80px }
    .art-back-in { max-width:720px; margin:0 auto }
    .back-link { display:inline-flex; align-items:center; gap:10px; font-size:11px; letter-spacing:.14em; text-transform:uppercase; font-weight:700; color:var(--navy); transition:gap .3s var(--ease) }
    .back-link:hover { gap:6px }
    .back-link .arw-l { transition:transform .35s var(--ease) }
    .back-link:hover .arw-l { transform:translateX(-4px) }

    @@media(max-width:900px) {
      .newsletter-in { grid-template-columns:1fr; gap:52px }
    }
    @@media(max-width:640px) {
      .art-hero { padding:120px 0 0 }
      .art-hero-in { padding:0 20px }
      .art-section-title { font-size:clamp(26px,8vw,40px) }
      .art-breadcrumb { margin-bottom:24px }
      .art-category { margin-bottom:12px }
      .art-section-title { margin-bottom:14px }
      .art-intro { margin-bottom:32px }
      .art-meta { margin:-20px 0 32px }
      .art-hero-img { margin-bottom:40px }
      .art-text { margin-bottom:22px }
      .art-divider { margin:10px 0 28px }
      .art-section-h { margin-bottom:12px }
      .art-body { padding:0 20px 40px }
      .art-back { padding:0 20px 60px }
      .newsletter { padding:72px 0 80px }
    }
  </style>
</head>
<body>

  @include('partials.nav')

  @include('partials.article-main')

  <!-- FOOTER -->
  @include('partials.footer')

  <script src="{{ asset('reveal.js') }}"></script>

  <script>
    const hdr = document.getElementById('hdr');
    // Always solid  white background page
    hdr.classList.add('solid');
    let lastY = window.scrollY;
    addEventListener('scroll', () => {
      const y = window.scrollY;
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

  </script>
</body>
</html>
