<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\ShortLinkClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ShortLinkController extends Controller
{
    /**
     * Dashboard User - Tampilkan semua shortlink milik user
     */
    public function index()
    {
        $links = auth()->user()
            ->shortLinks()
            ->latest()
            ->paginate(15);

        return view('shortlinks.index', compact('links'));
    }

    /**
     * Store shortlink baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => ['required', 'url', 'max:2000'],
            'custom_code' => ['nullable', 'alpha_dash', 'max:100'],
            'is_private' => ['nullable', 'in:on'],
            'password' => ['nullable', 'string', 'min:4'],
            'expired_at' => ['nullable', 'date', 'after:today'],
        ]);

        // generate atau pakai custom code
        $code = $request->custom_code ?: ShortLink::generateUniqueCode(6);

        // cek duplikasi kode
        if (ShortLink::where('short_code', $code)->exists()) {
            return back()->withErrors(['custom_code' => 'Custom code sudah digunakan.']);
        }

        // simpan data
        $link = ShortLink::create([
            'user_id' => auth()->id(),
            'original_url' => $request->original_url,
            'short_code' => $code,
            'is_private' => $request->has('is_private'),
            'password' => $request->filled('password') ? Hash::make($request->password) : null,
            'expired_at' => $request->expired_at ? Carbon::parse($request->expired_at) : null,
            'is_active' => true,
        ]);

        return back()->with('success', 'Short link berhasil dibuat: ' . url($link->short_code));
    }

    /**
     * Hapus link user atau admin
     */
    public function destroy(ShortLink $link)
    {
        if (auth()->id() !== $link->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $link->delete();

        return back()->with('success', 'Link berhasil dihapus.');
    }

    /**
     * Redirect shortlink
     */
    public function redirect(Request $request, $code)
    {
        $link = ShortLink::where('short_code', $code)->first();

        if (!$link || !$link->is_active) {
            abort(404);
        }

        // cek expired
        if ($link->expired_at && $link->expired_at->isPast()) {
            abort(404);
        }

        /**
         * Jika link private → cek password
         */
        if ($link->is_private) {

            // Jika POST, user mencoba memasukkan password
            if ($request->isMethod('post')) {
                $request->validate([
                    'password' => 'required|string'
                ]);

                if (!Hash::check($request->password, $link->password)) {
                    return back()->withErrors(['password' => 'Password salah.']);
                }

                // simpan session agar tidak diminta lagi
                session()->put("allow_link_{$link->id}", true);

                return redirect()->to(url($link->short_code));
            }

            // jika belum ada session → tampilkan halaman password
            if (!session()->get("allow_link_{$link->id}")) {
                return view('shortlinks.password', compact('link'));
            }
        }

        /**
         * Catat jumlah klik
         */
        $link->increment('clicks');

        ShortLinkClick::create([
            'short_link_id' => $link->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referrer' => $request->headers->get('referer'),
        ]);

        return redirect()->away($link->original_url);
    }

    public function show(ShortLink $link)
    {
        $clicks = $link->clicksHistory()->latest()->paginate(20);

        return view('admin.links.show', [
            'link' => $link,
            'clicks' => $clicks
        ]);
    }
}
