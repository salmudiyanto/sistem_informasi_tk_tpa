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
                                    <li class="breadcrumb-item"><a href="#">Edit Guru</a>
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
                    <div class="card">
                        <form action="{{ route('guru.update', $guru->id) }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="card-block">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama" id="nama" value="{{ $guru->nama }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-8 d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="jk" id="jkL" value="L" {{ $guru->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                            <label class="form-check-label" style="margin-right: 100px" for="jkL">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jk" id="jkP" value="P" {{ $guru->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="jkP">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $guru->alamat }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="telelpon">Telepon</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $guru->telepon }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $guru->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="bidang">Bidang</label>
                                    <div class="col-sm-8">
                                        <select name="bidang" class="form-control" id="bidang">
                                            <option value="0" selected disabled>--Pilih Bidang--</option>
                                            <option value="TK" {{ $guru->bidang == 'TK' ? 'selected' : '' }}>TKA</option>
                                            <option value="TPA" {{ $guru->bidang == 'TPA' ? 'selected' : '' }}>TPA</option>
                                            <option value="Keduanya" {{ $guru->bidang == 'Keduanya' ? 'selected' : '' }}>Keduanya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-warning">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection