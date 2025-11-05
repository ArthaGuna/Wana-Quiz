<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg overflow-hidden max-w-5xl w-full">

            <!-- Bagian Kiri: Gambar -->
            <div class="hidden md:flex md:w-1/2 items-center justify-center bg-purple-600">
                <img src="{{ asset('images/murid.jpg') }}"
                     alt="Register ilustrasi"
                     class="object-cover w-full h-full opacity-90">
            </div>

            <!-- Bagian Kanan: Form Register -->
            <div class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center">

                <h1 class="text-3xl font-bold text-center text-purple-700 mb-6">Daftar Akun Baru</h1>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Role -->
                    <div class="flex justify-center mb-6 border border-gray-300 rounded-lg overflow-hidden">
                        <input type="hidden" name="role" id="role" value="{{ old('role', 'mahasiswa') }}">
                        <button type="button" class="role-btn w-1/2 py-2 font-semibold" data-role="mahasiswa">
                            Mahasiswa
                        </button>
                        <button type="button" class="role-btn w-1/2 py-2 font-semibold"data-role="dosen">
                            Dosen
                        </button>
                    </div>

                    <!-- Nama -->
                    <div class="relative">
                        <x-text-input id="name"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            type="text" name="name" :value="old('name')" required autocomplete="name"
                            placeholder=" " />
                        <x-input-label for="name"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:px-2 peer-focus:text-purple-700
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Nama Lengkap')" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <x-text-input id="email"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            type="email" name="email" :value="old('email')" required autocomplete="username"
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
                            type="password" name="password" required autocomplete="new-password"
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

                    <!-- Konfirmasi Password -->
                    <div class="relative">
                        <x-text-input id="password_confirmation"
                            class="block px-3 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg
                                   border border-gray-300 appearance-none focus:outline-none focus:ring-0
                                   focus:border-purple-600 peer"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder=" " />
                        <x-input-label for="password_confirmation"
                            class="absolute text-sm text-gray-500 duration-300 transform
                                   -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2
                                   peer-focus:text-purple-700 peer-focus:px-2
                                   peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2
                                   peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75
                                   peer-focus:-translate-y-4 left-1"
                            :value="__('Konfirmasi Kata Sandi')" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Tombol Register -->
                    <button type="submit"
                        class="w-full bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-bold py-2 rounded-lg transition">
                        {{ __('Daftar') }}
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-purple-700 font-semibold hover:underline">
                        Masuk di sini
                    </a>
                </p>

            </div>
        </div>
    </div>

<!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const roleInput = document.getElementById("role");
    const roleButtons = document.querySelectorAll(".role-btn");

    roleInput.value = "mahasiswa";
    document.querySelector('.role-btn[data-role="mahasiswa"]').className =
        "role-btn w-1/2 py-2 font-semibold bg-purple-700 text-white";

    roleButtons.forEach(button => {
        button.addEventListener("click", () => {
            roleInput.value = button.dataset.role;

            roleButtons.forEach(btn => {
                btn.className = "role-btn w-1/2 py-2 font-semibold bg-white text-gray-600 hover:bg-gray-50";
            });

            button.className = "role-btn w-1/2 py-2 font-semibold bg-purple-700 text-white";
        });
    });
});
</script>


</x-guest-layout>
