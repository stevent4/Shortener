@extends('layouts.app', ['title' => 'Details'])

@section('content')
<div class="container mx-auto py-8 px-4">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Short Link</h2>

    <div class="bg-white shadow-md rounded-xl p-6 space-y-4">

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Pembuat:</span>
            <span class="text-gray-800">{{ $link->user->name }} (ID: {{ $link->user->id }})</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Short URL:</span>
            <a href="{{ url($link->short_code) }}" class="text-blue-600 hover:underline" target="_blank">
                {{ url($link->short_code) }}
            </a>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Original URL:</span>
            <span class="text-gray-700 break-all">{{ $link->original_url }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Status Aktif:</span>
            <span class="{{ $link->is_active ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                {{ $link->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Private:</span>
            <span class="{{ $link->is_private ? 'text-blue-600 font-semibold' : 'text-gray-600' }}">
                {{ $link->is_private ? 'Ya' : 'Tidak' }}
            </span>
        </div>

        @if($link->is_private)
            <div class="flex flex-col sm:flex-row sm:justify-between">
                <span class="font-medium text-gray-700">Password:</span>
                <span class="text-gray-500">Terenkripsi (tidak dapat ditampilkan)</span>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Kadaluarsa:</span>
            <span class="text-gray-800">
                @if($link->expired_at)
                    {{ $link->expired_at->format('d M Y H:i') }}
                    @if($link->expired_at->isPast())
                        <span class="text-red-600 font-semibold">(Sudah Expired)</span>
                    @endif
                @else
                    <span class="text-gray-500">Tidak ada</span>
                @endif
            </span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Total Klik:</span>
            <span class="text-gray-800">{{ $link->clicks }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:justify-between">
            <span class="font-medium text-gray-700">Dibuat Pada:</span>
            <span class="text-gray-800">{{ $link->created_at->format('d M Y H:i') }}</span>
        </div>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">← Kembali</a>
        </div>
    </div>

    {{-- Riwayat Klik --}}
    <h3 class="text-xl font-semibold mt-10 mb-4 text-gray-800">Riwayat Klik</h3>

    <div class="bg-white shadow-md rounded-xl p-4">
        @if ($clicks->count() == 0)
            <p class="text-gray-500">Belum ada klik.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Agent</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referrer</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($clicks as $c)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-2 text-gray-700">{{ $c->ip_address }}</td>
                                <td class="px-4 py-2 text-gray-700 break-all">{{ $c->user_agent }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $c->referrer ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-500">{{ $c->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $clicks->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
