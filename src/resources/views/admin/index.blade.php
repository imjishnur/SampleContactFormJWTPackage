<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Contact Submissions</h1>

        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form action="{{ route('admin.contact-submissions.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                <input type="text" name="user_search" placeholder="Search..." value="{{ request('user_search') }}" 
                    class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                    class="border border-gray-300 rounded px-3 py-2 text-gray-700">
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                    class="border border-gray-300 rounded px-3 py-2 text-gray-700">
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Filter</button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm uppercase">
                        <th class="p-4 font-semibold">ID</th>
                        <th class="p-4 font-semibold">Name</th>
                        <th class="p-4 font-semibold">Email</th>
                        <th class="p-4 font-semibold">Subject</th>
                        <th class="p-4 font-semibold">Message</th>
                        <th class="p-4 font-semibold">Date</th>
                        <th class="p-4 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                    @forelse($submissions as $sub)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">{{ $sub->id }}</td>
                        <td class="p-4 font-medium text-gray-900">{{ $sub->name }}</td>
                        <td class="p-4">{{ $sub->email }}</td>
                        <td class="p-4">{{ $sub->subject }}</td>
                        <td class="p-4 max-w-xs truncate" title="{{ $sub->message }}">{{ $sub->message }}</td>
                        <td class="p-4">{{ $sub->created_at->format('Y-m-d H:i') }}</td>
                        <td class="p-4">
                            <form action="{{ route('admin.contact-submissions.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Confirm delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="p-8 text-center text-gray-500">No submissions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $submissions->links() }}
        </div>
    </div>
</body>
</html>