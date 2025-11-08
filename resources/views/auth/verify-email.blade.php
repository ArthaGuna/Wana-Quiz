<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow">
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
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition flex items-center justify-center gap-2">
                    <span id="btn-text">Verifikasi</span>
                    <svg id="btn-spinner" class="hidden w-5 h-5 text-white animate-spin" viewBox="0 0 24 24"
                        fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </button>
            </form>

            {{-- Kirim ulang kode --}}
            <form method="POST" action="{{ route('verification.resend') }}" id="resend-form" class="mt-4 text-center">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" id="resend-btn" class="text-blue-600 hover:underline">
                    Kirim ulang kode
                </button>
            </form>
        </div>
    </div>

    {{-- Script interaksi --}}
    <script>
        const codeInput = document.getElementById('code');
        const form = document.getElementById('verify-form');
        const btn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const spinner = document.getElementById('btn-spinner');
        const resendForm = document.getElementById('resend-form');
        const resendBtn = document.getElementById('resend-btn');

        // Auto-hilang alert
        setTimeout(() => {
            document.getElementById('alert-success')?.remove();
            document.getElementById('alert-error')?.remove();
        }, 3500);

        // Saat submit verifikasi
        form.addEventListener('submit', function() {
            btn.disabled = true;
            btnText.textContent = 'Memverifikasi...';
            spinner.classList.remove('hidden');
        });

        // Auto hapus error & auto submit kalau sudah 6 digit
        codeInput.addEventListener('input', () => {
            document.getElementById('alert-error')?.remove();
            if (codeInput.value.length === 6) {
                form.requestSubmit();
            }
        });

        // Timer 60 detik untuk resend
        resendForm.addEventListener('submit', function() {
            let timer = 60;
            resendBtn.disabled = true;
            resendBtn.classList.remove('hover:underline');
            const countdown = setInterval(() => {
                resendBtn.textContent = `Kirim ulang kode (${timer}s)`;
                timer--;
                if (timer < 0) {
                    clearInterval(countdown);
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Kirim ulang kode';
                    resendBtn.classList.add('hover:underline');
                }
            }, 1000);
        });
    </script>
</x-guest-layout>
