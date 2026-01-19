<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hero Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($screenshots as $screenshot)
                        <div class="border rounded-lg overflow-hidden shadow-md">
                            <img src="{{ Storage::url($screenshot->image_path) }}" alt="Screenshot" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <p class="text-sm font-bold text-gray-800">{{ $screenshot->user->name }}</p>
                                <p class="text-xs text-gray-500 mb-2">{{ $screenshot->created_at->diffForHumans() }}</p>
                                @if($screenshot->score)
                                <p class="text-sm text-blue-600 mb-2">Score: {{ $screenshot->score }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between mt-2">
                                    <form action="{{ route('gallery.like', $screenshot->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-1 {{ $screenshot->isLikedByAuthUser() ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $screenshot->isLikedByAuthUser() ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                            <span>{{ $screenshot->likes_count }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $screenshots->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
