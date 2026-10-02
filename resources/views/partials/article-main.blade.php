<!-- ARTICLE HERO -->
<section class="art-hero">
  <div class="art-hero-in rv">
    <div class="art-breadcrumb">
      <a href="{{ url('/news') }}">News</a>
      <span>/</span>
      <a href="{{ url('/news') }}">{{ $cms['hero']['category'] }}</a>
    </div>
    <span class="art-category">{{ $cms['hero']['category'] }}</span>
    <h1 class="art-section-title">{{ $cms['hero']['title'] }}</h1>
    <p class="art-intro">{{ $cms['hero']['intro'] }}</p>
    <div class="art-meta">
      <span>{{ $cms['hero']['date'] }}</span>
      <span class="art-meta-dot"></span>
      <span>{{ $cms['hero']['byline'] }}</span>
    </div>
  </div>
  <div class="wrap">
    <img class="art-hero-img rv" src="{{ \App\Services\CmsStore::media($cms['hero']['image']) }}" alt="{{ $cms['hero']['alt'] }}">
  </div>
</section>

<article class="art-body">
  @foreach ($cms['body']['blocks'] as $block)
    @if ($block['heading'] !== '')
      <hr class="art-divider rv">
      <h3 class="art-section-h rv">{{ $block['heading'] }}</h3>
    @endif
    <p class="art-text rv">{{ $block['text'] }}</p>
  @endforeach
  <p class="art-source rv">{{ $cms['source']['label'] }} <a href="{{ \App\Services\CmsStore::href($cms['source']['url']) }}" target="_blank" rel="noopener">{{ $cms['source']['name'] }} <span class="arw">&#8599;</span></a></p>
</article>

<div class="art-back">
  <div class="art-back-in">
    <a href="{{ \App\Services\CmsStore::href($cms['back']['url']) }}" class="back-link"><span class="arw-l">←</span> {{ $cms['back']['label'] }}</a>
  </div>
</div>

<section class="newsletter">
  <div class="wrap">
    <div class="newsletter-in">
      <div class="newsletter-left rv">
        <span style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;font-weight:700;color:var(--orange);margin-bottom:16px;display:block">{{ $cms['newsletter']['eyebrow'] }}</span>
        <h2>{{ $cms['newsletter']['headline'] }}</h2>
        <p>{{ $cms['newsletter']['text'] }}</p>
      </div>
      <form class="newsletter-right rv" method="POST" action="{{ route('subscribers.store') }}">
        @csrf
        <input type="hidden" name="source" value="article">
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
