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
                            Detail Produk
                        </h4>



                        <div style="text-align:justify;margin-top:35px;margin-bottom:35px;" class="row">
                            <div class="col-md-6">
                                <img style="border:1px solid #eee;border-radius:2px" class="img-responsive img-hover"
                                    src="{{ Storage::url('app/public/' . $product->gambar) }}" width="400"
                                    alt="">
                            </div>
                            <div class="col-md-6">
                                <h3>{{ $product->nama_barang }}</h3>
                                {!! $product->deskripsi !!}
                                <br>
                                <p><strong>Harga : Rp. {{ number_format($product->harga) }}</strong></p>
                                <p><strong>Stok : {{ $product->stok }}</strong></p>
                                <br>
                                <p>
                                    @if (!Auth::check())
                                        <a style="width:70px" href="javascript:void(0);"
                                            onclick="alert('Anda harus login terlebih dahulu!');" class="btn btn-primary"
                                            role="button">
                                            <i class="fa fa-shopping-cart"></i> Beli
                                        </a>
                                    @else
                                        <a style="width:70px"
                                            href="{{ route('user.pembelian.index', ['produk' => $product->id]) }}"
                                            class="btn btn-primary" role="button">
                                            <i class="fa fa-shopping-cart"></i> Beli
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Produk Lainnya</h4>

                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($featuredProducts as $otherProduct)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a href="">
                                            <img style="height:180px"
                                                src="{{ Storage::url('app/public/' . $otherProduct->gambar) }}"
                                                alt="Produk Terlaris">
                                        </a>
                                        <div style="border-top:1px solid #eee;margin-top:10px" class="caption">
                                            <h4 style="font-size:17px">{{ $otherProduct->nama_barang }}</h4>
                                            <p>Rp. {{ number_format($otherProduct->harga) }}</p>
                                            <p>
                                                @if (!Auth::check())
                                                    <a style="width:70px" href="javascript:void(0);"
                                                        onclick="alert('Anda harus login terlebih dahulu!');"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @else
                                                    <a style="width:70px"
                                                        href="{{ route('user.pembelian.index', ['produk' => $otherProduct->id]) }}"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fa fa-shopping-cart"></i> Beli
                                                    </a>
                                                @endif
                                                <a style="width:80px" href="" class="btn btn-default"
                                                    role="button"><i class="fa fa-eye"></i> Detail</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr>

                <h4><i class="fa fa-comments"></i> Komentar</h4>

                <hr>

                <!-- Komentar -->
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($comments as $comment)
                            <div class="media">
                                <div class="media-left">
                                    <h1 style="border:1px solid #ddd;border-radius:100%;padding:11px 15px;"
                                        class="media-heading"><i class="fa fa-user"></i></h1>
                                    <small>{{ date('Y-m-d', strtotime($comment->tanggal)) }}</small>
                                </div>

                                <div class="media-body">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <h4 class="media-heading">{{ $comment->user->name }}
                                                <small>({{ $comment->user->email }})</small>
                                            </h4>
                                            <p>{{ $comment->komentar }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr>

                <h4><i class="fa fa-edit"></i> Berikan Komentar</h4>

                <hr>

                <!-- Form Komentar -->
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('user.pembelian.komentar', $product->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="komentar" rows="5" placeholder="Komentar" required></textarea>
                            </div>
                            @if (!Auth::check())
                                <a style="width:100px" href="javascript:void(0);"
                                    onclick="alert('Anda harus login terlebih dahulu!');" class="btn btn-primary"
                                    role="button">
                                    Submit
                                </a>
                            @else
                                <button style="width:100px" type="submit" class="btn btn-primary">Submit</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
