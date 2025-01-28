<x-app-layout>
    <body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Vraag Bewerken</h1>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!-- Update Vraag -->
    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="max-w-xl mx-auto mb-6">
        @csrf
        @method('PUT')

        <!-- Vraag Details -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
            <input type="text" name="title" id="title" value="{{ old('title', $question->title) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <!-- Vraag Details -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Vraagstelling</label>
            <input type="text" name="description" id="description" value="{{ old('description', $question->description) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Categorie -->
{{--        <div class="mb-4">--}}
{{--            <label for="category_id" class="block text-sm font-medium text-gray-700">Categorie</label>--}}
{{--            <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>--}}
{{--                @foreach ($categories as $category)--}}
{{--                    <option value="{{ $category->id }}" {{ old('category_id', $question->category_id) == $category->id ? 'selected' : '' }}>--}}
{{--                        {{ $category->category_name }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

        <!-- Pijler -->
        <div class="mb-4">
            <label for="pillar_id" class="block text-sm font-medium text-gray-700">Pijler</label>
            <select name="pillar_id" id="pillar_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($pillars as $pillar)
                    <option value="{{ $pillar->id }}" {{ old('pillar_id', $question->pillar_id) == $pillar->id ? 'selected' : '' }}>
                        {{ $pillar->pillar_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="sector_id" class="block text-sm font-medium text-gray-700">Sector</label>
            <select name="sector_id" id="sector_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" {{ old('pillar_id', $question->sector_id) == $sector->id ? 'selected' : '' }}>
                        {{ !$sector->sbi_code == 0 ? $sector->sbi_code . ' ' . $sector->name : $sector->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Antwoorden -->
        <div id="answers-container">
            @foreach ($question->answers as $index => $answer)
                <div class="answer-row flex items-center gap-4 mb-4">
                    <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
                    <input type="text" name="answers[{{ $index }}][text]" id="answer_{{ $index }}" value="{{ old("answers.$index.text", $answer->text) }}" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <input type="number" name="answers[{{ $index }}][percentage]" id="percentage_{{ $index }}" value="{{ old("answers.$index.percentage", $answer->percentage) }}" class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" max="100" required>
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="delete_answers[]" value="{{ $answer->id }}" id="delete_answer_{{ $index }}" class="mr-2">
                        Verwijder
                    </label>
                </div>
            @endforeach
        </div>

        <div class="flex justify-between items-center mt-6">
            <!-- Standaardantwoorden Laden -->
            <button type="submit" name="load_defaults" value="1"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Laad Standaardantwoorden
            </button>

            <!-- Bijwerken -->
            <button type="submit"
                    class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Bijwerken
            </button>
        </div>
    </form>

    <!-- Nieuw Antwoord Toevoegen -->

    <form action="{{ route('admin.questions.addAnswer', $question->id) }}" method="POST" class="max-w-xl mx-auto">
        @csrf
        <div class="flex items-center gap-4 mb-4">
            <input type="text" name="text" placeholder="Nieuw antwoord" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" required>
            <input type="number" name="percentage" placeholder="Percentage" class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" min="0" max="100" required>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Voeg Toe
            </button>
        </div>
    </form>
</div>
</body>
</x-app-layout>
