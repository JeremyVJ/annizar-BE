@extends('admin.layout.main')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 style="color:#585858">
                    <i class="ace-icon fa fa-edit"></i>
                    Edit Barang
                </h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal" role="form" action="{{ route('admin.barang.update', $barang->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div style="padding-right: 40px" class="col-xs-12 col-md-8">
                                    <!-- Nama Barang -->
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text"
                                            class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                            name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                                            required>
                                        @error('nama_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Deskripsi -->
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Tanggal Masuk</label>
                                        <div class="input-group">
                                            <input type="date"
                                                class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                                id="tanggal_masuk" name="tanggal_masuk"
                                                required>
                                            @error('tanggal_masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Kategori</label>
                                        <div>
                                            <select class="form-control @error('kategori') is-invalid @enderror"
                                                id="kategori" name="kategori" required>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ old('kategori', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Harga</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                id="harga" name="harga" value="{{ old('harga', $barang->harga) }}"
                                                required>
                                            @error('harga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Stok</label>
                                        <div>
                                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                                id="stok" name="stok" value="{{ old('stok', $barang->stok) }}"
                                                required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <label style="color:#478fca;font-size:14px;font-weight:bold">Gambar</label>
                                        <div>
                                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                                id="gambar" name="gambar">
                                            @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <img src="{{ asset('storage/' . $barang->gambar) }}" width="120">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-0 col-md-12">
                                        <button type="submit" class="btn btn-shopee">Update</button>
                                        &nbsp; &nbsp;
                                        <a style="width:100px" href="{{ route('admin.barang.index') }}"
                                            class="btn btn-shopee">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
