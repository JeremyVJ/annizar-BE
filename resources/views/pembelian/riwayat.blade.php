@extends('layout.main')
@section('content')
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Kembali</a></li>
                    <li class="breadcrumb-item ">
                        Riwayat Pembayaran
                    </li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Total Bayar</th>
                                        <th>Status Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tanggal_transaksi }}</td>
                                            <td>{{ $item->total_bayar }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                                    data-target="#addRowModal{{ $item->id }}">
                                                    Details
                                                </button>
                                                @if ($item->status == 'Menunggu Proses Pembayaran')
                                                    <a href="{{ route('user.pembelian.deleteRiwayat', $item->id) }}"
                                                        class="btn btn-danger">Cancel Order</a>
                                                @elseif ($item->status == 'Pesanan Dikirim')
                                                    @if ($item->konfirmasi == 'false')
                                                        <a href="{{ route('user.pembelian.konfirmasi', $item->id) }}"
                                                            class="btn btn-warning">Konfirmasi</a>
                                                    @elseif ($item->konfirmasi == 'true')
                                                        <p class="btn btn-success">Sudah diterima</p>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
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
                                        <td>{{ $data->barang->nama_barang }}</td>
                                        <td>{{ $data->jumlah_beli }}</td>
                                        <td>{{ $data->jumlah_bayar }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Ongkos Kirim</th>
                                    <th>{{ $detail->total_bayar - $totalAmount }}</th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>Total</th>
                                    <th>{{ $detail->total_bayar }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
