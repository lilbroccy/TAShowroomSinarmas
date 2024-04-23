<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Models\CarUnit;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $carUnitId)
    {
        $carUnit = CarUnit::findorfail($carUnitId);
        return view('layoutadmin.car-units-photos', compact('carUnit'));
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
    public function store(Request $request, int $carUnitId)
{   
    $request->validate([
        'photos.*' => 'required|image|mimes:png,jpg,jpeg,webp'
    ]);

    // Iterasi setiap file foto
    foreach ($request->file('photos') as $photo) {
        $filename = date('Y-m-d') . $photo->getClientOriginalName();
        $path = 'car-units-photos/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $data['car_unit_id'] = $carUnitId;
        $data['file_path'] = $path;

        Photo::create($data);
    }

    return redirect()->route('dashboard.car-units');
}


    // Metode lainnya seperti edit, update, destroy, dll.
}
