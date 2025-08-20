@extends('guru.app')

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
                                    <li class="breadcrumb-item"><a href="#">Guru</a>
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
                            <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                            <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            <p><strong>Wali:</strong> {{ $siswa->wali->nama }}</p>
                    
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hafalan as $index => $doa)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $doa->nama_doa }}</td>
                                            <td>{{ $doa->kategori }}</td>
                                            <td>{{ $doa->tanggal_setor ?? '-' }}</td>
                                            <td>{{ $doa->guru->nama ?? '-' }}</td>
                                            <td>{{ $doa->status ?? 'Belum Setor' }}</td>
                                            <td>
                                                @if ($doa->status != 'hafal')
                                                    
                                                        <form action="{{ route('guru.tambahSetor', [$idSiswa, $doa->id]) }}" method="post">
                                                            @csrf
                                                                
                                                                    <select name="catatan" class="form-control" id="">
                                                                        <option value="belum" selected>belum hafal</option>
                                                                        <option value="hafal">hafal</option>
                                                                        <option value="revisi">revisi</option>
                                                                    </select>
                                                                
                                                                
                                                                    <button type="submit" class="btn btn-success">Paraf</button>
                                                                
                                                            </form>
                                                        
                                                    @endif
                                                    
                                            </td>
                                            

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