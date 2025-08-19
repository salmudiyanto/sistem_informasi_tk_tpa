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
                                    <h4>Data Guru</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Detail Guru</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <h1>Detail Guru</h1>
                            
                                <p><strong>Nama:</strong> {{ $guru->nama }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                <p><strong>Alamat:</strong> {{ $guru->alamat }}</p>
                                <p><strong>Telepon:</strong> {{ $guru->telepon }}</p>
                                <p><strong>Email:</strong> {{ $guru->email }}</p>
                                <p><strong>Bidang:</strong> {{ $guru->bidang }}</p>
                            
                                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection