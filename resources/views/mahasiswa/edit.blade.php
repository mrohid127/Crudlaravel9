@extends('layout.layout')
@section('konten')

<!-- START FORM -->
<form action='{{url('mahasiswa/'.$data->nim)}}' method='post' enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url("mahasiswa")}}" class="btn btn-secondary mb-3">
        kembali
        </a>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nim' 
                value="{{$data->nim}}"
                 id="nim" disabled>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' 
                value="{{$data->nama}}"
                  id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jurusan' 
                value="{{$data->jurusan}}"
                  id="jurusan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='alamat' 
                value="{{$data->alamat}}"
                  id="alamat">
            </div>
        </div>
        <div>
            @if ($data->foto)
                <img style="max-width: 8rem; max-height:8rem" src="{{ url('foto/'.$data->foto) }}" alt="Foto">
            @endif
        </div>
        <br>
        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">foto</label>
            <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto" id="foto">
            </div>
        </div>
        <!-- Button trigger modal -->
     <div class="col-sm-10">
        <label for="jurusan" class="col-sm-2 col-form-label"></label>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Simpan
         </button>
    </div>      
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Yakin akan mengubah data?
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          pastikan data yang anda masukkan sudah benar
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button  type="submit" class="btn btn-primary" name="submit">Saya yakin</button>
        </div>
      </div>
    </div>
  {{-- </div>
  
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div  class="col-sm-10"><button  type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div> --}}
</form>

    <!-- AKHIR FORM -->
@endsection   