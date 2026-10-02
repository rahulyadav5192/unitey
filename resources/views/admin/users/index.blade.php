@extends('admin.layout')

@section('title', 'Users')
@section('kicker', 'Access')
@section('heading', 'Users')
@section('actions')
  <a class="save" href="{{ route('admin.users.create') }}">Add user</a>
@endsection

@section('body')
  <p class="lede">Each person signs in with their own email. Their role decides which sidebar items they can open.</p>
  @if ($errors->any())
    <p class="error">{{ $errors->first() }}</p>
  @endif
  <div class="sheet-wrap">
    <table class="sheet">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $account)
          <tr>
            <td><strong>{{ $account->name }}</strong></td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->role?->name ?? 'No role' }}</td>
            <td>
              <div class="row-actions">
                <a class="text-btn" href="{{ route('admin.users.edit', $account) }}">Edit</a>
                @unless (auth()->user()->is($account))
                  <form method="POST" action="{{ route('admin.users.destroy', $account) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-btn danger" type="submit" data-confirm="Delete {{ $account->name }}?">Delete</button>
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
