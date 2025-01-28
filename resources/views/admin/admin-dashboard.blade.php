<x-app-layout>
    <body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Admin Dashboard</h1>

        <!-- Grid with 2 columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Button 1 -->
            <a href="{{ route('admin.default-answers') }}" class="bg-white shadow-md rounded-lg p-8 text-center hover:bg-indigo-100 transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Standaardantwoorden</h2>
                <p class="text-gray-600">Pas standaard antwoorden aan</p>
            </a>

            <!-- Button 2 -->
            <a href="{{ route('admin.questions') }}" class="bg-white shadow-md rounded-lg p-8 text-center hover:bg-indigo-100 transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Vragen</h2>
                <p class="text-gray-600">Beheer vragen</p>
            </a>

            <!-- Button 3 -->
            <a href="{{ route('admin.users') }}" class="bg-white shadow-md rounded-lg p-8 text-center hover:bg-indigo-100 transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Gebruikers</h2>
                <p class="text-gray-600">Beheer gebruikers</p>
            </a>

            <!-- Button 4 -->
            <a href="{{ route('admin.results') }}" class="bg-white shadow-md rounded-lg p-8 text-center hover:bg-indigo-100 transition duration-300">
                <h2 class="text-2xl font-semibold mb-4">Resultaten</h2>
                <p class="text-gray-600">Bekijk resultaten</p>
            </a>
        </div>
    </div>
    </body>
</x-app-layout>
