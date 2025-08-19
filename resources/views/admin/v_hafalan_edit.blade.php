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
                                    <h4>Data Hafalan</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Data Hafalan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-warning background-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="ti-close text-white"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $error }}
                                </div>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Hafalan</h4>
                        </div>
                        {{-- <form action="" method="POST"> --}}
                        <form action="{{ route('munaqasah.update', $hafalan->id) }}" method="POST">
                             @csrf
                             @method('PUT')

                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama_doa" class="form-control" value="{{ old('nama_doa', $hafalan->nama_doa ?? '') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Kategori</label>
                                    <select name="kategori" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Qiraah" {{ old('kategori', $hafalan->kategori ?? '') == 'Qiraah' ? 'selected' : '' }}>Qiraah</option>
                                        <option value="Bacaan Solat" {{ old('kategori', $hafalan->kategori ?? '') == 'Bacaan Solat' ? 'selected' : '' }}>Bacaan Solat</option>
                                        <option value="Doa Harian" {{ old('kategori', $hafalan->kategori ?? '') == 'Doa Harian' ? 'selected' : '' }}>Doa Harian</option>
                                        <option value="Ayat Pilihan" {{ old('kategori', $hafalan->kategori ?? '') == 'Ayat Pilihan' ? 'selected' : '' }}>Ayat Pilihan</option>
                                        <option value="Surah Pendek" {{ old('kategori', $hafalan->kategori ?? '') == 'Surah Pendek' ? 'selected' : '' }}>Surah Pendek</option>
                                        <option value="Lainnya" {{ old('kategori', $hafalan->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                                               
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('munaqasah.index') }}" class="btn btn-secondary">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection