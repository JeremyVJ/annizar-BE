@extends('layout.main') {{-- Assuming you have a base layout named 'app.blade.php' --}}

@section('content')
<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        <i style="margin-right:6px" class="fa fa-shopping-cart"></i>
                        Cara Pembelian
                    </h3>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="active">Cara Pembelian</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div style="padding: 0 10px;text-align:justify">
                        <p style="margin-bottom:5px;font-size:20px">{{ $data['judul'] }}</p>
                        <p>{!! $data['keterangan'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
