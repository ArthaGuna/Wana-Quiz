<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg overflow-hidden max-w-5xl w-full">

            <!-- Bagian Kiri: Gambar -->
            <div class="hidden md:flex md:w-1/2 items-center justify-center bg-purple-600">
                <img src="{{ asset('images/murid.jpg') }}"
                    alt="Login ilustrasi"
                    class="object-cover w-full h-full opacity-90">
            </div>

            <!-- Bagian Kanan: Form Login -->
            <div class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center">

                <h1 class="text-3xl font-bold text-center text-purple-700 mb-6">Masuk ke Website</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div class="relative">
                        <x-text-input id="email"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder=" " />

                        <x-input-label for="email"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-purple-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Email')" />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <x-text-input id="password"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder=" " />

                        <x-input-label for="password"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-purple-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Kata Sandi')" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-purple-700 shadow-sm focus:ring-purple-600"
                                name="remember">

                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-purple-700 hover:underline focus:outline-none"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa kata sandi?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit"
                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-bold py-2 rounded-lg transition">
                        {{ __('Masuk') }}
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-purple-700 font-semibold hover:underline">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
