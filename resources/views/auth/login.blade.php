<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POS Es Teh</title>
</head>
<body>
    <h2>Login POS Es Teh</h2>

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <div>
            <label>Username</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required autofocus>
        </div>
        <br>
        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>