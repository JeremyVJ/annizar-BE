<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request, $kategori)
    {
        $categories =  Kategori::all();
        $featuredProducts = Barang::inRandomOrder()->limit(7)->get();
        // Retrieve the category information based on the provided parameter
        $category = Kategori::where('id', $kategori)->first();

        // If the category is not found, you can handle it here

        $products = Barang::where('kategori_id', $category->id)
            ->orderBy('id', 'DESC')
            ->paginate(12);

        return view('product.index', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'nama_kategori' => $category->nama_kategori,
            'products' => $products,
            'paginationLinks' => $products->links(),
        ]);
    }

    public function show($produk)
    {
        $product = Barang::findOrFail($produk);
        $categories =  Kategori::all();
        $featuredProducts = Barang::inRandomOrder()->limit(7)->get();
        $comments = Komentar::with('user')->where('barang_id', $product->id)->get();
// dd($comments);
        return view('product.show', [
            'product' => $product,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'comments' => $comments,
        ]);
    }
}
