<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'car_unit_id' => 'required',
            'file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan validasi dengan kebutuhan Anda
        ]);

        // Simpan file gambar yang diunggah
        $imageName = time().'.'.$request->file_path->extension();
        $request->file_path->move(public_path('images'), $imageName);

        // Simpan data baru ke dalam tabel
        Photo::create([
            'car_unit_id' => $request->car_unit_id,
            'file_path' => $imageName,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('photos.index')
            ->with('success', 'Photo created successfully.');
    }

    // Metode lainnya seperti edit, update, destroy, dll.
}
