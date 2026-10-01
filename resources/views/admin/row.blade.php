<article class="rep-row" data-row>
  <header>
    <strong>{{ $group['item'] }}</strong>
    <div class="row-actions">
      <button type="button" data-up aria-label="Move up">Up</button>
      <button type="button" data-down aria-label="Move down">Down</button>
      <button type="button" data-remove>Remove</button>
    </div>
  </header>
  <div class="fields">
    @foreach ($group['fields'] as $field)
      @if ($field['type'] !== 'note')
        @include('admin.field', [
          'field' => $field,
          'value' => $item[$field['key']] ?? '',
          'name' => $name.'['.$index.']['.$field['key'].']',
          'file' => $file.'['.$index.']['.$field['key'].']',
          'remove' => $remove.'['.$index.']['.$field['key'].']',
        ])
      @else
        @include('admin.field', ['field' => $field, 'value' => '', 'name' => '', 'file' => '', 'remove' => ''])
      @endif
    @endforeach
  </div>
  @foreach ($group['groups'] ?? [] as $child)
    @include('admin.repeater', [
      'group' => $child,
      'items' => $item[$child['key']] ?? [],
      'name' => $name.'['.$index.']['.$child['key'].']',
      'file' => $file.'['.$index.']['.$child['key'].']',
      'remove' => $remove.'['.$index.']['.$child['key'].']',
    ])
  @endforeach
</article>
