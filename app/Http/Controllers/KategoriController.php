<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori; // Assuming you have a Kategori model
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display categories
        $kategori = kategori::all(); 
        confirmDelete('Hapus Data', 'Apakah anda yakin menghapus data ini?');
        return view('kategori.index',compact('kategori'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $id = $request->id; 
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $id,
            'deskripsi' => 'required|max:100|min:10',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'deskripsi.max' => 'Deskripsi maksimal 100 karakter',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
        ]);

        Kategori::updateOrCreate(
            ['id' => $id],
            [
                'nama_kategori' => $request->nama_kategori,
                'slug' => Str::slug($request->nama_kategori),
                'deskripsi' => $request->deskripsi,
            ]
        );

        toast()->success('Data berhasil disimpan', 'Success');
        return redirect()->route('master-data.kategori.index');
    }

    public function destroy(String $id)
    {
        // Logic to delete a category
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        toast()->success('Data berhasil dihapus', 'Success');
        return redirect()->route('master-data.kategori.index');
    }
}
