<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
    $validatedData = $request->validate([
        'car_id' => 'required',
        'user_id' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'note' => 'nullable'
    ]);
    
    $checkUnit = new CheckUnit();
    $checkUnit->car_unit_id = $validatedData['car_id'];
    $checkUnit->user_id = $validatedData['user_id'];
    $checkUnit->date = $validatedData['date'];
    $checkUnit->time = $validatedData['time'];
    $checkUnit->status = 'Menunggu Persetujuan';
    $checkUnit->note = $validatedData['note'];
    $checkUnit->save(); 

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
        $checkUnitId = $request->input('checkUnitId');
        $status = $request->input('status');
        $note = $request->input('note');

        $adminId = Auth::id();

        $checkUnit = CheckUnit::find($checkUnitId);
        $checkUnit->status = $status;
        $checkUnit->last_edit_by = $adminId;
        
        $checkUnit->note_from_admin = $note;

        $updatedAt = Carbon::now()->addHours(7);
        $checkUnit->updated_at = $updatedAt;

        $checkUnit->save();

        return response()->json(['success' => true, 'message' => 'Status check unit berhasil diubah'], 200);
    } catch (\Exception $e) {
        \Log::error('Error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan dalam mengubah status check unit'], 500);
    }
}
}
