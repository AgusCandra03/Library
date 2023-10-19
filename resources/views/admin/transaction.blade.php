@extends('layouts.admin')
@section('header', 'Transaction')

@section('content')
{{-- @can('index peminjaman') --}}
@role('petugas')
<div id="controller">
    <div class="container">
        halaman transaksi
    </div>
</div>
@endrole
{{-- @endcan --}}
@endsection