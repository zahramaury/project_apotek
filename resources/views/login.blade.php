@extends('layouts.template')

@section('content')
<form action="{{ route ('auth-login') }}" method="POST" class="card p-4 mt-5">
    @csrf
    {{--menampilkan error validasi--}}
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
         @endforeach
    </ul>
    @endif
    {{--menampilkan message dari controller with namanya failed--}}
    @if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
    @endif
    
    <div class="mb-3 mx-1">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
        placeholder="Masukkan email anda...">
    </div>
    <div class=mb-3 mx-1>
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control"
        placeholder="Masukkan password anda...">
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
</form>
@endsection
