<footer>
  <div class="wrap">
    <div class="f-grid">
      <div class="f-brand">
        <a href="{{ url('/') }}" class="logo"><img src="{{ \App\Services\CmsStore::media($site['brand']['logo_dark']) }}" class="logo-b" alt="{{ $site['brand']['alt'] }}"></a>
        <p>{{ $site['footer']['blurb'] }}</p>
      </div>
      <div class="f-col">
        <h5>{{ $site['footer']['corporate_heading'] }}</h5>
        @foreach ($site['footer']['corporate'] as $link)
          <a href="{{ \App\Services\CmsStore::href($link['url']) }}">{{ $link['label'] }}</a>
        @endforeach
      </div>
      <div class="f-col">
        <h5>{{ $site['footer']['explore_heading'] }}</h5>
        @foreach ($site['footer']['explore'] as $link)
          <a href="{{ \App\Services\CmsStore::href($link['url']) }}">{{ $link['label'] }}</a>
        @endforeach
      </div>
      <div class="f-col">
        <h5>{{ $site['footer']['entities_heading'] }}</h5>
        @foreach ($companies as $company)
          <a href="{{ url('/portfolio') }}#{{ $company['anchor'] }}">{{ $company['name'] }}</a>
        @endforeach
      </div>
      <div class="f-col">
        <h5>{{ $site['footer']['hq_heading'] }}</h5>
        <span>{!! $site['footer']['address'] !!}</span>
      </div>
    </div>
    <div class="f-bottom">
      <span>{{ $site['footer']['copyright'] }}</span>
      <nav>
        <a href="{{ url('/privacy-policy') }}">{{ $site['footer']['privacy_label'] }}</a>
        <a href="{{ url('/terms-conditions') }}">{{ $site['footer']['terms_label'] }}</a>
      </nav>
    </div>
  </div>
</footer>
