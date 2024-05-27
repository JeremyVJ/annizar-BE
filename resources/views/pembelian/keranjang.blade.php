@extends('layout.main')

@section('content')
    <!-- Page Heading/Breadcrumbs -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            <i style="margin-right:6px" class="fa fa-shopping-cart"></i>
                            Keranjang Belanja
                        </h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Keranjang Belanja</li>
                        </ol>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-12">
                        @if (empty(request('alert')))
                            {{-- No alert --}}
                        @elseif (request('alert') == 1)
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong> produk berhasil ditambahkan.
                            </div>
                        @elseif (request('alert') == 2)
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong><i class="glyphicon glyphicon-ok-circle"></i> Sukses!</strong> produk berhasil dihapus.
                            </div>
                        @endif
    
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Jumlah Beli</th>
                                                <th>Jumlah Bayar</th>
                                                <th></th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td width='40' class='center'>{{ $no++ }}</td>
                                                    <td width='60'><img src="{{ Storage::url('app/public/'.$transaction->gambar) }}" width="150"></td>
                                                    <td width='150'>{{ $transaction->nama_barang }}</td>
                                                    <td width='120'>Rp. {{ number_format($transaction->harga) }}</td>
                                                    <td width='100'>{{ $transaction->jumlah_beli }}</td>
                                                    <td width='120'>Rp. {{ number_format($transaction->jumlah_bayar) }}</td>
    
                                                    <td width='80' class="center">
                                                        <div>
                                                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm"
                                                                href="{{ route('user.pembelian.delete', ['id_konsumen' => $transaction->konsumen_id, 'id_barang' => $transaction->barang_id, 'stok' => $transaction->stok, 'jumlah_beli' => $transaction->jumlah_beli]) }}"
                                                                onclick="return confirm('Anda yakin ingin menghapus produk {{ $transaction->nama_barang }}?');">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Keranjang belanja masih kosong</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- /.panel -->
    
                        @if (count($transactions) > 0)
                            <div class="">
                                <a href="{{ url('/') }}" class="btn btn-primary">Lanjutkan Belanja</a>
                                &nbsp; &nbsp;
                                <a href="{{ route('user.pembelian.checkout') }}" class="btn btn-primary pull-right">Checkout</a>
                            </div>
                        @endif
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
