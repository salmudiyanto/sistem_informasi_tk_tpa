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
                                    <h4>Data Wali</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Detail Wali</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Wali: {{ $wali->nama }}</h4>
                            <a href="{{ route('wali.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $wali->nama }}</p>
                            <p><strong>Alamat:</strong> {{ $wali->alamat }}</p>
                            <p><strong>Telepon:</strong> {{ $wali->telepon }}</p>
                            <p><strong>Email:</strong> {{ $wali->email }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $wali->pekerjaan }}</p>
                    
                            <h5 class="mt-4">Daftar Siswa</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tingkat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($wali->siswa as $s)
                                    <tr>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                        <td>{{ $s->tanggal_lahir }}</td>
                                        <td>{{ $s->tingkat->nama_tingkat ?? '-' }}</td>
                                        <td>{{ ucfirst($s->status) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada siswa</td>
                                    </tr>
                                    @endforelse
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