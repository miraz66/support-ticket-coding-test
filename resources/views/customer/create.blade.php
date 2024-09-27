<x-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6">Submit a New Ticket</h2>

        <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-200 mb-2">Subject</label>
                <input type="text" id="subject" name="subject" required
                    class="block w-full px-3 py-2 bg-gray-600/10 border border-gray-500/40 rounded-md shadow-sm focus:outline-none focus:ring-gray-500/30 focus:border-gray-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-200 mb-2">Description</label>
                <textarea id="description" name="description" rows="5" required
                    class="block w-full px-3 py-2 border bg-gray-600/10 border-gray-500/40 rounded-md shadow-sm focus:outline-none focus:ring-gray-500/30 focus:border-gray-500 sm:text-sm"></textarea>
            </div>
            <button type="submit"
                class="bg-green-700 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit
            </button>
        </form>
    </div>
</x-layout>
