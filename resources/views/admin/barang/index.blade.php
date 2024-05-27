@extends('admin.layout.main') <!-- If you have a common layout, extend it here -->

@section('title', 'Product')
@section('content')
    <div class="col-md-12">
         <!-- Form untuk pencarian -->
         <form action="{{ route('admin.barang.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="nama_barang" class="form-control" placeholder="Search"
                    value="{{ request('nama_barang') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-shopee">Cari</button>
                </div>
            </div>
        </form>

        @if (!empty(request('alert')))
            @if (request('alert') == 1)
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
                    data barang baru berhasil disimpan.
                    <br>
                </div>
            @elseif (request('alert') == 2)
                <div class="alert alert-success">
                    <!-- Rest of the alert messages -->
                </div>
            @elseif (request('alert') == 3)
                <div class="alert alert-success">
                    <!-- Rest of the alert messages -->
                </div>
            @elseif (request('alert') == 4)
                <div class="alert alert-danger">
                    <!-- Rest of the alert messages -->
                </div>
            @elseif (request('alert') == 5)
                <div class="alert alert-danger">
                    <!-- Rest of the alert messages -->
                </div>
            @elseif (request('alert') == 6)
                <div class="alert alert-danger">
                    <!-- Rest of the alert messages -->
                </div>
            @endif
        @endif
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">@yield('title')</h4>
                    <a class="btn btn-shopee btn-round ml-auto" href="{{ route('admin.barang.create') }}">
                        <i class="fa fa-plus"></i>
                        Input Data Baru
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th class="hidden-480">Gambar</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="hidden-480">Tanggal Masuk</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($barangList as $barang)
                                <tr>
                                    <td width="30" class="center">{{ $loop->iteration }}</td>
                                    <td width="70" class="hidden-480 center">
                                        <img style="padding: 1px" class="profile-picture"
                                            src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang"
                                            width="120">
                                    </td>
                                    <td width="200">
                                        <p> {{ $barang->nama_barang }} </p>
                                    </td> 
                                    <td width="80" align="right">
                                        {{ 'Rp ' . number_format($barang['harga'], 0, ',', '.') }}</td>
                                    <td width="80" align="right">{{ $barang->stok }}</td>
                                    <td width="100" class="hidden-480 center">{{ $barang->tanggal_masuk }}</td>

                                    <td width="60" class="center">
                                        <div class="action-buttons">
                                            <a data-rel="tooltip" data-placement="top" title="Ubah"
                                                style="margin-right: 5px" class="blue tooltip-info"
                                                href="{{ route('admin.barang.edit', $barang->id) }}">
                                                <i class="ace-icon fa fa-edit bigger-130" style="color: #ff4500"></i>
                                            </a>

                                            <a data-rel="tooltip" data-placement="top" title="Hapus"
                                                class="red tooltip-error"
                                                href="{{ route('admin.barang.destroy', $barang->id) }}"
                                                onclick="event.preventDefault(); if (confirm('Anda yakin ingin menghapus barang {{ $barang->nama_barang }} ?')) document.getElementById('delete-form-{{ $barang->id }}').submit();">
                                                <i class="ace-icon fa fa-trash bigger-130" style="color: #ff4500"></i>
                                            </a>

                                            <form id="delete-form-{{ $barang->id }}"
                                                action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $barangList->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
        });
    </script> --}}
@endsection
