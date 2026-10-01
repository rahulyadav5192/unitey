<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin') — Unitey</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin.css') }}">
</head>
<body>
  <div class="shell">
    <aside class="side" id="side">
      <a class="brand" href="{{ route('admin.home') }}">
        <img src="{{ asset('uniteywhite1.png') }}" alt="Unitey">
        <span>Content</span>
      </a>
      <nav class="side-nav">
        <a href="{{ route('admin.home') }}" @class(['active' => request()->routeIs('admin.home')])>Overview</a>
        @foreach (\App\Cms\Catalog::publicPages() as $navPage)
          <a href="{{ route('admin.edit', $navPage['slug']) }}" @class(['active' => request()->routeIs('admin.edit') && request()->route('page') === $navPage['slug']])>{{ $navPage['name'] }}</a>
        @endforeach
        <a href="{{ route('admin.messages') }}" @class(['active' => request()->routeIs('admin.messages')])>Messages</a>
      </nav>
      <div class="side-foot">
        <a href="{{ url('/') }}" target="_blank" rel="noopener">View the site</a>
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit">Sign out</button>
        </form>
      </div>
    </aside>
    <div class="work">
      <header class="top">
        <button class="menu" type="button" id="menu" aria-label="Open menu"><span></span><span></span><span></span></button>
        <div>
          <p class="kicker">@yield('kicker', 'Unitey')</p>
          <h1>@yield('heading')</h1>
        </div>
        <div class="top-actions">@yield('actions')</div>
      </header>
      @if (session('status'))
        <p class="toast" role="status">{{ session('status') }}</p>
      @endif
      <div class="work-body">
        @yield('body')
      </div>
    </div>
  </div>
  <script src="{{ asset('admin.js') }}"></script>
  @stack('scripts')
</body>
</html>
