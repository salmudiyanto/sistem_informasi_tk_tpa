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
                                    <h4>Iuran Bulanan</h4>
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
                                    <li class="breadcrumb-item"><a href="#">Data Siswa</a>
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
                        <div class="card-header mb-5">
                            
                        </div>
                        <div class="card-block">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tingkat</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no=1;
                                        @endphp
                                        @foreach ($iuranBulanan as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->siswa->nama }}</td>
                                                <td>{{ $row->siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>{{ $row->siswa->tingkat_id == '1' ? 'TKA' : 'TPA' }}</td>
                                                <td>{{ $row->bulan }}</td>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $row->jumlah }}</td>
                                                <td>{{ $row->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tingkat</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection