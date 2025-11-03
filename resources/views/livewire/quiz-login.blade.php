<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">Masukkan Kode Kuis</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label for="quizCode" class="block font-semibold mb-2">Kode Kuis</label>
                    <input type="text" id="quizCode" wire:model="quizCode"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                @if ($errorMessage)
                    <div class="text-red-500 mb-4">{{ $errorMessage }}</div>
                @endif

                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Mulai Kuis
                </button>
            </form>
        </div>
    </div>

</div>
