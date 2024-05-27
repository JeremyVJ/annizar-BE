@extends('layout.main') {{-- Assuming you have a base layout named 'app.blade.php' --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.min.css') }}">
@endsection
@section('content')
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            <i style="margin-right:6px" class="fa fa-shopping-cart"></i>
                            Kontak
                        </h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Kontak</li>
                        </ol>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div style="padding: 0 10px;text-align:justify">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.9506027833045!2d106.79847409999999!3d-6.4003668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e9bcb506f949%3A0xc3939bd45bc93e52!2sDapur%20mama%20inong!5e0!3m2!1sen!2suk!4v1692342502658!5m2!1sen!2suk"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                            <!-- WhatsApp Buttons -->
                            <div class="row">
                                <table width="100%" class="table table-bordered" style="border-collapse: collapse;">
                                    <tr>
                                        <td style="width: 50%; padding: 10px; " class="text-center">
                                            <a class="btn btn-primary btn-block" style="margin: 0; padding: 10px;">
                                                <i class="fa fa-home"></i> Alamat
                                            </a>
                                            Perumahan Hasanah Village Blok E-11 Pancoran Mas, <br> Kota Depok, Jawa Barat
                                            16433, Indonesia.
                                        </td>
                                        <td style="width: 50%; padding: 10px; " class="text-center">
                                            <a class="btn btn-primary btn-block" style="margin: 0; padding: 10px;">
                                                <i class="flaticon-whatsapp"></i> WhatsApp
                                            </a>
                                            <br>
                                            <a href="https://wa.me/6282298643969">+62 822 9864 3969</a>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width: 50%; padding: 10px; " class="text-center">
                                            <a class="btn btn-primary btn-block" style="margin: 0; padding: 10px;">
                                                <i class="flaticon-instagram"></i> Instagram</a>
                                            </a>
                                            dapurmamainong_
                                        </td>
                                        <td style="width: 50%; padding: 10px; " class="text-center">
                                            <a class="btn btn-primary btn-block" style="margin: 0; padding: 10px;">
                                                <i class="flaticon-clock-1"></i> Jam Operasional</a>
                                            </a>
                                            Jam operasional : Pukul 06.00 - 20.00 WIB
                                        </td>
                                    </tr>
                                </table>
                                <div class="col-12">
                                    <h2><b>Feedback</b></h2>
                                    <form action="{{ route('feedback') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-sm-12 col-md-6">
                                                <input type="text" name="nama" class="form-control" placeholder="Nama"
                                                    id="">
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6">
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="Email" id="">
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="text" name="subjek" class="form-control" placeholder="Subjek"
                                                id="">
                                        </div>
                                        <textarea placeholder="Pesan" name="pesan" class="form-control" cols="30" rows="10"></textarea>
                                        <div class="text-center" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
