<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Web E-Commerce pada Anizzar Catering Inong">
    <meta name="author" content="Anizzar Catering Inong">

    <title>Invoice | Anizzar Catering Inong</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/logo.png">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            margin: 1.5cm;
            /* Set page margin */
            font-size: 12px;
        }

        /* Additional custom styles for your content */
        .container {
            padding: 15px;
        }

        .card {
            margin-top: 20px;
        }

        /* ... add any other custom styles ... */
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="row">
                    <h3>
                        <img src="{{ asset('assets/img/logo.png') }}" width="115">
                        INVOICE PEMBELIAN Anizzar Catering INONG
                    </h3>
                    <hr style="border: solid 1px black">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <table class="table table-bordered">
                                <h4>Alamat Tujuan</h4>
                                <table class="table">
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $konsumen->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Hp</th>
                                        <td>: {{ $konsumen->telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <td>: {{ $transactions->tanggal_transaksi }}</td>
                                    </tr>
                                </table>
                            </table>
                            <table class="table table-bordered">
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
                                        $totalJumlahBeli = 0;
                                    @endphp
                                    @foreach ($detailTransactions as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->barang->nama_barang }}</td>
                                            <td>{{ $data->jumlah_beli }}</td>
                                            <td>{{ 'Rp ' . number_format($data->jumlah_bayar, 0, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $totalJumlahBeli += $data->jumlah_bayar;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Jasa Kirim</strong></td>
                                        <td>{{ 'Rp ' . number_format($transactions->total_bayar - $totalJumlahBeli, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><b>Total</b></td>
                                        <td>{{ 'Rp ' . number_format($transactions->total_bayar, 0, ',', '.') }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <p>
                            <div class="">
                                <a href="{{ url('/') }}" class="btn btn-primary">Beranda</a>
                            </div>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
