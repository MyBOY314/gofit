@extends('dashboard') @section('content') <div class="content-header">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" /> -->

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pegawai</h1>
            </div> <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"> <a href="#">Pegawai</a> </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data"> @csrf

                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weightbold">NIP</label>
                                    <input type="text" class="form-control @error('nomor_induk_pegawai') is-invalid @enderror" name="nomor_induk_pegawai" value="{{ old('nomor_induk_pegawai',$pegawai->nomor_induk_pegawai) }}" placeholder="Masukkan Nomor Induk Pegawai">
                                    @error('nomor_induk_pegawai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weightbold">Nama Pegawai</label>
                                    <input type="text" pattern="[a-zA-Z]{1,15}"
                                     class="form-control @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai',$pegawai->nama_pegawai) }}" placeholder="Masukkan Nama Pegawai">
                                    @error('nama_pegawai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weightbold">Departemen</label>
                                    <select class="form-control @error('id_departemen') is-invalid @enderror" name="id_departemen" value="{{ old('id_departemen',$pegawai->id_departemen) }}">
                                        @foreach ($departemen as $item)
                                        <option value="" disabled selected style="display: none;">{{old('nama_departemen', $item->nama_departemen)}}</option>
                                        <option value="{{old('nama_departemen', $item->id)}}">{{old('nama_departemen', $item->nama_departemen)}}</option>
                                        @endforeach
                                    </select>

                                    @error('id_departemen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Telepon</label>
                                    <input type="tel" pattern="[0][8][0-9]{4,5}"
                                    class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ old('telepon',$pegawai->telepon) }}" placeholder="Masukkan Nomor Telepon">
                                    @error('telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Email</label>
                                    <input  type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$pegawai->email) }}" placeholder="Masukkan Email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" 
                                    value="{{ old('gender',$pegawai->gender )}}">
                                        <option value="1">Pria</option>
                                        <option value="0">Wanita</option>
                                        <option value="" disabled selected style="display: none;">{{ old('gender',$pegawai->gender==0 ? "Wanita" : "Pria" )}}</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status" required focus>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                        <option value="" disabled selected style="display: none;">{{ old('status',$pegawai->status==0 ? "Tidak Aktif" : "Aktif" )}}</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

                        </form>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" 
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" 
crossorigin="anonymous" referrerpolicy="no-referrer">
</script> -->
@endsection