<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Desafio Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard - Desafio Professores</a>
        <div class="d-flex">
            <button class="btn btn-outline-danger" onclick="logout()">Logout</button>
        </div>
    </div>
</nav>

<div class="container mt-5">
<form action="" method="post">
    <h5 class="mb-4">Mensagem #{{$message->id}} - Enviada em: {{date('d/m/Y', strtotime($message->date_register))}}</h5>
        <div class="mb-3">
            <label for="name" class="form-label">Nome do aluno:</label>
            <input type="text" class="form-control" name="name" value="{{$message->name}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mensagem:</label>
            <textarea class="form-control" name="description" rows="10">{{$message->description}}</textarea>
        </div>
        @if($message->answer)
        <div class="mb-3">
            <label for="answer" class="form-label">Resposta:</label>
            <textarea class="form-control" name="answer" rows="10">{{$message->answer}}</textarea>
        </div>
        @endif
        <a href="{{route('dashboard')}}" class="btn btn-info">Voltar</a>
    </form>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>
</html>
