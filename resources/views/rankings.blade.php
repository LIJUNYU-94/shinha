<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rankings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- All Time Ranking -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">🏆 Top 10 All-Time Best</h3>
                        <table class="min-w-full text-left">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Rank</th>
                                    <th class="px-4 py-2">Player</th>
                                    <th class="px-4 py-2">Score</th>
                                    <th class="px-4 py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allTime as $index => $score)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $score->user->name }}</td>
                                    <td class="px-4 py-2 font-bold">{{ $score->points }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $score->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Daily Ranking -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4">📅 Top 10 Today's Best</h3>
                        <table class="min-w-full text-left">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Rank</th>
                                    <th class="px-4 py-2">Player</th>
                                    <th class="px-4 py-2">Score</th>
                                    <th class="px-4 py-2">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($daily as $index => $score)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $score->user->name }}</td>
                                    <td class="px-4 py-2 font-bold">{{ $score->points }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $score->created_at->format('H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">No scores yet today. Be the first!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
