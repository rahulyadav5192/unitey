@extends('admin.layout')

@section('title', $account->exists ? 'Edit user' : 'Add user')
@section('kicker', 'Access')
@section('heading', $account->exists ? 'Edit user' : 'Add user')
@section('actions')
  <a class="ghost" href="{{ route('admin.users.index') }}">Back</a>
@endsection

@section('body')
  <form class="account-form" method="POST" action="{{ $account->exists ? route('admin.users.update', $account) : route('admin.users.store') }}">
    @csrf
    @if ($account->exists)
      @method('PUT')
    @endif
    <label>
      Name
      <input type="text" name="name" value="{{ old('name', $account->name) }}" required>
    </label>
    <label>
      Email
      <input type="email" name="email" value="{{ old('email', $account->email) }}" autocomplete="off" required>
    </label>
    <label>
      Password
      <input type="password" name="password" autocomplete="new-password" @unless($account->exists) required @endunless>
      <small>{{ $account->exists ? 'Leave blank to keep the current password.' : 'At least 8 characters.' }}</small>
    </label>
    <label>
      Role
      <select name="role_id" required>
        <option value="" disabled @selected(! old('role_id', $account->role_id))>Choose a role</option>
        @foreach ($roles as $role)
          <option value="{{ $role->id }}" @selected((string) old('role_id', $account->role_id) === (string) $role->id)>{{ $role->name }}</option>
        @endforeach
      </select>
      <small>The role decides which sidebar items this person can open.</small>
    </label>
    @if ($errors->any())
      <p class="error">{{ $errors->first() }}</p>
    @endif
    <div class="row-actions">
      <button class="save" type="submit">{{ $account->exists ? 'Save user' : 'Add user' }}</button>
    </div>
  </form>
@endsection
