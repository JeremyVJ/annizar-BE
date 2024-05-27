@extends('layout.main')
@section('content')
    @include('layout.carousel');
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('sidebar-kiri') <!-- Include your sidebar content -->
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">
                            Produk Terbaru
                        </h4>

                        <div class="row">
                            @foreach ($latestProducts as $data)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a href="">
                                            <img style="height:200px" src="{{ Storage::url('app/public/'.$data->gambar) }}"
                                                alt="Produk Terlaris">
                                        </a>
                                        <div style="border-top:1px solid #eee;margin-top:10px" class="caption">
                                            <h4 style="font-size:17px">{{ $data->nama_barang }}</h4>
                                            <p>Rp. {{ number_format($data->harga) }}</p>
                                            <p>
                                                @if (!Auth::check())
                                                    <a style="width:70px" href="javascript:void(0);"
                                                        onclick="alert('Anda harus login terlebih dahulu!');"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @else
                                                    <a style="width:70px" href="{{ route('user.pembelian.index',['produk' => $data->id]) }}" class="btn btn-primary"
                                                        role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @endif
                                                <a style="width:80px" href="{{ route('products.show', $data->id) }}"
                                                    class="btn btn-default" role="button"><i class="fa fa-eye"></i>
                                                    Detail</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- <a class="btn btn-default btn-block" href="">Tampilkan Lainnya</a> --}}
                    </div>
                </div>

                <!-- ... Repeat the same structure for "Produk Terlaris" section -->
            </div>
        </div>
    </div>
@endsection
