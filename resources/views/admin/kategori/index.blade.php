@extends('admin.layout.main') <!-- If you have a common layout, extend it here -->

@section('title', 'Kategori')
@section('content')
<div class="col-md-12">
    
    @if(empty(request('alert')))
    @elseif(request('alert') == 1)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
            kategori barang berhasil disimpan.
            <br>
        </div>
    @elseif(request('alert') == 2)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
            kategori barang berhasil diubah.
            <br>
        </div>
    @elseif(request('alert') == 3)
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <strong><i class="ace-icon fa fa-check-circle"></i> Sukses! </strong><br>
            kategori barang berhasil dihapus.
            <br>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                <a class="btn btn-shopee btn-round ml-auto" href="{{ route('admin.kategori.create') }}">
                    <i class="fa fa-plus"></i>
                    Input Data Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kategori Barang</th>
                            {{-- <th><i class="ace-icon fa fa-bookmark"></i></th> --}}
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($kategoris as $data)
                        @php
                        $jumlah = $data->barang()->count();
                        @endphp
                        <tr>
                            <td width="50" class="center">{{ $no }}</td>
                            <td width="250">{{ $data->nama_kategori }}</td>
                            {{-- <td width="80" class="center">{{ $jumlah }}</td> --}}
                            <td width="80" class="center">
                                <div class="action-buttons">
                                    <a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px"
                                        class="blue tooltip-info"
                                        href="{{ route('admin.kategori.edit', $data->id) }}">
                                        <i class="ace-icon fa fa-edit bigger-130" style="color: #ff4500"></i>
                                    </a>

                                    <a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="{{ route('admin.kategori.destroy', $data->id) }}" onclick="event.preventDefault(); if (confirm('Anda yakin ingin menghapus kategori barang {{ $data->nama_kategori }} ?')) document.getElementById('delete-form-{{ $data->id }}').submit();">
                                        <i class="ace-icon fa fa-trash bigger-130" style="color: #ff4500"></i>
                                    </a>
                                
                                    <form id="delete-form-{{ $data->id }}" action="{{ route('admin.kategori.destroy', $data->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection