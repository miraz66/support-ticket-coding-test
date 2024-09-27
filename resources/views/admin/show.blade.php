<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold mb-6">Ticket Details</h2>

        <div class="bg-white shadow rounded-lg mb-6">
            <div class="bg-gray-100 px-6 py-4">
                <strong>Ticket #{{ $ticket->id }}:</strong> {{ $ticket->subject }}
            </div>
            <div class="px-6 py-4">
                <p class="mb-4">{{ $ticket->description }}</p>
                <span
                    class="inline-block px-2 py-1 text-sm font-semibold rounded
                         {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </div>
        </div>

        <h3 class="text-xl font-bold mb-4">Replies</h3>
        <div class="pt-5 border-t border-gray-200/15">
            @foreach ($ticket->replies as $reply)
                <div class="flex mb-4 {{ $reply->user_type === 'customer' ? 'justify-start' : 'justify-end' }}">
                    <div class="bg-zinc-800/5 px-6 py-4 rounded-lg w-[40%] bg-zinc-700">
                        <strong>{{ $reply->user_type }}:</strong>
                        <p class="mb-2">{{ $reply->message }}</p>
                        <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Reply Form for Admin -->
        @if ($ticket->status === 'open')
            <form action="{{ route('admin.reply', $ticket->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                    <textarea name="message" rows="5" required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
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
            <a href="/admin" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Back to Tickets
            </a>
        @endif
    </div>
</x-app-layout>
