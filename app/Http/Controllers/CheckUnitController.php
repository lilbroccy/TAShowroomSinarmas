<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckUnit;
use App\Models\CarUnit;
use App\Models\User;

class CheckUnitController extends Controller
{
    public function index() {
        $checkUnits = CheckUnit::all();
        return view('tampilan-admin.check-units', compact('checkUnits'));
    }

    public function show(CheckUnit $checkUnit)
    {
        return view('tampilan-admin.check-units', compact('checkUnit'));
    }

    public function store(Request $request){
    // Validasi data yang diterima dari request
    $validatedData = $request->validate([
        'car_id' => 'required', // Ganti 'car_id' menjadi 'car_id'
        'user_id' => 'required', // Ganti 'user_
        'date' => 'required|date',
        'time' => 'required',
        'note' => 'nullable'
    ]);
    
    // Simpan data ke dalam database
    $checkUnit = new CheckUnit();
    $checkUnit->car_unit_id = $validatedData['car_id']; // Ganti 'carname' menjadi 'car_unit_id'
    $checkUnit->user_id = $validatedData['user_id']; // Gan
    $checkUnit->date = $validatedData['date'];
    $checkUnit->time = $validatedData['time'];
    $checkUnit->status = 'Menunggu Persetujuan'; // Set status secara otomatis
    $checkUnit->note = $validatedData['note'];
    $checkUnit->save(); 

    // Kirim respons ke JavaScript
    return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function checkBooking(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');
        $userId = $request->input('user_id');
        $carId = $request->input('car_id');
        $bookingExists = CheckUnit::where('car_unit_id', $carId)
                                    ->where('user_id', $userId)
                                    ->where('car_unit_id', $carId)
                                    ->where('date', $date)
                                    ->where('time', $time)
                                    ->exists();
        return response()->json(['bookingExists' => $bookingExists]);
    }

    public function rubahStatusCheckUnit(Request $request)
    {
        try {
            // Mendapatkan data dari body request
            $checkUnitId = $request->input('checkUnitId');
            $status = $request->input('status');
            $note = $request->input('note');

            // Proses untuk mengubah status check unit
            // Misalnya jika menggunakan model CheckUnit
            $checkUnit = CheckUnit::find($checkUnitId);
            $checkUnit->status = $status;
            
            // Jika ditolak, tambahkan note
            if ($status === 'Ditolak') {
                $checkUnit->note = $note;
            }

            $checkUnit->save();
            return response()->json(['success' => true, 'message' => 'Status cek unit berhasil diubah'], 200);
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan dalam mengubah status cek unit'], 500);
        }
    }
}
