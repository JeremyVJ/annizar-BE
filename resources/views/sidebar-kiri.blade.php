<div style="margin-top:45px" class="panel panel-default">
    <div class="panel-body">
        <p style="margin-bottom:5px;font-size:17px;border-bottom:2px solid #eee;padding-bottom:5px">Kategori Produk</p>

        @foreach ($categories as $data)
            <div class="media">
                <div class="media-body">
                    <i class="fa fa-angle-double-right"></i>
                    <a class="media-heading" href="{{ route('products.index',$data->id)  }}">{{ $data->nama_kategori }}</a>
                </div>
            </div>
            <div style="border-bottom:1px dotted #eee;padding-bottom:5px"></div>
        @endforeach
    </div>
</div>

<div style="margin-top:25px" class="panel panel-default">
    <div class="panel-body">
        <p style="margin-bottom:5px;font-size:17px;border-bottom:2px solid #eee;padding-bottom:5px">Produk Kami</p>

        @foreach ($featuredProducts as $data)
            <div class="media">
                <div class="media-left">
                    <a href="">
                        <img style="margin-top: 5px" class="media-object" src="{{ Storage::url('app/public/'.$data->gambar)  }}" width="100" alt="Warta Terbaru">
                    </a>
                </div>
                <div class="media-body">
                    <a class="media-heading" href="">{{ $data->nama_barang }}</a>
                    <p>Rp. {{ number_format($data->harga) }}</p>
                    <p>
                    @if (!Auth::check())
                        <a style="width:70px" href="javascript:void(0);" onclick="alert('Anda harus login terlebih dahulu!');" class="btn btn-primary" role="button">
                            <i class="fa fa-shopping-cart"></i> Beli
                        </a>
                    @else
                        <a style="width:70px" href="{{ route('user.pembelian.index',['produk' => $data->id]) }}" class="btn btn-primary" role="button">
                            <i class="fa fa-shopping-cart"></i> Beli
                        </a>
                    @endif
                    </p>
                </div>
            </div>
            <div style="border-bottom:1px dotted #eee;padding-bottom:15px"></div>
        @endforeach
    </div>
</div>
