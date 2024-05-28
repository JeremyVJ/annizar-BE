@extends('admin.layout.main')
@section('title', 'Dashboard')
<!-- @section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12"> -->
                <!-- PAGE CONTENT BEGINS -->
                <!-- <div style="margin-top:10px" class="alert alert-block alert-info">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <i class="ace-icon fa fa-user blue"></i>
                    Selamat datang
                    <strong class="blue">{{ Auth::user()->name }}</strong>.
                </div> -->
                <!-- PAGE CONTENT ENDS -->
            <!-- </div>/.col -->
        <!-- </div> -->

 @section('vendor-style')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
<script src="{{ asset('public/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('resources/jss/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
<div class="row">
  <!-- Section for welcome message and illustration -->
  <div class="col-lg-12 mb-3">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-4">
          <div class="card-body">
            <i class="ace-icon fa fa-user blue"></i>
            Selamat Datang
            <strong class="blue">{{ Auth::user()->name }}</strong>.
          </div>
        </div>
        <div class="col-sm-8 text-right text-sm-right">
          <div class="card-body pb-0 px-5 px-md-0">
            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="150" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Section for the chart with title -->
 <div class="col-lg-12 mb-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Grafik Penjualan</h4> <!-- Add title here -->
        <div id="chart"></div>
      </div>
    </div>
  </div>

  <!-- Section for the chart -->
  <div class="col-lg-12 mb-3">
    <div class="card">
      <div class="card-body">
        <div id="chart"></div>
      </div>
    </div>
  </div>


  <!-- Section for cards with statistics -->
  <div class="col-lg-6 col-md-12">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('assets/img/icons/unicons/kategori.png') }}" alt="chart success" class="rounded" height="70px">
              </div>
            </div>
            <span class="mb-4">.</span>
            <p class="mb-0">Total Menu: {{ $total_barang }}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('assets/img/icons/unicons/product.png') }}" alt="Product" class="rounded" height="70px">
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <span>.</span>
            <p class="mb-0">Total Kategori: {{ $total_kategori }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6 col-md-12">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{ asset('assets/img/icons/unicons/pelanggan.jpg') }}" class="rounded" height="70px">
              </div>
            </div>
            <div class="md-4">.</div>
            <p class="mb-0">Total User: {{ $total_user }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
        <!-- <div class="row mt-md-2">
            <iframe title="Report Section" width="1250" height="600" src="https://app.powerbi.com/view?r=eyJrIjoiZGViNTAyNjctYjM1Zi00OGUyLWEwNmEtMmJiN2IyNWYxNzY3IiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
        </div> -->

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
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var options = {
    series: [{
      name: 'Jumlah',
      data: [1, 2, 3, 4, 5, ]
    }],
    chart: {
      height: 350,
      type: 'area'
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {
      type: 'integer',
      categories : [ 1, 2, 3, 4, 5]
    },
    tooltip: {
      x: {
        format: 'dd/MM/yy HH:mm'
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
</script>
@endsection
           
@endsection
