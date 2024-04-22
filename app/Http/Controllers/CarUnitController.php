<?php

namespace App\Http\Controllers;

use App\Models\CarUnit;
use Illuminate\Http\Request;

class CarUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carUnits = CarUnit::all();
        return view('index', compact('carUnits'));
    }

    public function dtCarUnits()
    {
        $carUnits = CarUnit::all();
        return view('layoutadmin.carunit', compact('carUnits'));
    }

    public function show($id)
    {
        $carUnit = CarUnit::findOrFail($id);
        return view('show', compact('carUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car_units.create');
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
            'name' => 'required',
            // Tambahkan validasi untuk atribut lainnya sesuai kebutuhan
        ]);

        // Simpan data baru ke dalam tabel
        CarUnit::create($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('car_units.index')
            ->with('success', 'Car Unit created successfully.');
    }

    //GetDetailMobilToSwetAlert
    public function getDetail($id)
    {
        $carUnit = CarUnit::find($id);

        if (!$carUnit) {
            return response()->json(['error' => 'Car unit not found'], 404);
        }

        $secondPhotoUrl = null;
        $thirdPhotoUrl = null;

        $photos = $carUnit->photos;

        if ($photos->count() > 1) {
            $secondPhotoUrl = $photos[1]->file_path;
        }

        if ($photos->count() > 2) {
            $thirdPhotoUrl = $photos[2]->file_path;
        }

        // Mengembalikan detail carUnit dalam format JSON
        return response()->json([
            'name' => $carUnit->name,
            'price' => $carUnit->price,
            'description' => $carUnit->description,
            'image_url_1' => $carUnit->photos->first()->file_path,
            'image_url_2' => $secondPhotoUrl,
            'image_url_3' => $thirdPhotoUrl
        ]);
    }
    }