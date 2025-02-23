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

        <div class="mx-auto px-4 py-4">
            <form method="POST" action="{{ route('cliente.store') }}" class="mt-6 space-y-6">
                @csrf

                <!-- Dados do Cliente -->
                <div class="mb-4">
                    <div class="text-center font-bold text-lg" >Dados do Cliente</div >
                    <div >
                        <div class="mb-3">
                            <x-input-label for="input_nome" :value="__('Nome')" />
                            <x-text-input type="text"  class="mt-1 block w-full" autocomplete="input_nome" id="input_nome" name="input_nome" placeholder="Nome" required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="input_cpf" :value="__('CPF')"/>
                            <x-text-input type="text" class="mt-1 block w-full mask-cpf" autocomplete="input_cpf" id="input_cpf" name="input_cpf" placeholder="000.000.000-00"/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="input_cnpj" :value="__('CNPJ')" />
                            <x-text-input type="text" class="mt-1 block w-full mask-cnpj" autocomplete="input_cnpj" id="input_cnpj" name="input_cnpj" placeholder="00.000.000/0000-00" required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="input_telefone" :value="__('Telefone')" />
                            <x-text-input type="text" class="mt-1 block w-full mask-celular" autocomplete="input_telefone" id="input_telefone" name="input_telefone" placeholder="(00) 00000-0000" required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="input_telefone_2" :value="__('Telefone 2 (Opcional)')" />
                            <x-text-input type="text" class="mt-1 block w-full mask-celular" autocomplete="input_telefone_2" id="input_telefone_2" name="input_telefone_2" placeholder="(00) 00000-0000"  />
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class=" text-center text-lg">Contatos</div>
                    <div >
                        <div id="contatos">

                            <div class="contato mb-3 grid grid-cols-2 gap-2">
                                <div class="mb-3">
                                    <x-input-label for="input_contato_nome" :value="__('Nome do Contato 1')" />
                                    <x-text-input type="text" class="mt-1 block w-full" name="contatos[0][nome]" placeholder="Nome" required />
                                </div>
                                <div class="mb-3">
                                    <x-input-label for="input_cpf" :value="__('CPF')"/>
                                    <x-text-input type="text" class="mt-1 block w-full mask-cpf" autocomplete="input_cpf" id="input_cpf" name="input_cpf" placeholder="000.000.000-00"/>
                                </div>
                                <div class="mb-3">
                                    <x-input-label for="input_contato_telefone" :value="__('Telefone 1')" />
                                    <x-text-input type="text" class="mt-1 block w-full mask-celular" name="contatos[0][telefone_1]" placeholder="(00) 00000-0000" required />
                                </div>
                                <div class="mb-3">

                                </div>
                            </div>

                        </div>
                        <div class="flex items-center justify-end">
                            <x-primary-button id="adicionar-contato">{{__('Adicionar Contato')}}</x-primary-button>
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end mb-2">
                    <x-primary-button type="submit" >{{__('Cadastrar')}}</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
<script>

    let index = 0
    document.getElementById('adicionar-contato').addEventListener('click', function() {
        const contatosDiv = document.getElementById('contatos');
        const novoContato = document.createElement('div');
        index = contatosDiv.children.length + 1;
        console.log(index);
        if(index <= 3){
            novoContato.classList.add('contato', 'mb-3', 'grid', 'grid-cols-2','gap-2');
            novoContato.innerHTML = `
                <div class="mb-3">
                    <x-input-label :value="__('Nome do Contato ${index}')"/>
                    <x-text-input type="text" class="mt-1 block w-full" name="contatos[${index}][nome]" placeholder="Nome" required/>
                </div>
                <div class="mb-3">
                    <x-input-label for="input_cpf" :value="__('CPF')"/>
                    <x-text-input type="text" class="mt-1 block w-full" autocomplete="input_cpf" id="input_cpf" name="input_cpf" placeholder="000.000.000-00"/>
                </div>
                <div class="mb-3">
                    <x-input-label :value="__('Telefone 1')"/>
                    <x-text-input type="text" class="mt-1 block w-full" name="contatos[${index}][telefone_1]" placeholder="(00) 00000-0000" required />
                </div>
                <div class=" flex items-center justify-end mt-2 mb-1">
                    <x-danger-button type="button" class="btn btn-danger btn-sm remover-contato">{{__('Remover')}}</x-danger-button>
                </div>
            `;

            contatosDiv.appendChild(novoContato);
        } else {
            alert("Só pode registrar dois contatos")
        }
    });

    document.getElementById('contatos').addEventListener('click', function(e) {
        if (e.target.classList.contains('remover-contato')) {
            e.target.closest('.contato').remove();
            index--;
        }
    });

</script>
