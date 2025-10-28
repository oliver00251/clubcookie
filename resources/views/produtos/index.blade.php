<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-sm {
            min-width: 70px;
        }

        .produto-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Clube do Cookie</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-secondary">Produtos</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastro">
                <i class="bi bi-plus-lg"></i> Novo Produto
            </button>
        </div>

        <div class="card p-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <table class="table table-hover table-bordered" id="produtos-table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Link</th>
                        <th>Emoji</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr id="produto-{{ $produto->id }}">
                            <td>{{ $produto->id }}</td>
                            <td>
                                @if ($produto->imagem)
                                    <img src="{{ url('public/storage/' . $produto->imagem) }}" class="produto-img"
                                        alt="{{ $produto->nome }}" style="width:50px;height:50px;object-fit:cover;">
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->preco ? 'R$ ' . number_format($produto->preco, 2, ',', '.') : '-' }}</td>
                            <td><a href="{{ $produto->link }}" target="_blank"
                                    class="text-decoration-none">{{ $produto->link }}</a></td>
                            <td>{{ $produto->emoji ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editarProduto({{ $produto->id }})"
                                    data-bs-toggle="modal" data-bs-target="#modalCadastro">Editar</button>
                                <button class="btn btn-sm btn-danger"
                                    onclick="excluirProduto({{ $produto->id }})">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Cadastro/Editar -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formProduto" method="POST" action="{{ route('produtos.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalCadastroLabel">Cadastrar Produto</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="produto_id" id="produto_id">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="col-md-6">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="number" step="0.01" class="form-control" name="preco" id="preco">
                            </div>
                            <div class="col-12">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" name="descricao" id="descricao" rows="10" cols="50" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="link" class="form-label">Link</label>
                                <input type="url" class="form-control" name="link" id="link" required>
                            </div>
                        
                            <div class="col-md">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" class="form-control" name="imagem" id="imagem"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="btnSalvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script>
        $(document).ready(function() {
            $('#produtos-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
                },
                "order": [
                    [0, "asc"]
                ]
            });
        });

        function editarProduto(id) {
            let row = $(`#produto-${id}`);
            $('#modalCadastroLabel').text('Editar Produto');
            $('#formProduto').attr('action', `/produtos/${id}`);
            $('#formProduto').append('@method('PUT')');
            $('#produto_id').val(id);
            $('#nome').val(row.find('td:eq(2)').text());
            $('#descricao').val(row.find('td:eq(3)').text());
            let preco = row.find('td:eq(4)').text().replace('R$ ', '').replace('.', '').replace(',', '.');
            $('#preco').val(preco != '-' ? preco : '');
            $('#link').val(row.find('td:eq(5)').text());
            $('#emoji').val(row.find('td:eq(6)').text() != '-' ? row.find('td:eq(6)').text() : '');
        }

        function excluirProduto(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                $.ajax({
                    url: `/produtos/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $(`#produto-${id}`).remove();
                    },
                    error: function() {
                        alert('Erro ao excluir o produto.');
                    }
                });
            }
        }

        $('#modalCadastro').on('hidden.bs.modal', function() {
            $('#modalCadastroLabel').text('Cadastrar Produto');
            $('#formProduto').attr('action', '{{ route('produtos.store') }}');
            $('#formProduto').find('input[name="_method"]').remove();
            $('#formProduto')[0].reset();
        });
    </script>
</body>

</html>
