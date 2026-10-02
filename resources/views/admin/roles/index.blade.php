@extends('admin.layout')

@section('title', 'Roles')
@section('kicker', 'Access')
@section('heading', 'Roles')
@section('actions')
  <a class="save" href="{{ route('admin.roles.create') }}">Add role</a>
@endsection

@section('body')
  <p class="lede">A role is a set of sidebar permissions. Give a person a role, and they only see the parts you checked.</p>
  @if ($errors->any())
    <p class="error">{{ $errors->first() }}</p>
  @endif
  <div class="sheet-wrap">
    <table class="sheet">
      <thead>
        <tr>
          <th>Role</th>
          <th>Access</th>
          <th>People</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($roles as $role)
          <tr>
            <td>
              <strong>{{ $role->name }}</strong>
              @if ($role->description)
                <p class="sheet-note">{{ $role->description }}</p>
              @endif
            </td>
            <td>{{ $role->is_system ? 'Everything' : $role->permissions_count.' items' }}</td>
            <td>{{ $role->users_count }}</td>
            <td>
              <div class="row-actions">
                <a class="text-btn" href="{{ route('admin.roles.edit', $role) }}">Edit</a>
                @unless ($role->is_system)
                  <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-btn danger" type="submit" data-confirm="Delete the {{ $role->name }} role?">Delete</button>
                  </form>
                @endunless
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
