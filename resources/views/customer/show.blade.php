<x-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Ticket Details</h2>

        <div class="bg-gray-500/30 shadow rounded-lg overflow-hidden mb-4">
            <div class="bg-gray-100/20 px-6 py-4">
                <strong>Subject: </strong>{{ $ticket->subject }}
            </div>
            <div class="px-6 py-4">
                <p class="mb-2"><strong>Description: </strong>{{ $ticket->description }}</p>
                <p class="mb-2"><strong>Status: </strong>
                    <span
                        class="inline-block px-2 py-1 text-sm font-semibold rounded {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </p>
                <p class="mb-2"><strong>Created At: </strong>{{ $ticket->created_at }}</p>
            </div>

            <div class="pt-5 border-t border-gray-200/15">
                @foreach ($ticket->replies as $reply)
                    <div class="bg-zinc-800/0 px-6 py-4">
                        <strong>{{ $reply->user->name }}:</strong>
                        <p class="mb-2">{{ $reply->message }}</p>
                        <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('customer.tickets') }}"
            class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-3">
            Back to Tickets
        </a>
    </div>
</x-layout>
