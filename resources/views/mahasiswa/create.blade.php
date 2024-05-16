@extends('layout.layout')
@section('konten')

<!-- START FORM -->
<form action='{{url('mahasiswa')}}' method='post' enctype="multipart/form-data">
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url("mahasiswa")}}" class="btn btn-secondary mb-3">
            kembali
        </a>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nim' 
                {{-- value="{{Session::get(nim)}}" --}}
                 id="nim">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' 
                {{-- value="{{Session::get(nama)}}" --}}
                  id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jurusan' 
                {{-- value="{{Session::get(jurusan)}}" --}}
                  id="jurusan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" 
                {{-- value="{{Session::get(jurusan)}}" --}}
                  id="alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">foto</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="foto" id="foto">
            </div>
            
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
    <!-- AKHIR FORM -->
@endsection   