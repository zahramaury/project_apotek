@extends('layouts.template')

@section('content')
<div class="jumbotron p-4 bg-light mt-5">
    <div class="container">
    <h1 class="display-4">Apotek App</h1>
    {{-- mengambil data dari table users sesuai data login --}}
    <h5>Selamat Datang. {{ Auth::user()->name}}</h5>
    <p class="lead">Aplikasi manajemen untuk pekerja administrator apotek. digunakan untuk admin logistik dan kasir</p>
</div>
</div>
@endsection
