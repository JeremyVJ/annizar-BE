@extends('admin.layout.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 style="color:#585858">
            <i class="ace-icon fa fa-edit"></i>
            Input Kategori Barang
        </h1>
    </div><!-- /.page-header -->

    <div class="card-body">
            <form class="form-horizontal" role="form" action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="form-group form-group-default">
                    <label>Nama Kategori</label>
                        <input type="text" class="col-xs-12 col-sm-5 form-control" name="nama_kategori" autocomplete="off" required />
                </div>
                
                <div class="clearfix form-actions">
                    <div class="col-md-offset-2 col-md-10">
                        <input style="width:100px" type="submit" class="btn btn-shopee" name="simpan" value="Simpan" />
                        &nbsp; &nbsp; 
                        <a style="width:100px" href="{{ route('admin.kategori.index') }}" class="btn btn-shopee">Batal</a>
                    </div>
                </div>
            </form>
    </div><!--/.row-fluid-->
</div><!--/.page-content-->
@endsection
