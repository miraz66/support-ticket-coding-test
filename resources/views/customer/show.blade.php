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
        </div>

        <div class="bg-black">
            @foreach ($ticket->replies as $reply)
                <div class="flex mb-4 {{ $reply->user_type === 'admin' ? 'justify-start' : 'justify-end' }}">
                    <div class="bg-zinc-800 px-6 py-4 rounded-lg w-[40%]">
                        <strong>{{ $reply->user_type }}:</strong>
                        <p class="mb-2">{{ $reply->message }}</p>
                        <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Reply Form for Customer -->
        @if ($ticket->status === 'open')
            <form action="{{ route('customer.reply', $ticket->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Reply</label>
                    <textarea name="message" rows="5" required
                        class="block w-full px-3 py-2 border border-gray-300 bg-gray-600/80 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>

                <div class="flex justify-between">
                    <div>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Send Reply
                        </button>
                    </div>

                    <a href="/admin"
                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Back to Tickets
                    </a>
                </div>
            </form>
        @endif

        @if ($ticket->status === 'closed')
            <a href="/" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Back to Tickets
            </a>
        @endif
    </div>
</x-layout>
