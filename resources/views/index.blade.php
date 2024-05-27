@extends('layout.main') {{-- Assuming you have a base layout called 'app.blade.php' --}}
@section('title', ' Riwayat Pesanan')
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
                                    <th>Tanggal Transaksi</th>
                                    <th>Konsumen</th>
                                    <th>Jumlah</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td width="40" class="center">{{ $no++ }}</td>
                                        <td width="100" class="center">
                                            {{ date('d-m-Y', strtotime($transaction->tanggal_transaksi)) }}</td>
                                        <td width="150">{{ $transaction->konsumen->user->name }}</td>
                                        <td width="70" class="center">{{ $transaction->detailCount }} barang</td>
                                        <td width="100" align="right">Rp.
                                            {{ number_format($transaction->total_bayar, 0, ',', '.') }}</td>
                                        <td width="150">{{ $transaction->status }}</td>
                                        <td width="60" class="center">
                                            <a data-rel="tooltip" data-placement="top" title="Detail"
                                                class="blue tooltip-info" href="">
                                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                            </a>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
        });
    </script>
@endsection
