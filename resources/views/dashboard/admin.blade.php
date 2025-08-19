@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="list-group mb-3">
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action">Data Siswa</a>
                <a href="#" class="list-group-item list-group-item-action">Data Guru</a>
                <a href="#" class="list-group-item list-group-item-action">Pembayaran</a>
                <a href="#" class="list-group-item list-group-item-action">Tingkat</a>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Main Panel -->
            <div class="card">
                <div class="card-header">Selamat Datang Admin</div>
                <div class="card-body">
                    <p>Ini adalah halaman dashboard untuk admin.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
