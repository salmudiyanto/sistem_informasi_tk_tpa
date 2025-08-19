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
                                    <li class="breadcrumb-item"><a href="#">Tambah Murid</a>
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
                            <h4>Tambah Murid</h4>
                        </div>
                        <form action="{{ route('siswa.store') }}" method="POST">
                            
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $siswa->nama ?? '') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? '') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Wali</label>
                                    <select name="wali_id" class="form-control" required>
                                        <option value="">-- Pilih Wali --</option>
                                        @foreach($wali as $w)
                                            <option value="{{ $w->id }}" {{ old('wali_id', $siswa->wali_id ?? '') == $w->id ? 'selected' : '' }}>{{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Tingkat</label>
                                    <select name="tingkat_id" class="form-control" required>
                                        <option value="">-- Pilih Tingkat --</option>
                                        @foreach($tingkat as $t)
                                            <option value="{{ $t->id }}" {{ old('tingkat_id', $siswa->tingkat_id ?? '') == $t->id ? 'selected' : '' }}>{{ $t->nama_tingkat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', $siswa->tanggal_masuk ?? '') }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="aktif" {{ old('status', $siswa->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $siswa->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
                                @csrf
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection