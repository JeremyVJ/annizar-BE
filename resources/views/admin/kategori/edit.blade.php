@extends('admin.layout.main')
@section('title','Ubah Kategori Barang')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 style="color:#585858">
                <i class="ace-icon fa fa-edit"></i>
                @yield('title')
            </h1>
        </div><!-- /.page-header -->
    
        <div class="card-body">
                <form class="form-horizontal" role="form" action="{{ route('admin.kategori.update', $data['id']) }}" method="POST">
                    @csrf
    
                    <input type="hidden" name="_method" value="PUT">
    
                    <div class="form-group form-group-default">
                        <label>Nama Kategori</label>
                            <input type="text" class="col-xs-12 col-sm-5 form-control" name="nama_kategori" autocomplete="off" value="{{ $data['nama_kategori'] }}" required />
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
</div>
@endsection
