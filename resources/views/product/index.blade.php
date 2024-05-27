@extends('layout.main') <!-- If you have a layout structure -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('sidebar-kiri') <!-- Include the sidebar content -->
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">
                            Produk "{{ $nama_kategori }}"
                        </h4>

                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a href="">
                                            <img style="height:200px"
                                                src="{{ Storage::url('app/public/' . $product->gambar) }}"
                                                alt="Produk Terlaris">
                                        </a>
                                        <div style="border-top:1px solid #eee;margin-top:10px" class="caption">
                                            <h4 style="font-size:17px">{{ $product->nama_barang }}</h4>
                                            <p>Rp. {{ number_format($product->harga) }}</p>
                                            <p>
                                                @if (!Auth::check())
                                                    <a style="width:70px" href="javascript:void(0);"
                                                        onclick="alert('Anda harus login terlebih dahulu!');"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @else
                                                    <a style="width:70px"
                                                        href="{{ route('user.pembelian.index', ['produk' => $data->id]) }}"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @endif
                                                <a style="width:80px" href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-default" role="button"><i class="fa fa-eye"></i>
                                                    Detail</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <br />

                        <div class="row text-center">
                            <div class="col-lg-12">
                                <ul class="pagination">
                                    <!-- Pagination links -->
                                    {{ $paginationLinks }}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
