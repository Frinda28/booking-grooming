<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $bookings = Booking::all();
    return view('bookings.index', compact('bookings'));
}

public function create()
{
    return view('bookings.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama_hewan' => 'required|string',
        'jenis_hewan' => 'required|string',
        'usia' => 'required|string',
        'pemilik' => 'required|string',
        'nomor_telepon' => 'required|string',
        'tanggal_booking' => [
            'required',
            Rule::unique('bookings')->where(function ($query) use ($request) {
                return $query
                    ->where('tanggal_booking', $request->tanggal_booking)
                    ->where('jam_booking', $request->jam_booking);
            }),
        ],
        'jam_booking' => 'required',
        'images' => 'nullable|string',
    ], [
        'tanggal_booking.unique' => 'Slot pada tanggal dan jam ini sudah terisi. Silakan pilih jam lain.'
    ]);

    Booking::create($request->all());
    return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan!');
}

public function edit($id)
{
    $booking = Booking::findOrFail($id);
    return view('bookings.edit', compact('booking'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_hewan' => 'required|string',
        'jenis_hewan' => 'required|string',
        'usia' => 'required|string',
        'pemilik' => 'required|string',
        'nomor_telepon' => 'required|string',
        'tanggal_booking' => [
            'required',
            Rule::unique('bookings')->where(function ($query) use ($request, $id) {
                return $query
                    ->where('tanggal_booking', $request->tanggal_booking)
                    ->where('jam_booking', $request->jam_booking)
                    ->where('id', '!=', $id);
            }),
        ],
        'jam_booking' => 'required',
        'images' => 'nullable|string',
    ], [
        'tanggal_booking.unique' => 'Slot pada tanggal dan jam ini sudah terisi. Silakan pilih jam lain.'
    ]);

    $booking = Booking::findOrFail($id);
    $booking->update($request->all());
    return redirect()->route('bookings.index')->with('success', 'Booking berhasil diupdate!');
}



public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();
    return redirect()->route('bookings.index');
}
}