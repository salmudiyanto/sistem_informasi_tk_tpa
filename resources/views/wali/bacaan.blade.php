@extends('wali.app')

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
                                    <h4>Data Siswa</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Wali</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Setor Hafalan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Siswa: {{ $siswa->nama }}</h4>
                            <a href="{{ route('setor.bacaan') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                            <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            <p><strong>Tingkat:</strong> {{ $siswa->tingkat->nama_tingkat }}</p>
                    
                            <h5 class="mt-4">Daftar Bacaan</h5>
                            @if ($siswa->tingkat->id == '1')
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Iqra</th>
                                        <th>Halaman Mulai</th>
                                        <th>Halaman Selesai</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Guru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bacaan as $index => $bacaan)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $bacaan->tanggal }}</td>
                                            <td>{{ $bacaan->surat }}</td>
                                            <td>{{ $bacaan->ayat_mulai }}</td>
                                            <td>{{ $bacaan->ayat_selesai }}</td>
                                            <td>{{ $bacaan->status }}</td>
                                            <td>{{ $bacaan->catatan }}</td>
                                            <td>{{ $bacaan->guru->nama }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Surat</th>
                                        <th>Ayat Mulai</th>
                                        <th>Ayat Selesai</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Guru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bacaan as $index => $bacaan)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $bacaan->tanggal }}</td>
                                            <td>{{ $bacaan->surat }}</td>
                                            <td>{{ $bacaan->ayat_mulai }}</td>
                                            <td>{{ $bacaan->ayat_selesai }}</td>
                                            <td>{{ $bacaan->status }}</td>
                                            <td>{{ $bacaan->catatan }}</td>
                                            <td>{{ $bacaan->guru->nama }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            <h5 class="mt-4">Daftar Hafalan</h5>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Hafalan</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Setor</th>
                                        <th>Guru</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hafalan as $index => $doa)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $doa->nama_doa }}</td>
                                            <td>{{ $doa->kategori }}</td>
                                            <td>{{ $doa->tanggal_setor ?? '-' }}</td>
                                            <td>{{ $doa->guru_nama ?? '-' }}</td>
                                            <td>{{ $doa->status ?? 'Belum Setor' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection