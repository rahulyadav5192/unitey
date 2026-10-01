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
    /* HEADER — always dark-on-light, this page has no dark hero to sit on */
    #hdr, #hdr.solid { background:rgba(255,255,255,.95); backdrop-filter:blur(16px); border-bottom:1px solid var(--line); padding:13px 0 }
    #hdr .logo-w { display:none }
    #hdr .logo-b { display:block }
    #hdr .nav-links a { color:rgba(28,42,94,.7) }
    #hdr .nav-links a:hover, #hdr .nav-links a.active { color:var(--navy) }
    #hdr .burger span { background:var(--navy) }

    /* LEGAL DOCUMENT PAGE */
    .legal-hero { padding:160px 28px 48px; background:var(--paper) }
    .legal-hero-in { max-width:760px; margin:0 auto }
    .legal-label { font-size:11px; letter-spacing:.18em; text-transform:uppercase; font-weight:700; color:var(--orange); margin-bottom:16px; display:block }
    .legal-title { font-size:clamp(32px,4vw,52px); font-weight:800; letter-spacing:-.04em; line-height:1.08; color:var(--ink); margin-bottom:16px }
    .legal-meta { font-size:13px; color:var(--muted-2); letter-spacing:.02em }

    .legal-body { max-width:760px; margin:0 auto; padding:0 28px 100px }
    .legal-h2 { font-size:clamp(19px,2vw,24px); font-weight:700; letter-spacing:-.02em; color:var(--ink); margin:44px 0 14px }
    .legal-h2:first-child { margin-top:0 }
    .legal-h3 { font-size:16px; font-weight:700; letter-spacing:-.01em; color:var(--navy); margin:28px 0 10px }
    .legal-h4 { font-size:14px; font-weight:700; color:var(--navy); margin:22px 0 8px }
    .legal-p { font-size:15px; line-height:1.85; color:var(--muted); margin-bottom:16px }
    .legal-list { margin:0 0 16px; padding-left:22px }
    .legal-list li { font-size:15px; line-height:1.85; color:var(--muted); margin-bottom:8px }

    @@media(max-width:640px) {
      .legal-hero { padding:120px 20px 36px }
      .legal-body { padding:0 20px 72px }
    }
  </style>
</head>
<body>

  @include('partials.nav')

  @include('partials.legal-main')

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

    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      navLinks.classList.remove('open');
      burger.classList.remove('open');
    }));
    document.addEventListener('click', e => {
      if (!burger.contains(e.target) && !navLinks.contains(e.target)) {
        navLinks.classList.remove('open');
        burger.classList.remove('open');
      }
    });
  </script>
</body>
</html>
