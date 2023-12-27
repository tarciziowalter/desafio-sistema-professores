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

        <table id="messageTable" class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Data</th>
                    <th>Mensagem</th>
                    <th>Resposta</th>
                    <th>Status</th>
                    <th style="width: 25%;">Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#messageTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                }
            });

            selectAll();

        });

        function selectAll() {

            let url = "{{ route('message.selectAll') }}";
            let table = $('#messageTable').DataTable();

            axios.get(url)
                .then(function(response) {

                    table.clear().draw(false);
                    $.each(response.data, function(key, value) {
                        table.row.add([
                            value.name,
                            value.date_register,
                            value.description,
                            value.answer,
                            value.status,
                            value.actions
                        ]);
                    });
                    table.draw(false);
                })
                .catch(function(error) {
                    console.error(error);
                });

        }

        function deleteMessage(messageId) {
            var confirmDelete = confirm("Tem certeza que deseja excluir esta mensagem?");

            if (confirmDelete) {
                window.location.href = '/messages/destroy/' + messageId;
            }
        }

        function logout() {
            // Adicione lógica de logout aqui, por exemplo, redirecionar para a rota de logout
            window.location.href = "{{ route('logout') }}";
        }
    </script>
</body>

</html>