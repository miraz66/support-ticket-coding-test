<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10 md:px-8">
        <h2 class="text-2xl font-bold mb-4">Your Tickets</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-700">ID
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-700">
                            Subject</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Status
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-700">
                            Created At</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-sm font-medium text-gray-700">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr class="border-b">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $ticket->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $ticket->subject }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span
                                    class="inline-block px-2 py-1 text-sm font-semibold rounded
                                    {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $ticket->created_at }}</td>
                            <td class="px-6 py-4 flex justify-between items-center">
                                <div>
                                    <a href="{{ route('admin.show', $ticket->id) }}"
                                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        View
                                    </a>
                                </div>

                                @if ($ticket->status === 'open')
                                    <form action="{{ route('admin.close', $ticket) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            Close Ticket
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
