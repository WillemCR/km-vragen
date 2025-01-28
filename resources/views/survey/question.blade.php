<x-app-layout>
    <div class="px-4 py-8">
        <h1 class="text-2xl font-bold mb-4 text-center text-indigo-600">Vraag {{ $currentQuestionIndex + 1 }} van {{ $questions->count() }}</h1>

        <div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
            <h1 class="text-5xl font-semibold mb-4">{{ $currentQuestion->pillar->pillar_name }}</h1>
            <h2 class="text-3xl font-semibold mb-4">{{ $currentQuestion->title }}</h2>
            <h3 class="text-xl mb-4">{{ $currentQuestion->description }}</h3>

            <form action="{{ route('survey.submit') }}" method="POST" class="space-y-4">
                @csrf
                @foreach($answers as $index => $answer)
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="answer" value="{{ $answer->id }}" {{ $index === 0 ? 'checked' : '' }} required class="form-radio text-indigo-600">
                        <span class="text-gray-700 text-sm">{{ $answer->text }}</span>
                    </label>
                @endforeach
                <div class="flex justify-between">
                    @if($currentQuestionIndex > 0)
                        <button type="button" onclick="goBack()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                            Vorige
                        </button>
                    @endif
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-50">
                            @if($currentQuestionIndex < $questions->count() - 1)
                                Volgende
                            @else
                                Voltooien
                            @endif
                        </button>
                </div>
            </form>

            <script>
                function goBack() {
                    document.location.href = "{{ route('survey.previous') }}";
                }
            </script>
        </div>
    </div>
</x-app-layout>
