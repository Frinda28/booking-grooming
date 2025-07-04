<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
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
    // Validasi awal
    $request->validate([
        'nama_hewan' => 'required',
        'jenis_hewan' => 'required',
        'usia' => 'required',
        'pemilik' => 'required',
        'nomor_telepon' => 'required',
        'tanggal_booking' => 'required|date',
        'jam_booking' => 'required',
    ]);

    
    $existingBooking = Booking::where('tanggal_booking', $request->tanggal_booking)
        ->where('jam_booking', $request->jam_booking)
        ->first();

    if ($existingBooking) {
        return back()->withErrors(['jam_booking' => 'Jam ini sudah dipesan. Silakan pilih jam lain.'])->withInput();
    }

    
    $data = $request->all();

    if ($request->hasFile('images')) {
        $file = $request->file('images');
        $path = $file->store('bookings', 'public');
        $data['images'] = $path;
    }

    Booking::create($data);

    return redirect()->route('bookings.index')->with('success', 'Data booking berhasil ditambahkan!');
}


    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
{
    try {
        
        Log::info('Mulai update data booking.', [
            'id' => $id,
            'payload' => $request->all()
        ]);

        
        $request->validate([
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'usia' => 'required',
            'pemilik' => 'required',
            'nomor_telepon' => 'required',
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'required',
        ]);

        $existingBooking = Booking::where('tanggal_booking', $request->tanggal_booking)
            ->where('jam_booking', $request->jam_booking)
            ->where('id', '!=', $id)
            ->first();

        if ($existingBooking) {
            Log::warning('Update booking gagal karena jadwal bentrok.', [
                'id' => $id,
                'tanggal_booking' => $request->tanggal_booking,
                'jam_booking' => $request->jam_booking
            ]);

            return back()
                ->withErrors(['jam_booking' => 'Jam ini sudah dipesan. Silakan pilih jam lain.'])
                ->withInput();
        }

        
        $booking = Booking::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $path = $file->store('bookings', 'public');
            $data['images'] = $path;
        }

        $booking->update($data);

        Log::info('Data booking berhasil diupdate.', [
            'id' => $id
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Data booking berhasil diupdate!');
    } catch (\Exception $e) {
        Log::error('Gagal update data booking.', [
            'id' => $id,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
    }
}


    public function destroy($id)
    {
        try {
            Log::info('Mulai menghapus data booking.', ['id' => $id]);

            $booking = Booking::findOrFail($id);
            $booking->delete();

            Log::info('Data booking berhasil dihapus.', ['id' => $id]);

            return redirect()->route('bookings.index')->with('success', 'Data booking berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus data booking.', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
