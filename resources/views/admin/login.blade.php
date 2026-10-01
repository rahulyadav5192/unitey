<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign in — Unitey</title>
  <link rel="icon" href="{{ asset('favicon1.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin.css') }}">
</head>
<body class="gate">
  <main class="gate-card">
    <img src="{{ asset('uniteyblue1.png') }}" alt="Unitey">
    <p class="kicker">Content studio</p>
    <h1>Sign in to edit the site</h1>
    <form method="POST" action="{{ route('admin.login.store') }}">
      @csrf
      <label>
        Email
        <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required>
      </label>
      <label>
        Password
        <input type="password" name="password" autocomplete="current-password" required>
      </label>
      @error('email')
        <p class="error">{{ $message }}</p>
      @enderror
      <button class="save" type="submit">Sign in</button>
    </form>
  </main>
</body>
</html>
