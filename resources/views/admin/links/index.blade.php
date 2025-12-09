@extends('layouts.app', ['title' => 'All Links'])

@section('content')
<div class="container mx-auto py-8 px-4">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Semua Link</h3>

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembuat</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Short</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expired</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($links as $link)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-3 text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $link->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-blue-600 font-medium hover:underline">
                                <a href="{{ url($link->short_code) }}" target="_blank">{{ url($link->short_code) }}</a>
                            </td>
                            <td class="px-4 py-3 text-gray-700 truncate max-w-xs">{{ $link->original_url }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $link->expired_at ? $link->expired_at->translatedFormat('d F Y') : '-' }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $link->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 flex space-x-2">
                                <a href="{{ route('admin.links.show', $link->id) }}" 
                                   class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition">
                                    Detail
                                </a>

                                <form action="{{ route('admin.links.destroy', $link->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Apakah yakin ingin menghapus link ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">Belum ada link dibuat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
            {{ $links->links() }}
        </div>
    </div>
</div>
@endsection
