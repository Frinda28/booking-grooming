@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bookings.update', $booking->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Hewan</label>
            <input type="text" name="nama_hewan" class="form-control" value="{{ $booking->nama_hewan }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Hewan</label>
            <select name="jenis_hewan" class="form-select" required>
                <option value="">- Pilih -</option>
                <option value="Kucing" {{ $booking->jenis_hewan == 'Kucing' ? 'selected' : '' }}>Kucing</option>
                <option value="Anjing" {{ $booking->jenis_hewan == 'Anjing' ? 'selected' : '' }}>Anjing</option>
            </select>
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
            <input type="hidden" name="old_images" value="{{ $booking->images }}">
            @if($booking->images)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $booking->images) }}" width="120">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
