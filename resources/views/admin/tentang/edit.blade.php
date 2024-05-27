@extends('admin.layout.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 style="color:#585858">
                <i style="margin-right:7px" class="ace-icon fa fa-info-circle"></i>
                Tentang Kami
            </h1>
        </div><!-- /.page-header -->
        <div class="card-body">
            <form class="form-horizontal" role="form" action="{{ route('admin.tentang.update',$data->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="col-xs-12 col-sm-12 form-control" name="judul" placeholder="Judul Halaman..." autocomplete="off" value="{{ $data->judul }}" required />
                    </div>
                </div>
    
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="col-xs-12 col-sm-12" id="ckeditor" name="keterangan" required>{{ $data->keterangan }}</textarea>
                    </div>
                </div>
                                
                <div class="clearfix form-actions">
                    <div class="col-md-offset-0 col-md-12">
                        <input style="width:100px" type="submit" class="btn btn-primary" name="simpan" value="Simpan" />
                        &nbsp; &nbsp; 
                        <a style="width:100px" href="{{ route('admin.tentang.index') }}" class="btn">Batal</a>
                    </div>
                </div>
            </form>
        </div>
        <!--PAGE CONTENT BEGINS-->
        <!--PAGE CONTENT ENDS-->
    </div><!-- /.page-content -->
</div>
@endsection
