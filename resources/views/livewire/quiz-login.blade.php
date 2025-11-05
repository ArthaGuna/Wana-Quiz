<div class="w-full max-w-md mx-auto"> <!-- Hapus min-h-screen dan padding excessive -->
    <!-- Header dengan Icon -->
    <div class="text-center mb-6"> <!-- Kurangi margin -->
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-600 to-purple-800 rounded-full mb-3 shadow-lg">
            <svg class="w-8 h-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-purple-700 mb-2">Masukkan Kode Kuis</h2>
        <p class="text-gray-600 text-sm">Siap untuk memulai pembelajaran interaktif?</p>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <!-- Purple gradient header -->
        <div class="h-2"></div>
        
        <div class="p-6"> <!-- Kurangi padding -->
            <form wire:submit.prevent="submit">
                <div class="mb-4"> <!-- Kurangi margin -->
                    <label for="quizCode" class="block text-sm font-semibold text-purple-700 mb-2">
                        Kode Kuis
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="quizCode" 
                            wire:model="quizCode"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200 text-base"
                            placeholder="Masukkan kode kuis"
                            required
                            autofocus
                        >
                    </div>
                </div>

                @if ($errorMessage)
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded-lg"> <!-- Kurangi padding -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-red-700 font-medium text-sm">{{ $errorMessage }}</span>
                        </div>
                    </div>
                @endif

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-[1.02]"
                >
                    MULAI KUIS
                </button>
            </form>

            <!-- Informasi tambahan dengan icon -->
            <div class="mt-4 p-3 bg-purple-50 rounded-xl border border-purple-100">
                <div class="flex items-start">
                    <svg class="w-4 h-4 text-purple-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-purple-700"> <!-- Perkecil text -->
                        Masukkan kode kuis yang diberikan oleh pengajar untuk memulai kuis.
                    </p>
                </div>
            </div>
    </div>

</div>
<!-- Footer Text -->
<p class="align-center mt-2 text-center text-xs text-gray-500"> <!-- Kurangi margin dan perkecil text -->
    Pastikan koneksi internet Anda stabil selama mengerjakan kuis
</p>