<x-app-layout>
    <body class="bg-gray-100 font-sans">

<div class="container mx-auto px-4 py-8">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex flex-col">
        <div class="overflow-hidden sm:rounded-lg">
            <a href="{{ route('admin.questions.create') }}" class="mb-4 text-indigo-600 hover:text-indigo-900">Toevoegen</a>
            <div class="shadow border-b border-gray-200">
                <table class="min-w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('admin.questions', ['sort' => 'title', 'direction' => ($sortField == 'title' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">Titel</a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('admin.questions', ['sort' => 'description', 'direction' => ($sortField == 'description' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">Vraag</a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('admin.questions', ['sort' => 'pillar_name', 'direction' => ($sortField == 'pillar_name' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}">Pijler</a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($questions as $question)
                        <tr>
                            <td class="px-6 py-4 whitespace-normal break-words">{{ $question->title }}</td>
                            <td class="px-6 py-4 whitespace-normal break-words">{{ $question->description }}</td>
                            <td class="px-6 py-4 whitespace-normal break-words">{{ $question->pillar->pillar_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex space-x-2">
                                <a href="{{ route('admin.questions.edit', $question->id) }}" class="text-indigo-600 hover:text-indigo-900">Bewerken</a>
                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')" class="text-red-600 hover:text-red-900">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
</x-app-layout>
