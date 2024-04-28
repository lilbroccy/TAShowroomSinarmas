<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = Category::all();
        return view('tampilan-admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $category = Category::create($validatedData);
        return response()->json(['message' => 'Data kategori berhasil ditambahkan', 'data' => $category], 201);
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Data kategori berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data kategori'], 500);
        }
    }

    public function update(Request $request, $id)
    {   

        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->all());
        return response()->json(['message' => 'Data kategori berhasil diperbarui.']);
    }



    public function getCategory()
    {
        $categories = Category::all();
        return response()->json($categories);

    }
}
