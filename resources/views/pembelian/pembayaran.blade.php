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
                        Rincian Pembayaran
                    </li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <table class="table table-bordered">
                                <h4>Alamat Tujuan</h4>
                                <p>
                                    <i style="margin-right:7px" class="fa fa-user"></i>
                                    {{ Auth::user()->name }}
                                </p>
                                <p>
                                    <i style="margin-right:7px" class="fa fa-map-marker"></i>
                                    {{ $konsumen->alamat }}
                                </p>
                                <p>
                                    <i style="margin-right:7px" class="fa fa-phone"></i>
                                    {{ $konsumen->telepon }}
                                </p>
                            </table>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($transaksiPenyewaan as $item)
                                        <tr>
                                            <td>{{ $item->barang->nama_barang }}</td>
                                            <td>{{ $item->jumlah_beli }}</td>
                                            <td>{{ $item->barang->harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Ongkos Kirim</th>
                                        <th>{{ $ongkir }}</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>{{ $transaksiPenyewaan->sum('jumlah_beli') }}</th>
                                        <th>{{ $totalAmount + $ongkir }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button id="pay-button" name="pay-button" type='button' class='btn btn-primary'>Bayar</button>
                    </div>

                </div>

            </div>
        </div>
    </div>



    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="env('MIDTRANS_CLIENTKEY')"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    var id = '{{ $trans->id }}';
                    window.location.href = '{{ route('user.pembelian.invoice', $trans->id) }}';

                    console.log(result);
                },
                onPending: function(result) {
                    console.log(result);
                },
                onError: function(result) {
                    console.log(result);
                },
                onClose: function() {
                    console.log(result);
                }
            })
        });
    </script>
@endsection
