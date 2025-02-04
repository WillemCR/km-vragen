<x-app-layout>
    <div class="flex justify-center mb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-2xl mx-auto mt-8 bg-gray-200 mb-6 p-6 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Title -->
            <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Registreer</h2>

            <!-- First Name & Last Name -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="first_name" :value="__('Voornaam')" class="text-gray-700" />
                    <x-text-input id="first_name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Achternaam')" class="text-gray-700" />
                    <x-text-input id="last_name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password & Confirm Password -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="password" :value="__('Wachtwoord')" class="text-gray-700" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Phone Number & Company Name -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="phone_number" :value="__('Telefoonnummer')" class="text-gray-700" />
                    <x-text-input id="phone_number" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="tel" name="phone_number" :value="old('phone_number')" required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="company_name" :value="__('Bedrijfsnaam')" class="text-gray-700" />
                    <x-text-input id="company_name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="company_name" :value="old('company_name')" required />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>
            </div>

            <!-- Category -->
{{--            <div class="mb-4">--}}
{{--                <x-input-label for="category" :value="__('Categorie')" class="text-gray-700" />--}}
{{--                <select id="category" name="category" class="block mt-1 w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <x-input-error :messages="$errors->get('category')" class="mt-2" />--}}
{{--            </div>--}}

            <!-- Sector -->
            <div class="mb-4">
                <x-input-label for="sector" :value="__('SBI Code')" class="text-gray-700" />
                <select id="sector" name="sector" class="block mt-1 w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}"> {{ !$sector->sbi_code == 1 ? $sector->sbi_code . ' ' . $sector->name : $sector->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('sector')" class="mt-2" />
            </div>

            <!-- Footer Section -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    {{ __('Al geregistreerd?') }}
                </a>

                <x-primary-button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                    {{ __('Registreer') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
