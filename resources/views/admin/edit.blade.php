@extends('admin.layout')

@section('title', $page['name'])
@section('kicker', 'Editing')
@section('heading', $page['name'])

@section('actions')
  <a class="ghost" href="{{ $page['slug'] === 'site' ? url('/') : url(match ($page['slug']) {
      'home' => '/',
      'partners' => '/investments',
      'article' => '/blog-detail',
      'privacy' => '/privacy-policy',
      'terms' => '/terms-conditions',
      default => '/'.$page['slug'],
  }) }}" target="_blank" rel="noopener">View page</a>
  <button class="save" type="submit" form="editor">Save changes</button>
@endsection

@section('body')
  <p class="lede">{{ $page['summary'] }} Pictures and words already match the live site. Change only what you need, then save.</p>

  <nav class="jumps" aria-label="Sections">
    @foreach ($page['sections'] as $section)
      <a href="#section-{{ $section['key'] }}">{{ $section['name'] }}</a>
    @endforeach
  </nav>

  <form id="editor" method="POST" action="{{ route('admin.update', $page['slug']) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @foreach ($page['sections'] as $section)
      <section @class(['block', 'is-open' => $loop->first]) id="section-{{ $section['key'] }}">
        <header class="block-head">
          <div>
            <h2>{{ $section['name'] }}</h2>
            <p>{{ $section['help'] }}</p>
          </div>
          <button class="text-btn" type="submit" form="restore-{{ $section['key'] }}">Restore original</button>
        </header>

        @if ($section['fields'])
          <div class="fields">
            @foreach ($section['fields'] as $field)
              @include('admin.field', [
                'field' => $field,
                'value' => $content[$section['key']][$field['key']] ?? ($field['default'] ?? ''),
                'name' => 's['.$section['key'].']['.$field['key'].']',
                'file' => 'f['.$section['key'].']['.$field['key'].']',
                'remove' => 'r['.$section['key'].']['.$field['key'].']',
              ])
            @endforeach
          </div>
        @endif

        @foreach ($section['groups'] as $group)
          @include('admin.repeater', [
            'group' => $group,
            'items' => $content[$section['key']][$group['key']] ?? [],
            'name' => 's['.$section['key'].']['.$group['key'].']',
            'file' => 'f['.$section['key'].']['.$group['key'].']',
            'remove' => 'r['.$section['key'].']['.$group['key'].']',
          ])
        @endforeach
      </section>
    @endforeach
  </form>

  @foreach ($page['sections'] as $section)
    <form id="restore-{{ $section['key'] }}" method="POST" action="{{ route('admin.restore', [$page['slug'], $section['key']]) }}">
      @csrf
    </form>
  @endforeach

  <div class="savebar">
    <button class="save" type="submit" form="editor">Save changes</button>
  </div>
@endsection
