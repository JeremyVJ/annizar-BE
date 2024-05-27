@extends('admin.layout.main')
@section('title', ' Data Pesanan')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 style="color:#585858">
                    <i style="margin-right:7px" class="ace-icon fa fa-shopping-cart"></i>
                    @yield('title')
                </h1>
            </div><!-- /.page-header -->
            <div class="card-body">
                <div class="row">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Konsumen</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transactions as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal_transaksi }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->total_bayar }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <button class="btn btn-shopee btn-round ml-auto" data-toggle="modal"
                                                data-target="#addRowModal{{ $item->id }}">
                                                Details
                                            </button>
                                            <button class="btn btn-shopee btn-round ml-auto" data-toggle="modal"
                                                data-target="#confirmModal{{ $item->id }}">
                                                Konfirmasi
                                            </button>
                                            @if ($item->status == 'Pembayaran Diterima')
                                                <a href="{{ route('admin.konfirmasi', $item->id) }}"
                                                    class="btn btn-warning btn-round">KONFIRMASI</a>
                                            @elseif ($item->status == 'Pesanan Diproses')
                                                <a href="{{ route('admin.kirim', $item->id) }}"></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- PAGE CONTENT ENDS -->
                </div>
            </div><!-- /.page-content -->
        </div>
    </div>

    @foreach ($transactions as $detail)
    <div class="modal fade" id="addRowModal{{ $detail->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Detail
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Beli</th>
                                    <th>Jumlah bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detailTransactions[$detail->id] as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jumlah_beli }}</td>
                                    <td>{{ $data->jumlah_bayar }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                         </table>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-shopee" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($transactions as $item)
    <div class="modal fade" id="confirmModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">
                        Konfirmasi Pesanan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.updateStatus', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Pilih Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Pesanan Diproses">Pesanan Diproses</option>
                                <option value="Pesanan Sukses">Pesanan Sukses</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
