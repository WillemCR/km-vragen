<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dit is het begin van de enquête.</h2>
                <p class="text-gray-600 mb-6">Let op: U kunt de enquête maar een keer invullen, als u eenmaal op voltooien heeft gedrukt kunt u niet meer terug</p>
                <div class="flex justify-center">
                    <a href="{{ route('survey.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 active:bg-blue-900 transition ease-in-out duration-150">
                            {{ __('Start Enquête') }}
                        </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
