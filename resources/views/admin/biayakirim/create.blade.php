@extends('admin.layout.main') {{-- Assuming you have a base layout named 'app.blade.php' --}}
@section('title','Input Biaya Pengiriman')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
               <h4>@yield('titel')</h4>
            </div><!-- /.page-header -->

            <div class="card-body">
                <div class="col-xs-12">
                    <!--PAGE CONTENT BEGINS-->
                    <form class="form-horizontal" role="form" action="{{ route('admin.biaya.store') }}" method="POST">
                        @csrf
                        <div class="form-group form-group-default">
                            <label class="col-sm-2 control-label">Provinsi</label>

                            <select class="form-control" name="provinsi_id" id="provinsiDropdown" placeholder="Pilih Provinsi"
                                required>
                                <option value=""></option>
                                @foreach ($provinsiData as $province)
                                    <option value="{{ $province->id }}">{{ $province->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group form-group-default">
                            <label class="col-sm-2 control-label">Kecamatan/Kota</label>
                            <select class="form-control" name="kab_kota_id" id="kabkotaDropdown"
                                placeholder="Pilih Kabupaten/Kota" disabled required>
                                <option value=""></option>
                                @foreach ($kabkotaData as $kabkota)
                                    <option value="{{ $kabkota->id }}">{{ $kabkota->nama_kabkota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label class="col-sm-2 control-label no-padding-right">Biaya</label>
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control" name="biaya" autocomplete="off"
                                onKeyPress="return goodchars(event,'0123456789',this)" required />
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-2 col-md-10">
                                <input style="width:100px" type="submit" class="btn btn-shopee" name="simpan"
                                    value="Simpan" />
                                &nbsp; &nbsp;
                                <a style="width:100px" href="{{ route('admin.biaya.index') }}" class="btn btn-shopee">Batal</a>
                            </div>
                        </div>
                    </form>
                    <!--PAGE CONTENT ENDS-->
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div>
    </div><!--/.page-content-->


    <!-- Add this before your script section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // JavaScript to handle the dynamic update of kabupaten/kota dropdown
        $(document).ready(function() {
            $('#provinsiDropdown').on('change', function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $('#kabkotaDropdown').prop('disabled', false); // Enable the kabkota dropdown
                    $.ajax({
                        url: '{{ route('getKabkotaByProvinsi') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            provinsi_id: provinsiId
                        },
                        success: function(data) {
                            $('#kabkotaDropdown').empty();
                            $.each(data, function(key, value) {
                                $('#kabkotaDropdown').append('<option value="' + value
                                    .id + '">' + value.nama_kabkota +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#kabkotaDropdown').prop('disabled', true); // Disable the kabkota dropdown
                    $('#kabkotaDropdown').empty(); // Clear the options when provinsi is not selected
                }
            });
        });
    </script>
@endsection
