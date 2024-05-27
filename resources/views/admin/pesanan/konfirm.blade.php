@extends('admin.layout.main') {{-- Assuming you have a base layout called 'app.blade.php' --}}
@section('title', 'Data Konfirmasi Pesanan')
@section('content')
<div class="card">
    <div class="card-header">
        <h1 style="color:#585858">
            <i style="margin-right:7px" class="ace-icon fa fa-retweet"></i> @yield('title')
        </h1>
    </div><!-- /.page-header -->

    @if (empty(request('alert')))
    @elseif (request('alert') == 1)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong><i class="ace-icon fa fa-check-circle"></i> Pembayaran diterima</strong>
            <br>
        </div>
    @elseif (request('alert') == 2)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong><i class="ace-icon fa fa-times-circle"></i> Pembayaran ditolak</strong>
            <br>
        </div>
    @endif

    <div class="card-body">
        <div class="table-header">
            Data Konfirmasi Pembayaran
        </div>
        <table id="basic-datatables" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Konsumen</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th></th>
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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                data-target="#addRowModal{{ $item->id }}">
                                Details
                            </button>
                            @if ($item->status == 'Pembayaran Diterima')
                                <button class="btn btn-warning btn-round" data-toggle="modal" data-target="#confirmModal{{ $item->id }}">
                                    KONFIRMASI
                                </button>
                            @elseif ($item->status == 'Pesanan Diproses')
                                <button class="btn btn-danger btn-round" data-toggle="modal" data-target="#shipModal{{ $item->id }}">
                                    KIRIM
                                </button>
                            @endif
                            <button class="btn btn-danger btn-round" data-toggle="modal" data-target="#cancelModal{{ $item->id }}">
                                BATALKAN
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="confirmModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">Konfirmasi Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin mengonfirmasi pesanan ini?
                                </div>
                                <div class="modal-footer border-0">
                                    <form action="{{ route('konfirmasi', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Ya, Konfirmasi</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Batalkan -->
                    <div class="modal fade" id="cancelModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">Batalkan Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin membatalkan pesanan ini?
                                </div>
                                <div class="modal-footer border-0">
                                    <form action="{{ route('batal', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.col -->
</div><!-- /.row -->

@foreach ($transactions as $detail)   
<div class="modal fade" id="addRowModal{{ $detail->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Detail</span>
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
                        @php $no = 1; @endphp
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});
    });
</script>
@endsection
