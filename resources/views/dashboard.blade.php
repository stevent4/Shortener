<x-app-layout :title="'Dashboard'">

    <div class="card mb-4">
        <div class="card-header">
            <strong>Buat Short Link</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('shorten.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>URL Asli</label>
                    <input type="text" name="original_url" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Custom Kode (opsional)</label>
                    <input type="text" name="custom_code" class="form-control">
                </div>

                <button class="btn btn-primary">Shorten</button>
            </form>
        </div>
    </div>

    <h4>Link Anda</h4>

    <div class="card">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Short</th>
                    <th>Original</th>
                    <th>Klik</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($links as $link)
                    <tr>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ url($link->short_code) }}
                            </span>
                            <button onclick="copyText('{{ url($link->short_code) }}')" class="btn btn-sm btn-secondary">Copy</button>
                        </td>

                        <td>{{ Str::limit($link->original_url, 40) }}</td>
                        <td>{{ $link->clicks }}</td>
                        <td>{{ $link->created_at->diffForHumans() }}</td>

                        <td>
                            <form action="{{ route('shorten.delete', $link->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus link ini?')" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Belum ada link</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>
