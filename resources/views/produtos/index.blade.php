<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Produtos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* ===== LAYOUT GERAL ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: rgba(28, 14, 5, 0.95);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar .brand {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #E5B273;
        }

        .sidebar .logout {
            margin-top: auto;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        /* ===== TABELA E CARTÕES ===== */
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .produto-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* ===== NAVBAR SUPERIOR ===== */
        .topbar {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                flex-direction: row;
                overflow-x: auto;
            }

            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand"><i class="bi bi-cookie"></i> Clube do Cookie</div>
        <a href="#" class="active"><i class="bi bi-box-seam"></i> Produtos</a>
        <a href="#" title="aguardando formulário"><i class="bi bi-person"></i> Leads</a>
        {{-- <a href="#"><i class="bi bi-bar-chart"></i> Relatórios</a>
        <a href="#"><i class="bi bi-gear"></i> Configurações</a> --}}

        <form action="{{ route('logout') }}" method="POST" class="logout mt-3" style="margin-top: 60vh !important">
            @csrf
            <button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right"></i> Sair</button>
        </form>
    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-secondary fw-semibold">Painel de Produtos</h4>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastro">
                <i class="bi bi-plus-lg"></i> Novo Produto
            </button>
        </div>

        <!-- Tabela -->
        <div class="card p-3 mt-4">
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
                                        alt="{{ $produto->nome }}">
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

    <!-- MODAL CADASTRO -->
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
                                <textarea class="form-control" name="descricao" id="descricao" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="link" class="form-label">Link</label>
                                <input type="url" class="form-control" name="link" id="link" required>
                            </div>
                            <div class="col-md-6">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*">
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
            $('#formProduto').append('@method("PUT")');
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
