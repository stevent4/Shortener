@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="container mx-auto py-8 px-2 sm:px-4">

        <h1 class="text-2xl font-bold mb-4">🚀 Dashboard - My Short Links</h1>

        @if (session('success'))
            <div class="bg-green-100 p-3 mb-4 rounded text-green-800 animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form Short Link --}}
        <div class="bg-white p-6 rounded shadow mb-6">
            <form action="{{ route('shorten.store') }}" method="POST" class="space-y-4 text-base">
                @csrf
                <div>
                    <label class="block font-medium mb-1">Original URL</label>
                    <input name="original_url" type="url" required value="{{ old('original_url') }}"
                        class="w-full border rounded p-3 text-base focus:ring-2 focus:ring-purple-300 focus:outline-none">
                    @error('original_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Custom Code (opsional)</label>
                        <input name="custom_code" type="text" value="{{ old('custom_code') }}"
                            class="w-full border rounded p-3 text-base focus:ring-2 focus:ring-purple-300 focus:outline-none">
                        @error('custom_code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Expired At (opsional)</label>
                        <input name="expired_at" type="date" value="{{ old('expired_at') }}"
                            class="w-full border rounded p-3 text-base focus:ring-2 focus:ring-purple-300 focus:outline-none">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label class="inline-flex items-center text-base">
                        <input type="checkbox" name="is_private" class="form-checkbox text-purple-600">
                        <span class="ml-2">Private</span>
                    </label>
                    <input name="password" type="password" placeholder="Password (jika private)"
                        class="border rounded p-3 text-base flex-1 w-full sm:w-auto focus:ring-2 focus:ring-purple-300 focus:outline-none">
                </div>

                <div>
                    <button
                        class="bg-purple-600 text-white px-5 py-3 rounded w-full sm:w-auto text-base hover:bg-purple-700 transition">
                        Shorten
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Short Links --}}
        <div class="bg-white p-4 rounded shadow overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-purple-100 text-left text-purple-800">
                        <th class="p-2 w-10">#</th>
                        <th class="p-2">Short</th>
                        <th class="p-2">Original</th>
                        <th class="p-2">Clicks</th>
                        <th class="p-2">Expired</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($links as $index => $link)
                        <tr class="border-t hover:bg-purple-50 transition">
                            <td class="py-2 px-2 font-medium">{{ $index + $links->firstItem() }}</td>
                            <td class="py-2 px-2 text-blue-600 break-words">
                                <a href="{{ url($link->short_code) }}" target="_blank" class="hover:underline">
                                    {{ url($link->short_code) }}
                                </a>
                            </td>
                            <td class="py-2 px-2 break-words truncate max-w-xs" title="{{ $link->original_url }}">
                                {{ $link->original_url }}
                            </td>
                            <td class="py-2 px-2 font-semibold">{{ $link->clicks }}</td>
                            <td class="py-2 px-2">{{ $link->expired_at ? $link->expired_at->format('Y-m-d') : '-' }}</td>
                            <td class="py-2 px-2 flex flex-col sm:flex-row sm:space-x-2 space-y-1 sm:space-y-0">
                                <form method="POST" action="{{ route('shortlink.destroy', $link) }}"
                                    onsubmit="return confirm('Hapus link?');" class="inline">
                                    @csrf @method('DELETE')
                                    <button
                                        class="flex items-center text-red-600 px-2 py-1 border rounded hover:bg-red-50 transition">
                                        🗑️ Delete
                                    </button>
                                </form>
                                <button onclick="copyToClipboard('{{ url($link->short_code) }}')"
                                    class="flex items-center text-gray-600 px-2 py-1 border rounded hover:bg-gray-100 transition">
                                    📋 Copy
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $links->links() }}
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard?.writeText(text).then(() => {
                alert('Copied: ' + text);
            }).catch(() => {
                prompt('Copy manually:', text);
            });
        }
    </script>

    <style>
        /* Smooth fade-in effect for table rows */
        tr {
            transition: background-color 0.2s ease;
        }
    </style>
@endsection
