<x-app-layout>
<body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Nieuwe Vraag Toevoegen</h1>

    <form action="{{ route('admin.questions.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Vraagstelling</label>
            <input type="text" name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
{{--        <div class="mb-4">--}}
{{--            <label for="category_id" class="block text-sm font-medium text-gray-700">Categorie</label>--}}
{{--            <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>--}}
{{--                @foreach ($categories as $category)--}}
{{--                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="mb-4">
            <label for="pillar_id" class="block text-sm font-medium text-gray-700">Pijler</label>
            <select name="pillar_id" id="pillar_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($pillars as $pillar)
                    <option value="{{ $pillar->id }}">{{ $pillar->pillar_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="sector_id" class="block text-sm font-medium text-gray-700">Sector</label>
            <select name="sector_id" id="sector_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}">
                        {{ !$sector->sbi_code == 0 ? $sector->sbi_code . ' ' . $sector->name : $sector->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Sectie voor antwoorden -->
        <div class="mb-6">
            <h2 class="text-lg font-medium text-gray-700 mb-2">Antwoorden</h2>
            <div id="answers-container" class="space-y-4">
                <!-- Dynamische antwoordvelden worden hier toegevoegd -->
            </div>

            <button type="button" id="add-answer-button" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Voeg Antwoord Toe
            </button>
        </div>

        <!-- Opslaan -->
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Opslaan
        </button>
        <button type="submit" name="load_defaults" value="true" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Opslaan met standaard antwoorden
        </button>
    </form>
</div>

<script>
    document.getElementById('add-answer-button').addEventListener('click', function () {
        const container = document.getElementById('answers-container');
        const index = container.children.length;

        const answerRow = document.createElement('div');
        answerRow.classList.add('flex', 'items-center', 'gap-4');

        answerRow.innerHTML = `
            <input type="text" name="answers[${index}][text]" placeholder="Antwoordtekst" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <input type="number" name="answers[${index}][percentage]" placeholder="Percentage" class="w-20 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" max="100" required>
            <button type="button" class="text-red-600 hover:text-red-800" onclick="removeAnswer(this)">
                X
            </button>
        `;

        container.appendChild(answerRow);
    });

    function removeAnswer(button) {
        // Verwijder de antwoordregel waarop de 'X' is geklikt
        const row = button.parentElement;
        row.remove();
    }
</script>
</body>
</x-app-layout>
