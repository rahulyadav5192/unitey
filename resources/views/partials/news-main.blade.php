<!-- HERO -->
<section class="hero">
  <img class="hero-bg" referrerpolicy="no-referrer" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="">
  <div class="wrap hero-in">
    <h1 class="hero-h1 rise">{!! $cms['hero']['headline'] !!}</h1>
    <p class="hero-body rise d1">{{ $cms['hero']['text'] }}</p>
  </div>
</section>

@php
  $stories = collect($cms['stories']['items']);
  $feature = $stories->first(fn ($story) => filter_var($story['featured'] ?? false, FILTER_VALIDATE_BOOLEAN)) ?? $stories->first();
  $rest = $stories->reject(fn ($story) => $story === $feature)->values();
  $hasOlder = $rest->contains(fn ($story) => filter_var($story['older'] ?? false, FILTER_VALIDATE_BOOLEAN));
@endphp

@if ($feature)
  <div class="feat-section">
    <a href="{{ \App\Services\CmsStore::href($feature['url']) }}" @if (str_starts_with($feature['url'], 'http')) target="_blank" rel="noopener" @endif class="feat-latest rv">
      <div class="feat-latest-img">
        <img src="{{ \App\Services\CmsStore::media($feature['image']) }}" alt="{{ $feature['alt'] }}">
      </div>
      <div class="feat-latest-body">
        <span class="feat-tag">{{ $feature['tag'] }}</span>
        <h2>{{ $feature['title'] }}</h2>
        <p class="feat-excerpt">{{ $feature['excerpt'] }}</p>
        <span class="feat-date">{{ $feature['date'] }}</span>
        <span class="feat-read">Read Full Story <span class="arw">→</span></span>
      </div>
    </a>
  </div>
@endif

<div class="unitey-intro">
  <span class="ui-eyebrow">{{ $cms['intro']['eyebrow'] }}</span>
  <p>{{ $cms['intro']['text'] }}</p>
</div>

<section class="news-section">
  <div class="wrap">
    <div class="news-grid" id="newsGrid">
      @foreach ($rest as $story)
        @php $older = filter_var($story['older'] ?? false, FILTER_VALIDATE_BOOLEAN); @endphp
        <a href="{{ \App\Services\CmsStore::href($story['url']) }}" @if (str_starts_with($story['url'], 'http')) target="_blank" rel="noopener" @endif class="news-card rv {{ $older ? 'news-older' : '' }}" @if ($older) style="display:none" @endif>
          <div class="news-card-img">
            <img src="{{ \App\Services\CmsStore::media($story['image']) }}" alt="{{ $story['alt'] }}">
          </div>
          <div class="news-card-body">
            <span class="news-tag">{{ $story['tag'] }}</span>
            <h3>{{ $story['title'] }}</h3>
            <p class="news-excerpt">{{ $story['excerpt'] }}</p>
            <span class="news-date">{{ $story['date'] }}</span>
          </div>
        </a>
      @endforeach
    </div>
    @if ($hasOlder)
      <div class="load-more-row rv">
        <button class="btn btn-navy" id="loadMoreBtn" type="button">See Older Posts <span class="arw">→</span></button>
      </div>
    @endif
  </div>
</section>

<section class="newsletter">
  <div class="wrap">
    <div class="newsletter-in">
      <div class="newsletter-left rv">
        <span class="eyebrow">{{ $cms['newsletter']['eyebrow'] }}</span>
        <p>{{ $cms['newsletter']['text'] }}</p>
      </div>
      <form class="newsletter-right rv" method="POST" action="{{ route('subscribers.store') }}">
        @csrf
        <input type="hidden" name="source" value="news">
        <div class="nl-field">
          <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ $cms['newsletter']['placeholder'] }}" required>
        </div>
        @error('email')
          <p class="nl-error">Enter a valid email address.</p>
        @enderror
        <button class="nl-submit" type="submit">{{ $cms['newsletter']['button'] }} →</button>
        <p class="nl-note">{{ $cms['newsletter']['note'] }}</p>
      </form>
    </div>
  </div>
</section>

@include('partials.sent-modal', [
  'kind' => 'newsletter',
  'eyebrow' => 'Stay informed',
  'title' => 'You are subscribed',
  'text' => 'Thank you. We will send the briefing to your inbox.',
])
