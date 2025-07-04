@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-4">
            <h3 class="text-primary mb-4">Tambah Data Booking</h3>

            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Nama Hewan</label>
                        <input type="text" name="nama_hewan" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jenis Hewan</label>
                        <select name="jenis_hewan" class="form-select" required>
                            <option value="">- Pilih -</option>
                            <option value="Kucing">Kucing</option>
                            <option value="Anjing">Anjing</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Usia</label>
                        <input type="text" name="usia" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label>Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>No. Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Tanggal Booking</label>
                        <input type="date" name="tanggal_booking" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Jam Booking</label>
                        <input type="time" name="jam_booking" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Foto Hewan (Opsional)</label>
                    <input type="file" name="images" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Simpan Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
