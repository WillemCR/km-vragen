<x-app-layout>
    <body class="bg-gray-100 font-sans">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-center text-indigo-600 mb-8">Standaard antwoorden beheer</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Form to Add New Default Answer -->
        <h2 class="text-xl font-semibold mb-4">Voeg een Nieuw standaard antwoord Toe</h2>
        <form action="{{ route('admin.default-answers.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <div class="flex-1">
                    <label for="text" class="block text-gray-700 font-semibold">Naam</label>
                    <input type="text" id="text" name="text" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Standaard antwoord" required>
                </div>
                <div class="w-24">
                    <label for="percentage" class="block text-gray-700 font-semibold">Percentage</label>
                    <input type="number" id="percentage" name="percentage" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="%" min="0" max="100" required>
                </div>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">Opslaan</button>
        </form>

        <!-- List of Existing Default Answers -->
        <h2 class="text-xl font-semibold mb-4">Bestaande standaard antwoorden</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Text</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Percentage</th>
                <th class="px-6 py-3 text-right"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr class="border-t">
                    <td class="px-6 py-4">{{ $question->text }}</td>
                    <td class="px-6 py-4">{{ $question->percentage }}%</td>
                    <td class="px-6 py-4 text-right">
                        <!-- Delete Button -->
                        <form action="{{ route('admin.default-answers.destroy', $question->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Weet je zeker dat je dit standaard antwoord wilt verwijderen?')" class="text-red-600 hover:text-red-900">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</x-app-layout>
