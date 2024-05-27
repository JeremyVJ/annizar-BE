@extends('admin.layout.main')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 style="color:#585858">
                    <i class="ace-icon fa fa-edit"></i>
                    Input Barang
                </h1>
            </div><!-- /.page-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <!--PAGE CONTENT BEGINS-->
                        <form class="form-horizontal" role="form" action="{{ route('admin.barang.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-md-8 pe-1">

                                    <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text"
                                                class="col-xs-12 col-sm-12 form-control @error('nama_barang') is-valid @enderror"
                                                name="nama_barang" placeholder="Nama Barang.." autocomplete="off"
                                                required />
                                            @error('nama_barang')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    

                                </div>

                                <div class="col-xs-12 col-md-4">

                                    <div class="form-group">
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Tanggal Masuk</label>
                                        <div class="input-group">
                                            <input class="form-control date-picker" type="text"
                                                data-date-format="dd-mm-yyyy" name="tanggal_masuk"
                                                value="{{ date('d-m-Y') }}" required />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar bigger-110"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <br>

                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Kategori</label>
                                        <div>
                                            <select class="chosen-select form-control @error('kategori') is-valid @enderror"
                                                name="kategori" data-placeholder="Pilih Kategori..." required>
                                                <option value=""></option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr>

                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Harga</label>

                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="text" class="form-control @error('harga') is-valid @enderror"
                                                name="harga" autocomplete="off"
                                                onKeyPress="return goodchars(event,'0123456789',this)" required />
                                            @error('harga')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <br>

                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Stok</label>

                                        <div>
                                            <input type="text" class="form-control" name="stok" autocomplete="off"
                                                onKeyPress="return goodchars(event,'0123456789',this)" required />
                                        </div>
                                    </div>

                                    <hr>

                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Gambar</label>

                                        <div>
                                            <input type="file" class="form-control" id="id-input-file-2 @error('gambar') is-valid @enderror"
                                                name="gambar" required />
                                            @error('gambar')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-0 col-md-12">
                                    <input style="width:100px" type="submit" class="btn btn-shopee" name="simpan"
                                        value="Simpan" />
                                    &nbsp; &nbsp;
                                    <a style="width:100px;" href="{{ route('admin.barang.index') }}" class="btn btn-shopee">Batal</a>
                                </div>
                            </div>

                        </form>
                        <!--PAGE CONTENT ENDS-->
                    </div><!--/.span-->
                </div><!--/.row-fluid-->
            </div>
        </div><!--/.page-content-->
    </div>
@endsection


