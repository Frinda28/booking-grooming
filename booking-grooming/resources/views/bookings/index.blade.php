@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Data Booking Grooming</h5>
    </div>
    <div class="card-body">
        <a href="{{ route('bookings.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> Tambah Booking
        </a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Hewan</th>
                        <th>Usia</th>
                        <th>Pemilik</th>
                        <th>No. Telepon</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $key => $booking)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->nama_hewan }}</td>
                            <td>{{ $booking->jenis_hewan }}</td>
                            <td>{{ $booking->usia }}</td>
                            <td>{{ $booking->pemilik }}</td>
                            <td>{{ $booking->nomor_telepon }}</td>
                            <td>{{ $booking->tanggal_booking }}</td>
                            <td>{{ $booking->jam_booking }}</td>
                            <td>
                                @if($booking->images)
                                    <img src="{{ asset('storage/' . $booking->images) }}" width="70">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data booking kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
