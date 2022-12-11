@extends('dashboard')
@section('content')

<div class="d-flex justify-content-between mt-5 mb-5">
    <div>
        <h2>Edit Proyek</h2>
    </div>
    <div>
        <a class="btn btn-secondary" href="{{ route('proyek.index') }}"> Back</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('proyek.update',$proyek->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Nama Proyek</label>
                                    <input type="text" class="form-control @error('nama_proyek') is-invalid @enderror" name="nama_proyek" value="{{ old('nama_proyek',$proyek->nama_proyek) }}" placeholder="Masukkan Nama Proyek">
                                    @error('nama_proyek')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">    
                                    <label class="font-weightbold">Departemen</label>
                                        <select class="form-control @error('id_departemen') is-invalid @enderror" name="id_departemen" value="{{ old('id_departemen') }}">
                                            <option disabled selected style="display:none;" value="{{ old('id_departemen',$proyek->id_departemen) }}">{{ old('nama_departemen',$proyek->nama_departemen) }}</option>
                                                <optgroup label="Departemen Yang Tersedia">     
                                                    @foreach ($departemen as $item)        
                                                    <option value="{{ old('id_departemen',$item->id) }}">{{ old('nama_departemen',$item->nama_departemen) }}</option>
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
                                <div class="form-group col-md-4">
                                    <label class="font-weightbold">Waktu Mulai</label>
                                    <input type="date" class="form-control datetimepicker" name="waktu_mulai" value="{{ old('waktu_mulai',$proyek->waktu_mulai) }}">
                                    @error('waktu_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weightbold">Waktu Selesai</label>
                                    <input type="date" class="form-control datetimepicker" name="waktu_selesai" value="{{ old('waktu_selesai',$proyek->waktu_selesai) }}">
                                    @error('waktu_mulai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">    
                                    <label class="font-weightbold">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option disabled selected style="display:none;">{{$proyek->status==0 ? "Selesai" : "Berjalan" }}</option>
                                            <option value=1>Berjalan</option>
                                            <option value=0>Selesai</option>
                                    </select>      
                                        @error('status')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                        @enderror 
                                </div>
                            </div>                  
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-5 text-center">
                                <button type="submit" class="btn btn-md btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    </div>

</form>
@endsection