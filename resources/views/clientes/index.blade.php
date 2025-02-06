<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Mensagens de Sucesso/Erro -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4 flex justify-end" >
                        <x-primary-button class="bg-blue-500 hover:bg-dark-700 text-dark font-bold py-2 px-4 rounded"
                                          x-data="" x-on:click.prevent="$dispatch('open-modal', 'cadastrar-cliente-contato')" >
                            Novo Cliente
                        </x-primary-button>
                    </div>


                    <!-- Tabela de Clientes -->
                    <div class="overflow-x-auto">
                        @if($clientes->isNotEmpty())

                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">CPF</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Telefone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->cpf }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cliente->telefone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('cliente.show', $cliente->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-600 dark:text-gray-400">Nenhum cliente cadastrado</p>
                            </div>
                        @endif
                    </div>

                    <!-- Paginação -->
                    <div class="mt-4">
                        {{ $clientes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="cadastrar-cliente-contato" focusable>
        <title>
            <h2>Cadastrar Cliente e Contatos</h2>
        </title>

        <div class="container">
            <form method="POST" action="{{ route('cliente.store') }}">
                @csrf

                <!-- Dados do Cliente -->
                <div class="card mb-4">
                    <div class="card-header">Dados do Cliente</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Cliente</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" required>
                        </div>
                    </div>
                </div>

                <!-- Dados dos Contatos -->
                <div class="card mb-4">
                    <div class="card-header">Contatos</div>
                    <div class="card-body">
                        <div id="contatos">
                            <!-- Primeiro Contato -->
                            <div class="contato mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Nome do Contato</label>
                                    <input type="text" class="form-control" name="contatos[0][nome]" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telefone 1</label>
                                    <input type="text" class="form-control" name="contatos[0][telefone_1]" placeholder="(00) 00000-0000" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Telefone 2 (Opcional)</label>
                                    <input type="text" class="form-control" name="contatos[0][telefone_2]" placeholder="(00) 00000-0000">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remover-contato">Remover</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="adicionar-contato">Adicionar Contato</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </x-modal>
</x-app-layout>
<script>
    document.getElementById('adicionar-contato').addEventListener('click', function() {
        const contatosDiv = document.getElementById('contatos');
        const novoContato = document.createElement('div');
        const index = contatosDiv.children.length;

        novoContato.classList.add('contato', 'mb-3');
        novoContato.innerHTML = `
    <div class="mb-3">
        <label class="form-label">Nome do Contato</label>
        <input type="text" class="form-control" name="contatos[${index}][nome]" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone 1</label>
        <input type="text" class="form-control" name="contatos[${index}][telefone_1]" placeholder="(00) 00000-0000" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone 2 (Opcional)</label>
        <input type="text" class="form-control" name="contatos[${index}][telefone_2]" placeholder="(00) 00000-0000">
    </div>
    <button type="button" class="btn btn-danger btn-sm remover-contato">Remover</button>
`;

        contatosDiv.appendChild(novoContato);
    });

    // Remover contato
    document.getElementById('contatos').addEventListener('click', function(e) {
        if (e.target.classList.contains('remover-contato')) {
            e.target.closest('.contato').remove();
        }
    });
</script>
