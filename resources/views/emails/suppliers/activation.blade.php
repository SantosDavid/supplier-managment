<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bem vindo</title>
</head>
<body>
    <h1>Seja bem-vindo, {{ $activation->supplier->name }}</h1>

    <p>Para ser ativado <a href="{{ route('suppliers.activation', [$activation->token]) }}">click aqui</a></p>
</body>
</html>