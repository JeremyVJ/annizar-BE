@extends('admin.layout.main') <!-- If you have a common layout, extend it here -->

@section('title', 'Biaya Kirim')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                <a class="btn btn-shopee btn-round ml-auto" href="{{ route('admin.biaya.create') }}">
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
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Biaya Pengiriman</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($biayaKirim as $data)
                            <tr>
                                <td width="50" class="center">{{ $no }}</td>
                                <td width="200">{{ $data['nama_provinsi'] }}</td>
                                <td width="200">{{ $data['nama_kabkota'] }}</td>
                                <td width="100" align="right">{{ 'Rp ' . number_format($data['biaya'], 0, ',', '.') }}</td>

                                <td width="80" class="center">
                                    <div class="action-buttons">
                                        <a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" href="{{ route( 'admin.biaya.edit',$data['biaya_id']) }}">
                                            <i class="ace-icon fa fa-edit bigger-130" style="color: #ff4500"></i>
                                        </a>

                                        <a data-rel="tooltip" data-placement="top" title="Hapus" class="red tooltip-error" href="{{ route('admin.biaya.destroy', $data->biaya_id) }}" onclick="event.preventDefault(); if (confirm('Anda yakin ingin menghapus kategori barang {{ $data->nama_kategori }} ?')) document.getElementById('delete-form-{{ $data->id }}').submit();">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('admin.biaya.destroy', $data->biaya_id) }}" method="POST" style="display: none;">
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

