@extends('layout.main') <!-- If you have a layout structure -->

@section('content')
    <script type="text/javascript">
        function cek_stok(input) {
            stk = document.frmBeli.stok.value;
            jml = document.frmBeli.jumlah_beli.value;
            var num = input.value;
            var stok = eval(stk);
            var jumlah = eval(jml);
            if (stok < jumlah) {
                alert('Jumlah Stok Tidak Memenuhi, Kurangi Jumlah Beli');
                input.value = input.value.substring(0, input.value.length - 1);
            }
        }

        function hitung_jumlah_bayar() {
            bil1 = document.frmBeli.harga.value;
            bil2 = document.frmBeli.jumlah_beli.value;
            if (bil2 == '') {
                var hasil = 0;
            } else {
                var hasil = eval(bil1) * eval(bil2);
            };
            document.frmBeli.jumlah_bayar1.value = "Rp. " + (hasil);
            document.frmBeli.jumlah_bayar.value = (hasil);
        }
    </script>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            <i style="margin-right:6px" class="fa fa-shopping-cart"></i>
                            Pembelian
                        </h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="">Pembelian</a></li>
                            <li class="active">Detail Produk</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-4">
                            <img style="border:1px solid #eee;border-radius:2px" class="img-responsive img-hover"
                                src="{{ Storage::url($product->gambar) }}" width="400" alt="">
                        </div>

                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('user.pembelian.store') }}" name="frmBeli">
                                        @csrf

                                        <input type="hidden" name="id_barang" value="{{ $product->id }}">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Barang</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_barang"
                                                    value="{{ $product->nama_barang }}" readonly required>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Harga</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="harga"
                                                    value="{{ $product->harga }}" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Stok</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="stok"
                                                    value="{{ $product->stok }}" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah Beli</label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('jumlah_beli') is-invalid @enderror"
                                                    id="jumlah_beli" name="jumlah_beli"
                                                    {{-- onKeyPress="return goodchars(event,'0123456789',this)" --}}
                                                    onkeyup="cek_stok(this)&hitung_jumlah_bayar(this)" required>
                                                @error('jumlah_beli')
                                                    <div style="color: red;"class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- ... Rest of the code ... -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah Bayar</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="jumlah_bayar1"
                                                    name="jumlah_bayar1" readonly required>
                                                <input type="hidden" id="jumlah_bayar" name="jumlah_bayar">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input style="width:100px" type="submit" class="btn btn-primary btn-submit"
                                                    name="simpan" value="Simpan">
                                                &nbsp; &nbsp;
                                                <a style="width:100px" href="{{ url('/') }}"
                                                    class="btn btn-default">Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
