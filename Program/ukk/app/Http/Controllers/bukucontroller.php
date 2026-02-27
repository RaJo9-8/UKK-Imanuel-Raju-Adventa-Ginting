<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class bukucontroller extends Controller
{
    public function tampil()
    {
        $buku = Buku::all();
        return view('buku.tampil', compact('buku'));
    }

    public function input()
    {
        return view('buku.input');
    }
        public function store(Request $request)
        {
            $request->validate([
                'nama_buku' => 'required',
                'pengarang' => 'required',
                'penerbit' => 'required',
                'kode_buku' => 'required',
                'stok' => 'required|integer',
            ]);

            // Simpan data buku ke database
            Buku::create([
                'nama_buku' => $request->nama_buku,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'kode_buku' => $request->kode_buku,
                'stok' => $request->stok,
            ]);

            return redirect()->route('buku.tampil')->with('success', 'Buku berhasil ditambahkan.');
        }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }
        public function update(Request $request, $id)
        {
            $request->validate([
                'nama_buku' => 'required',
                'pengarang' => 'required',
                'penerbit' => 'required',
                'kode_buku' => 'required',
                'stok' => 'required|integer',
            ]);

            $buku = Buku::findOrFail($id);
            $buku->update([
                'nama_buku' => $request->nama_buku,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'kode_buku' => $request->kode_buku,
                'stok' => $request->stok,
            ]);

            return redirect()->route('buku.tampil')->with('success', 'Buku berhasil diperbarui.');
        }
    
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.tampil')->with('success', 'Buku berhasil dihapus.');
    }

    public function search(Request $request)
    {
    $query = $request->input('q');

    $buku = Buku::query()
        ->when($query, function($q) use ($query) {
            $q->where('nama_buku', 'like', "%{$query}%")
              ->orWhere('pengarang', 'like', "%{$query}%")
              ->orWhere('penerbit', 'like', "%{$query}%");
        })
        ->get();

    return view('dashboard.tampil', compact('buku'));
    }
}
