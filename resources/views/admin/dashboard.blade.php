@extends('admin.layout.main')
@section('title', 'Dashboard')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- PAGE CONTENT BEGINS -->
                <div style="margin-top:10px" class="alert alert-block alert-info">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <i class="ace-icon fa fa-user blue"></i>
                    Selamat datang
                    <strong class="blue">{{ Auth::user()->name }}</strong>.
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <hr>
        <div class="row mt-md-2">
            <iframe title="Report Section" width="1250" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZGViNTAyNjctYjM1Zi00OGUyLWEwNmEtMmJiN2IyNWYxNzY3IiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
        </div>

        <div class="row">
            <div class="col-xs-5">
                <?php

          if (!is_null($transaksi) && $transaksi->jumlah > 0) { ?>
                <div class="col-12">
                    <div style="margin-top:10px" class="alert alert-block alert-info">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <a href="{{ route('admin.pesanan') }}">
                            <i class="ace-icon fa fa-info-circle blue"></i>
                            Anda memiliki <?php echo $transaksi->jumlah; ?> pesanan baru.
                        </a>
                    </div>
                </div>
                <?php
            }

            if (!$pembayaran->isEmpty()) {
                foreach ($pembayaran as $row) {
                    $jumlah = $row->jumlah;
                    $status_bayar = $row->status_bayar;
                    ?>
                <div style="margin-top:10px" class="alert alert-block alert-info">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <a href="?module=konfirmasi">
                        <i class="ace-icon fa fa-info-circle blue"></i>
                        Anda memiliki <?php echo $jumlah; ?> konfirmasi pembayaran baru.
                    </a>
                </div>
                <?php
                }
            }
			?>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
