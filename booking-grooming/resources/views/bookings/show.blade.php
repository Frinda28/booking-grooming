@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Booking</h1>

    <p><strong>Nama Hewan:</strong> {{ $booking->nama_hewan }}</p>
    <p><strong>Jenis Hewan:</strong> {{ $booking->jenis_hewan }}</p>
    <p><strong>Usia:</strong> {{ $booking->usia }}</p>
    <p><strong>Pemilik:</strong> {{ $booking->pemilik }}</p>
    <p><strong>Nomor Telepon:</strong> {{ $booking->nomor_telepon }}</p>
    <p><strong>Tanggal Booking:</strong> {{ $booking->tanggal_booking }}</p>
    <p><strong>Jam Booking:</strong> {{ $booking->jam_booking }}</p>

    <a href="{{ route('bookings.index') }}">Kembali ke daftar</a>
</div>
@endsection
