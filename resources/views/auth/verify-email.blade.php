<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-center">Verifikasi Email</h2>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div id="alert-success" class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error kode --}}
        @error('code')
            <div id="alert-error" class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">
                {{ $message }}
            </div>
        @enderror

        {{-- Info email tujuan --}}
        @if (session('email'))
            <p class="text-sm text-gray-600 mb-4 text-center">
                Kode verifikasi telah dikirim ke <strong>{{ session('email') }}</strong>
            </p>
        @endif

        {{-- Form verifikasi --}}
        <form method="POST" action="{{ route('custom.verification.verify') }}" id="verify-form">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-center">
                    Masukkan Kode Verifikasi
                </label>
                <input type="text" name="code" id="code" maxlength="6" inputmode="numeric"
                    autocomplete="one-time-code"
                    class="w-full border rounded px-3 py-2 text-center text-2xl tracking-widest font-mono"
                    placeholder="------" required autofocus>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Verifikasi
            </button>
        </form>

        {{-- Kirim ulang kode --}}
        <form method="POST" action="{{ route('verification.resend') }}" class="mt-4 text-center">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <button type="submit" class="text-blue-600 hover:underline">
                Kirim ulang kode
            </button>
        </form>
    </div>

    {{-- Script interaksi --}}
    <script>
        // Auto-hilang pesan alert
        setTimeout(() => {
            document.getElementById('alert-success')?.remove();
            document.getElementById('alert-error')?.remove();
        }, 3500);

        // Disable tombol saat form dikirim
        document.getElementById('verify-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.textContent = 'Memverifikasi...';
        });

        // Auto fokus & clear error saat user mulai ngetik ulang
        const codeInput = document.getElementById('code');
        codeInput.addEventListener('input', () => {
            document.getElementById('alert-error')?.remove();
        });
    </script>
</x-guest-layout>
