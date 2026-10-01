<header id="hdr">
  <div class="wrap nav">
    <a href="{{ url('/') }}" class="logo">
      <img src="{{ \App\Services\CmsStore::media($site['brand']['logo_light']) }}" class="logo-w" alt="{{ $site['brand']['alt'] }}">
      <img src="{{ \App\Services\CmsStore::media($site['brand']['logo_dark']) }}" class="logo-b" alt="{{ $site['brand']['alt'] }}">
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="{{ url('/company') }}" @class(['active' => request()->is('company')])>{{ $site['menu']['company'] }}</a>
      <div class="nav-item">
        <a href="{{ url('/portfolio') }}" @class(['active' => request()->is('portfolio')])>{{ $site['menu']['portfolio'] }}<span class="caret" aria-hidden="true"></span></a>
        <div class="nav-drop">
          @foreach ($companies as $company)
            <a href="{{ url('/portfolio') }}#{{ $company['anchor'] }}">{{ $company['name'] }}<span class="sub">{{ $company['category'] }}</span></a>
          @endforeach
        </div>
      </div>
      <a href="{{ url('/investments') }}" @class(['active' => request()->is('investments')])>{{ $site['menu']['partners'] }}</a>
      <a href="{{ url('/news') }}" @class(['active' => request()->is('news', 'blog-detail')])>{{ $site['menu']['news'] }}</a>
      <a href="{{ url('/contact') }}" @class(['nav-links-cta', 'active' => request()->is('contact')])>{{ $site['menu']['contact'] }}</a>
    </nav>
    <a href="{{ url('/contact') }}" class="nav-cta">{{ $site['menu']['contact'] }}</a>
    <button class="burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
  </div>
</header>
