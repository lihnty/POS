<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        confirmDelete('Hapus data produk ini?', 'Data yang dihapus tidak dapat dikembalikan!');
        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'nama_product'       => 'required|unique:products,nama_produk,'.$id,
            'harga_jual'        => 'required|numeric|min:0',
            'harga_beli_pokok'  => 'required|numeric|min:0',
            'kategori_id'       => 'required|exists:kategoris,id',
            'stok'             => 'required|numeric|min:0',
            'stok_minimal'     => 'required|numeric|min:0',
        ], [
            'nama_product.required' => 'Nama product wajib diisi',
            'nama_produk.unique'   => 'Nama product sudah ada',
            'harga_jual.required'  => 'Harga jual wajib diisi',
            'harga_jual.numeric'   => 'Harga jual harus berupa angka',
            'harga_jual.min'       => 'Harga jual minimal 0',
            'harga_beli_pokok.required' => 'Harga beli pokok wajib diisi',
            'harga_beli_pokok.numeric'  => 'Harga beli pokok harus berupa angka',
            'harga_beli_pokok.min'      => 'Harga beli pokok minimal 0',
            'kategori_id.required'      => 'Kategori harus di isi',
            'kategori_id.exists'        => 'Kategori tidak valid',
            'stok.required'             => 'Stok wajib diisi',
            'stok.numeric'              => 'Stok harus berupa angka',
        ]);


        $newRequest = [
                'id'                => $id,
                'nama_produk'       => $request->nama_product,
                'harga_jual'        => $request->harga_jual,
                'harga_beli_pokok'  => $request->harga_beli_pokok,
                'kategori_id'       => $request->kategori_id,
                'stok'              => $request->stok,
                'stok_minimal'      => $request->stok_minimal,
                'is_active'         => $request->is_active ? true : false,
        ];
        
        if(!$id){
            $newRequest['sku'] = Product::nomorSku();
        }
        Product::updateOrCreate(
            ["id" => $id], 
            $newRequest
            );
            toast()->success('data berhasil disimpan'); // ✅
            return redirect()->route('master-data.product.index');
    }

    public function destroy(String $id)
    {
        $product = Product::find($id);
        $product->delete();
        toast()->success('data berhasil dihapus'); // ✅
        return redirect()->route('master-data.product.index');
    }

    public function getData()
    {
        $search = request()->query('search');
        $query = Product::query();
        $product = $query->where('nama_produk', 'like', '%' . $search . '%')->get();
        return response()->json($product);
    }
    
    public function cekStok()
    {
        $id = request()->query('id');
        $stok = Product::find($id)->stok;
        return response()->json($stok);
    }
}
