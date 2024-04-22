<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan formulir untuk membuat booking baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Logic untuk menampilkan formulir pembuatan booking
    }

    /**
     * Menyimpan booking baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Logic untuk menyimpan booking baru
    }

    /**
     * Menampilkan rincian booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Menampilkan formulir untuk mengedit booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Logic untuk menampilkan formulir edit booking
    }

    /**
     * Memperbarui booking yang ditentukan di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Logic untuk memperbarui booking
    }

    /**
     * Menghapus booking yang ditentukan dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Logic untuk menghapus booking
    }
}
