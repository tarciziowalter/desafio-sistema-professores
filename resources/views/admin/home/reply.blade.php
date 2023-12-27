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

        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p class="m-0">{{ $error }}</p>
            @endforeach
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('message.updateReply', ['id' => $message->id]) }}" method="post">
            @csrf
            <h5 class="mb-4">Responder Mensagem #{{$message->id}} - Enviada em: {{date('d/m/Y', strtotime($message->date_register))}}</h5>
            <div class="mb-3">
                <label for="name" class="form-label">Nome do aluno:</label>
                <input type="text" class="form-control" name="name" value="{{$message->name}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mensagem:</label>
                <textarea class="form-control" name="description" rows="10">{{$message->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Resposta:</label>
                <textarea class="form-control" name="answer" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Responder Mensagem</button>
        </form>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>