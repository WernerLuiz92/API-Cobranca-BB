<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Font Awesome && Bootstrap Icons --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    {{-- Google Fonts Roboto --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    {{-- Bootstrap core CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    {{-- Jquery --}}
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script-->
    {{-- App CSS --}}
    <link href="/css/app.css" rel="stylesheet">

    <title>Cobrança BB</title>

</head>
<body>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="{{ Route('token') }}">Token</a></li>
        <li><a href="{{ Route('registrar') }}">Registrar</a></li>
        <li><a href="{{ Route('listarTodas') }}">Listar todas as Cobranças</a></li>
        <li><a href="{{ Route('consultar') }}">Consultar</a></li>
        <li><a href="{{ Route('darBaixa') }}">Dar Baixa</a></li>
        <li><a href="{{ Route('atualizar') }}">Atualizar</a></li>
    </ul>
    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    {{-- App JS --}}
    <script src="/js/app.js"></script>
</body>
</html>