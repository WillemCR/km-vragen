<x-app-layout>
    <style>
        table tr td {
            vertical-align: top;
        }
        .hide {
            display: none;
        }
    </style>

    <body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-600">Resultaten</h1>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gebruiker</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totaal Percentage</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scores per Pilaar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($results as $userResult)
                                <tr id="info-{{ $userResult['user']->id }}" class="info-row">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $userResult['user']->first_name }} {{$userResult['user']->last_name}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $userResult['average_percentage'] }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($userResult['pillar_scores'] as $pillar => $score)
                                            {{ $pillar }}: {{ $score }}%<br>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.results.download', $userResult['user']->id) }}" class="mt-4 text-green-600 hover:text-green-900 block">Download Excel</a>
                                        <button onclick="toggleDetails(event)" data-user="{{ $userResult['user']->id }}" class="text-blue-600 hover:text-blue-900">
                                            {{-- Dynamic button text --}}
                                            <span class="toggle-text">Meer Details</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr id="details-{{ $userResult['user']->id }}" class="hide">
                                    <td colspan="4">
                                        <div class="p-4 bg-gray-100">
                                            <table class="w-full">
                                                @foreach ($userResult['detailed_results'] as $detail)
                                                    <tr>
                                                        <td class="px-4 py-2 border-b border-gray-200">{{ $detail['title'] }}</td>
                                                        <td class="px-4 py-2 border-b border-gray-200">{{ $detail['description'] }}</td>
                                                        <td class="px-4 py-2 border-b border-gray-200">{{ $detail['answer'] }} ({{ $detail['percentage'] }}%)</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(event) {
            // Get the button element properly (even when clicking nested elements)
            const button = event.currentTarget;
            const userId = button.getAttribute('data-user');
            const detailsTr = document.getElementById(`details-${userId}`);

            if (!detailsTr) {
                console.error('Details row not found for user:', userId);
                return;
            }

            const isHidden = detailsTr.classList.contains('hide');

            // Hide all other details rows
            document.querySelectorAll('tr[id^="details-"]').forEach(row => {
                row.classList.add('hide');
            });

            // Toggle current details
            detailsTr.classList.toggle('hide');

            // Manage other info rows visibility
            document.querySelectorAll('.info-row').forEach(row => {
                if (isHidden) {
                    // When opening: hide others
                    if (!row.id.endsWith(userId)) row.classList.add('hide');
                } else {
                    // When closing: show all
                    row.classList.remove('hide');
                }
            });

            // Update button text
            const toggleText = button.querySelector('.toggle-text');
            toggleText.textContent = isHidden ? 'Minder Details' : 'Meer Details';
        }
    </script>
    </body>
</x-app-layout>
