<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Checkbox CPF/CNPJ -->
        <div class="mt-4">
            <x-input-label for="cpf_cnpj_option" :value="__('Escolha o tipo de cadastro')" />

            <div class="flex items-center gap-4">
                <label>
                    <input type="checkbox" class="toggle-option" id="chk_cpf" data-target="#cpf-field" />
                    CPF
                </label>
                <label>
                    <input type="checkbox" class="toggle-option" id="chk_cnpj"  data-target="#cnpj-field" />
                    CNPJ
                </label>
            </div>

        </div>

        <!-- CNPJ -->
        <div id="cnpj-field" class="mt-4 hidden">
            <x-input-label for="cnpj" :value="__('CNPJ')" />
            <x-text-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')" autocomplete="cnpj" />
            <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div id="cpf-field" class="mt-4 hidden">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}">
                {{ __('Já esta resgitrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar-se') }}
            </x-primary-button>
        </div>
    </form>

    @push('scripts')
        <script>

            document.addEventListener('DOMContentLoaded', function() {

                $('.toggle-option').on('change', function () {

                    const target = $(this).data('target');
                    console.log("Teste valor do chk ",target);
                    if ($(this).is(':checked')) {
                        $(target).removeClass('hidden');
                    } else {
                        $(target).addClass('hidden');
                    }
                });
            });

        </script>
    @endpush
</x-guest-layout>
