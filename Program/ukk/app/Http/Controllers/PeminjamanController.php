<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function tampil()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.tampil', compact('peminjaman'));
    }

    public function input($id)
    {
        $buku = Buku::findOrFail($id);
        return view('peminjaman.input', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cek stok buku
        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
        return back()->with('error', 'Stok buku habis!');
        }

        // Kurangi stok
        $buku->decrement('stok', $request->jumlah);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function peminjamanku()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())->get();
        return view('peminjaman.peminjamanku', compact('peminjaman'));
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Pastikan hanya user yang meminjam bisa kembalikan
        if ($peminjaman->user_id != auth()->id()) {
            return redirect()->route('peminjaman.peminjamanku')->with('error', 'Anda tidak memiliki akses ke peminjaman ini.');
        }

        // Tambah kembali stok buku
        $peminjaman->buku->increment('stok', $peminjaman->jumlah);

        // Update status menjadi kembali
        $peminjaman->update(['status' => 'kembali']);

        return redirect()->route('peminjaman.peminjamanku')->with('success', 'Buku berhasil dikembalikan.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,kembali,terlambat',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        return redirect()->route('peminjaman.tampil')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
