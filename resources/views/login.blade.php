<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body class="text-center">
        <form class="form-signin" method="POST" action="{{ route('usuario.login') }}">
            @csrf
            <img class="mb-4" src="{{ asset('img/avatar-loginAON.jpg') }}" alt="" width="140" height="140">
            @error('erro')
			    <div class="alert alert-warning">{{ $message }}</div>
			@enderror
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021 Aon Sistemas</p>
        </form>
    </body>
</html>
