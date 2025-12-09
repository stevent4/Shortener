<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLinkController extends Controller
{
    public function index()
    {
        $links = ShortLink::with('user')->latest()->paginate(20);

        return view('admin.links.index', compact('links'));
    }

    public function toggleActive(ShortLink $link)
    {
        $link->is_active = ! $link->is_active;
        $link->save();

        return back()->with('success', 'Status link diperbarui.');
    }

    public function destroy(ShortLink $link)
    {
        $link->delete();
        return back()->with('success', 'Link dihapus.');
    }

    public function show(ShortLink $link)
    {
        // Ambil riwayat klik & paginate
        $clicks = $link->clicks()->latest()->paginate(20);

        return view('admin.links.show', [
            'link' => $link,
            'clicks' => $clicks
        ]);
    }
}
