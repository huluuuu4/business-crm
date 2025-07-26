<div class="relative" x-data="{ open: false }" wire:poll> <button @click="open = !open" class="relative p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
        
        @if($notifications->count() > 0)
            <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                {{ $notifications->count() }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-20">
        <div class="p-4 font-bold border-b">Notifications</div>
        <div class="p-2 max-h-96 overflow-y-auto">
            @forelse ($notifications as $notification)
               <a href="#" 
                   wire:click.prevent="markAsRead('{{ $notification->id }}')"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                    {{ $notification->data['message'] }}
                    <span class="block text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="text-sm text-gray-500 p-4 text-center">No new notifications.</p>
            @endforelse
        </div>
    </div>
</div>