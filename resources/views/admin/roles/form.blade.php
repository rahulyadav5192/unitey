@extends('admin.layout')

@section('title', $role->exists ? 'Edit role' : 'Add role')
@section('kicker', 'Access')
@section('heading', $role->exists ? 'Edit role' : 'Add role')
@section('actions')
  <a class="ghost" href="{{ route('admin.roles.index') }}">Back</a>
@endsection

@section('body')
  <form method="POST" action="{{ $role->exists ? route('admin.roles.update', $role) : route('admin.roles.store') }}">
    @csrf
    @if ($role->exists)
      @method('PUT')
    @endif
    <div class="account-form">
      <label>
        Name
        <input type="text" name="name" value="{{ old('name', $role->name) }}" required>
      </label>
      <label>
        Description
        <input type="text" name="description" value="{{ old('description', $role->description) }}" placeholder="Who this role is for">
      </label>
      @if ($errors->any())
        <p class="error">{{ $errors->first() }}</p>
      @endif
    </div>

    <h2 class="section-label">Sidebar permissions</h2>
    @if ($role->is_system)
      <p class="lede">Administrator always keeps every permission, so the site cannot be locked out.</p>
    @else
      <p class="lede">Checked items appear in the sidebar. Unchecked items stay hidden, and the address cannot be opened either.</p>
    @endif

    <div class="perm-groups">
      @foreach ($groups as $group => $items)
        <section class="perm-group">
          <h2>{{ $group }}</h2>
          <div class="perm-grid">
            @foreach ($items as $item)
              <label class="check slim">
                <input type="checkbox" name="permissions[]" value="{{ $item['key'] }}" @checked(in_array($item['key'], $selected, true)) @disabled($role->is_system)>
                <span>{{ $item['label'] }}</span>
              </label>
            @endforeach
          </div>
        </section>
      @endforeach
    </div>

    <div class="savebar">
      <button class="save" type="submit">{{ $role->exists ? 'Save role' : 'Add role' }}</button>
    </div>
  </form>
@endsection
