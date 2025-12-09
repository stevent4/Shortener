@extends('layouts.app', ['title' => 'Users'])

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Admin - Users</h1>

    <div class="bg-white shadow-md rounded-xl overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Links</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-2 text-gray-700">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-gray-700 break-all">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $user->short_links_count }}</td>
                    <td class="px-4 py-2">
                        <span class="{{ $user->is_admin ? 'text-green-600 font-semibold' : 'text-gray-500' }}">
                            {{ $user->is_admin ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 flex flex-wrap gap-2">
                        <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}" class="inline">
                            @csrf @method('PATCH')
                            <button class="px-2 py-1 text-sm rounded-md {{ $user->is_admin ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }} transition">
                                {{ $user->is_admin ? 'Revoke' : 'Make Admin' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Hapus user?');">
                            @csrf @method('DELETE')
                            <button class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
