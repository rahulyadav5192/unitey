<div class="co-panel {{ $loop->first ? 'active' : '' }}" id="panel-{{ $company['anchor'] }}" role="tabpanel">
  <div class="panel-banner">
    <img class="panel-banner-bg" src="{{ \App\Services\CmsStore::media($company['banner_image']) }}" alt="">
    <div class="wrap">
      <div class="panel-banner-in">
        <span class="panel-banner-cat">{{ $company['category'] }}</span>
        @if (! empty($company['banner_logo_url']))
          <a class="panel-banner-logo-link" href="{{ \App\Services\CmsStore::href($company['banner_logo_url']) }}" @if (str_starts_with($company['banner_logo_url'], 'http')) target="_blank" rel="noopener" @endif>
            <img class="panel-banner-logo panel-banner-logo--asis" style="--logo-h:{{ $company['banner_logo_height'] }}px" src="{{ \App\Services\CmsStore::media($company['banner_logo']) }}" alt="{{ $company['name'] }}">
          </a>
        @else
          <img class="panel-banner-logo panel-banner-logo--asis" style="--logo-h:{{ $company['banner_logo_height'] }}px" src="{{ \App\Services\CmsStore::media($company['banner_logo']) }}" alt="{{ $company['name'] }}">
        @endif
        <p>{{ $company['summary'] }}</p>
        @if (! empty($company['button_url']))
          <a href="{{ \App\Services\CmsStore::href($company['button_url']) }}" @if (str_starts_with($company['button_url'], 'http')) target="_blank" rel="noopener" @endif class="btn btn-orange">{{ $company['button_label'] }} <span class="arw">→</span></a>
        @else
          <span class="btn btn-orange is-disabled" aria-disabled="true">{{ $company['button_label'] }} <span class="arw">→</span></span>
          @if (! empty($company['button_note']))<span class="btn-note">{{ $company['button_note'] }}</span>@endif
        @endif
      </div>
    </div>
  </div>

  <div class="panel-caps">
    <div class="wrap">
      <div class="panel-caps-head">
        <span class="eyebrow">{{ $company['caps_label'] }}</span>
        @if (! empty($company['badge']) || ! empty($company['marks']))
          <div class="caps-idents">
            @if (! empty($company['badge']))
              <span class="caps-ident">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                {{ $company['badge'] }}
              </span>
            @endif
            @foreach ($company['marks'] ?? [] as $mark)
              @if (! empty($mark['height']))
                <img style="--cm-h:{{ $mark['height'] }}px" class="cred-mark-img" src="{{ \App\Services\CmsStore::media($mark['image']) }}" alt="{{ $mark['alt'] }}">
              @else
                <img src="{{ \App\Services\CmsStore::media($mark['image']) }}" alt="{{ $mark['alt'] }}">
              @endif
            @endforeach
          </div>
        @endif
      </div>

      @if (! empty($company['products']))
        <div class="prod-grid">
          @foreach ($company['products'] as $product)
            <div class="prod-card rv">
              <span class="prod-lbl">{{ $product['label'] }}</span>
              <img style="--ph:{{ $product['height'] }}px" src="{{ \App\Services\CmsStore::media($product['image']) }}" alt="{{ $product['alt'] }}">
              <p>{{ $product['text'] }}</p>
            </div>
          @endforeach
        </div>
      @endif

      <div class="caps-split {{ ! empty($company['products']) ? 'caps-split--match' : '' }}">
        <div class="caps-list">
          @foreach ($company['capabilities'] ?? [] as $capability)
            <div class="caps-item rv">
              <div class="caps-item-body">
                <h4>{{ $capability['title'] }}</h4>
                <p>{{ $capability['text'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
        @if (! empty($company['side_image']))
          <div class="caps-img-col rv">
            <img src="{{ \App\Services\CmsStore::media($company['side_image']) }}" alt="{{ $company['side_alt'] }}">
          </div>
        @endif
      </div>
    </div>
  </div>

  @if (! empty($company['credential_title']))
    <div class="panel-cred">
      <div class="wrap">
        <div class="cred-feature rv">
          <div class="cred-left">
            @if (! empty($company['credential_label']))<span class="eyebrow">{{ $company['credential_label'] }}</span>@endif
            <h3>{{ $company['credential_title'] }}</h3>
            <p>{{ $company['credential_text'] }}</p>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
