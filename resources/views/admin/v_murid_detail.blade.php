@extends('admin.app')

@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Data Murid</h4>
                                    <span> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="/"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Admin</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Detail Murid</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-block">
                            <div class="container">
                                <h2>Detail Murid</h2>
                                <table class="table">
                                    <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
                                    <tr><th>Jenis Kelamin</th><td>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                                    <tr><th>Tanggal Lahir</th><td>{{ $siswa->tanggal_lahir }}</td></tr>
                                    <tr><th>Alamat</th><td>{{ $siswa->alamat }}</td></tr>
                                    <tr><th>Wali</th><td>{{ $siswa->wali->nama ?? '-' }}</td></tr>
                                    <tr><th>Tingkat</th><td>{{ $siswa->tingkat->nama ?? '-' }}</td></tr>
                                    <tr><th>Tanggal Masuk</th><td>{{ $siswa->tanggal_masuk }}</td></tr>
                                    <tr><th>Status</th><td>{{ ucfirst($siswa->status) }}</td></tr>
                                </table>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection