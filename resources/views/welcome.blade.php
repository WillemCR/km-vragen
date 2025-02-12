<x-app-layout>
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-b from-blue-500 to-indigo-600 text-white">
        {{-- Header --}}
        <header class="py-4">
            <div class="container mx-auto flex justify-center items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-64 w-auto">
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-grow flex flex-col items-center justify-center text-center px-4">
            <h2 class="text-4xl font-extrabold mb-4">
                Inventarisatie module voor ESG – CSRD – SDG’s
            </h2>
            <p class="text-lg max-w-2xl mb-6">
                Creëer een account of log in om aan de slag te gaan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('register') }}" class="text-xl px-6 py-3 rounded bg-white text-blue-600 hover:bg-gray-200 transition">
                    Registreer een account
                </a>
                <a href="{{ route('login') }}" class="text-xl px-6 py-3 rounded bg-indigo-700 text-white hover:bg-indigo-800 transition">
                    Inloggen
                </a>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-blue-700 py-4 text-center text-sm">
            <div class="container mx-auto px-6">
                <p>
                    © 2025 Keurmerk
                </p>
            </div>
        </footer>
    </div>
</x-app-layout>
