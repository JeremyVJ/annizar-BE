@extends('layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            <i style="margin-right:6px" class="fa fa-user"></i>
                            Ubah Profile
                        </h3>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!-- tampilan form hubungi kami -->
                                <form class="form-horizontal" method="POST" id="profile">
                                    @csrf

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('name')
                                                is-valid
                                            @enderror"
                                                name="name" autocomplete="off" value="{{ Auth::user()->name }}" disabled>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea
                                                class="form-control @error('alamat')
                                                is-valid
                                            @enderror"
                                                name="alamat" rows="3" disabled required>{{ $data->alamat }}</textarea>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rest of the form fields -->
                                    <!-- ... (other form groups) ... -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Provinsi</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="provinsi" id=""
                                                placeholder="Pilih Provinsi" disabled>
                                                <option value="{{ $data->provinsi }}">{{ $data->province->nama_provinsi }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kabupaten/Kota</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="kabkota" id=""
                                                placeholder="Pilih Kabupaten/Kota" disabled>
                                                <option value="{{ $data->kota }}">{{ $data->kabkota->nama_kabkota }}
                                            </select>
                                        </div>
                                    </div>

                                    <!-- ... (rest of the form) ... -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kode Pos</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('kode_pos')
                                                is-valid
                                            @enderror"
                                                name="kode_pos" autocomplete="off" maxlength="5"
                                                onKeyPress="return goodchars(event,'0123456789',this)" disabled
                                                value="{{ $data->kode_pos }}">
                                            @error('kode_pos')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">No. Telepon</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('no_telepon')

                                            @enderror"
                                                name="no_telepon" autocomplete="off" value="{{ $data->telepon }}"
                                                maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)"
                                                disabled>
                                            @error('no_telepon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-5">
                                            <input type="email"
                                                class="form-control @error('email')
                                                is-valid
                                            @enderror"
                                                name="email" autocomplete="off" value="{{ Auth::user()->email }}"
                                                disabled>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('username')
                                                is-valid
                                            @enderror"
                                                name="username" autocomplete="off" value="{{ Auth::user()->username }}"
                                                disabled>
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('username')
                                                is-valid
                                            @enderror"
                                                name="password" autocomplete="off" disabled>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a style="width:150px" href="#" class="btn btn-primary btn-lg btn-edit"
                                                name="daftar">Edit</a>
                                        </div>
                                    </div>

                                </form>

                                <form class="form-horizontal"
                                    action="{{ route('user.dashboard.update', Auth::user()->id) }}" method="POST"
                                    id="edit" style="display: none;">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nama</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('name')
                                                is-valid
                                            @enderror"
                                                name="name" autocomplete="off" value="{{ Auth::user()->name }}"
                                                required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Alamat</label>
                                        <div class="col-sm-5">
                                            <textarea
                                                class="form-control @error('alamat')
                                                is-valid
                                            @enderror"
                                                name="alamat" rows="3" required>{{ $data->alamat }}</textarea>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rest of the form fields -->
                                    <!-- ... (other form groups) ... -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Provinsi</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="provinsi" id="provinsiDropdown"
                                                placeholder="Pilih Provinsi" required>
                                                <option value="{{ $data->provinsi }}">
                                                    {{ $data->province->nama_provinsi }}</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->nama_provinsi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kabupaten/Kota</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="kabkota" id="kabkotaDropdown"
                                                placeholder="Pilih Kabupaten/Kota">
                                                <option value="{{ $data->kota }}">{{ $data->kabkota->nama_kabkota }}
                                                </option>
                                                @foreach ($kabkotas as $kabkota)
                                                    <option value="{{ $kabkota->id }}">{{ $kabkota->nama_kabkota }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- ... (rest of the form) ... -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Kode Pos</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('kode_pos')
                                                is-valid
                                            @enderror"
                                                name="kode_pos" autocomplete="off" maxlength="5"
                                                onKeyPress="return goodchars(event,'0123456789',this)" required
                                                value="{{ $data->kode_pos }}">
                                            @error('kode_pos')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">No. Telepon</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('no_telepon')

                                            @enderror"
                                                name="no_telepon" autocomplete="off" value="{{ $data->telepon }}"
                                                maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)"
                                                required>
                                            @error('no_telepon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-5">
                                            <input type="email"
                                                class="form-control @error('email')
                                                is-valid
                                            @enderror"
                                                name="email" autocomplete="off" value="{{ Auth::user()->email }}"
                                                required>
                                            @error('alamat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('username')
                                                is-valid
                                            @enderror"
                                                name="username" autocomplete="off" value="{{ Auth::user()->username }}"
                                                required>
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="text"
                                                class="form-control @error('username')
                                                is-valid
                                            @enderror"
                                                name="password" autocomplete="off">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a style="width:150px" href="#"
                                                class="btn btn-default btn-lg btn-cancel" name="daftar">Cancel</a>
                                            <button style="width:150px" type="submit"
                                                class="btn btn-primary btn-lg btn-submit" name="daftar">Simpan </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add this before your script section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Semua elemen form edit diawali dengan form ID "edit"
            var formEdit = $("#edit");

            // Tombol Edit diklik
            $(".btn-edit").click(function(e) {
                e.preventDefault();
                // Sembunyikan form profil
                $("#profile").hide();
                // Tampilkan form edit
                formEdit.show();
            });

            // Tombol Cancel pada form edit diklik
            $(".btn-cancel").click(function(e) {
                e.preventDefault();
                // Tampilkan kembali form profil
                $("#profile").show();
                // Sembunyikan form edit
                formEdit.hide();
            });
        });
    </script>

    <script>
        // JavaScript to handle the dynamic update of kabupaten/kota dropdown
        $(document).ready(function() {
            $('#provinsiDropdown').on('change', function() {
                console.log('Dropdown change event triggered');
                var provinsiId = $(this).val();
                console.log(provinsiId);
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
