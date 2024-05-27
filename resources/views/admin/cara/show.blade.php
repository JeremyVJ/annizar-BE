@extends('admin.layout.main')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 style="color:#585858">
                    <i style="margin-right:7px" class="ace-icon fa fa-info-circle"></i>
                    Cara Pemesanan
                </h1>
            </div><!-- /.page-header -->
            <div class="card-body">
                <div style="background:#fff;text-align:justify" class="well">
                    <h4 class="blue lighter">{{ $data->judul }}</h4>
                    {!! $data->keterangan !!}
                </div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-0 col-md-12">
                        <a style="width:100px" class="btn btn-primary" href="{{ route('admin.cara.edit', $data->id) }}">
                            Ubah
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
@endsection
