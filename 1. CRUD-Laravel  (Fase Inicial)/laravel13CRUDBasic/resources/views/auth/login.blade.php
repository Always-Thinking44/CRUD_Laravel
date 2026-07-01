<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-xl rounded-2xl p-8">

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Bem-vindo de volta</h1>
                    <p class="text-sm text-gray-500 mt-1">Faça login para continuar</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-lg"
                            type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Senha')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-lg"
                            type="password" name="password"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ms-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                                Esqueceu a senha?
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center py-3 rounded-lg">
                        Entrar
                    </x-primary-button>
                </form>

                @if (Route::has('register'))
                    <p class="text-center text-sm text-gray-500 mt-6">
                        Não tem conta?
                        <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">
                            Cadastre-se
                        </a>
                    </p>
                @endif

            </div>
        </div>
    </div>
</x-guest-layout>
