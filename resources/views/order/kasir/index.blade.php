@extends('layouts.template')

@section('content')
 <div class="container mt-3">
            <form action="{{ route('order.search') }}" method="GET" >
                <div class="d-flex" style="width: 400px">
                    <input type="date" name="search" id="search" value="{{ request('search') }}" class="form-control" style="height:40px; margin-right: 1rem;">
                        <button type="submit" class="btn btn-primary" style="width: 200px;height:40px; margin-right: 1rem;">Cari Data</button>
                        <a href="{{ route('order.search') }}" class="btn btn-secondary" style="height:40px;">Reset</a>
                </div>
            </form>
          </div>
    <div class="justify-content-end d-flex"  style="margin-bottom: 10px; margin-top: -3rem;">
        <a href="{{ route('order.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
                <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr>
                <th>No</th>
                <th>Nama Pembali</th>
                <th>Pesanan</th>
                <th>Total Bayar</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
         @php $no = 1; @endphp
             @foreach ($orders as $order )
                <tr>
                    {{-- currentpage : diambil posisi ada di page keberapa -1  perpage : mengambil jumlah
                        data yang ditampilkan per page nya berapa loop->index : mengambil index dari array (mulai dari 0)+1)--}}
                        {{-- jadi : (2-1) * 5 + 1 = 6 (dimulai dari angka 6 di page 2 )--}}
                        <td>{{ ($orders->currentpage() -1 ) * $orders->perpage() + $loop->index + 1 }}</td>
                            <th>{{ $order['name_customer']}}</th>
                    {{-- nested loop : looping didalam looping--}}
                {{-- karna column medicines pada table orders tipe datanya json, jadi untuk akses nya perlu di looping--}}
                <td>
                    <ol>
                        @foreach ($order['medicines'] as $medicine )
                            <li>{{ $medicine['name_medicine'] }} <small>Rp. {{ number_format($medicine['price'],
                                0, '.', ',') }} <b>(qty : {{ $medicine['qty'] }})</b></small> = Rp. {{number_format($medicine['price_after_qty'], 0, '.', ',') }}</li>
                    @endforeach
                </ol>
            </td>
            @php
             $ppn = $order['total_price'] * 0.1;
                 @endphp
                    <td>Rp. {{ number_format(($order['total_price']+$ppn), 0, '.', ',') }}</td>
                    {{-- mengambil column dari relasi, $variable['namaFunctionDiModel']['namaColumnDiDBRrelasi]--}}
                        <td>{{ $order['user']['name']}} <a href="mailto:name@gmail.com">{{ $order['user']['email']}}</a></td>
                @php
                    setLocale(LC_ALL, 'IND');
                @endphp
                <td>{{ Carbon\Carbon::parse($order['created_at'])->formatLocalized('%d %B %Y')}}</td>
                <td>
                    <a href="{{ route('order.download-pdf', $order['id']) }}" class="btn btn-success">Download struk</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($orders->count())
            {{ $orders->links() }}
                 @endif
            </div>
        </div>
    @endsection
