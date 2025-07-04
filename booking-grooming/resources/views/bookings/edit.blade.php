@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>

    <form method="POST" action="{{ route('bookings.update', $booking->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Hewan</label>
            <input type="text" name="nama_hewan" class="form-control" value="{{ $booking->nama_hewan }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Hewan</label>
            <input type="text" name="jenis_hewan" class="form-control" value="{{ $booking->jenis_hewan }}" required>
        </div>

        <div class="mb-3">
            <label>Usia</label>
            <input type="text" name="usia" class="form-control" value="{{ $booking->usia }}" required>
        </div>

        <div class="mb-3">
            <label>Pemilik</label>
            <input type="text" name="pemilik" class="form-control" value="{{ $booking->pemilik }}" required>
        </div>

        <div class="mb-3">
            <label>Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" value="{{ $booking->nomor_telepon }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Booking</label>
            <input type="date" name="tanggal_booking" class="form-control" value="{{ $booking->tanggal_booking }}" required>
        </div>

        <div class="mb-3">
            <label>Jam Booking</label>
            <input type="time" name="jam_booking" class="form-control" value="{{ $booking->jam_booking }}" required>
        </div>

        <div class="mb-3">
            <label>Foto Hewan</label>
            <input type="file" name="images" class="form-control">
            @if($booking->images)
                <img src="{{ asset('storage/' . $booking->images) }}" width="120" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
