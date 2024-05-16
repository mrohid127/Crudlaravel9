@extends('layout.layout')

{{-- @if (Session::has('succes'))
<div class="pt-3">
    <div class="alert alert-succes">
        {{Session::get('succes')}}
    </div>
</div>
@endif --}}
@section('konten')
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
              <form class="d-flex" action="{{url('mahasiswa')}}" method="get">
                  <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                  <button class="btn btn-secondary" type="submit">Cari</button>
              </form>
            </div>
            
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
              <a href='{{url('mahasiswa/create')}}' class="btn btn-primary">+ Tambah Data</a>
            </div>
      
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">NIM</th>
                        <th class="col-md-4">Nama</th>
                        <th class="col-md-2">Jurusan</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstitem() ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->nim}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->jurusan}}</td>
                        <td>
                            <a href='{{url('mahasiswa/'.$item->nim.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('yakin akan menghapus data?') " class="d-inline" action="{{url('mahasiswa/'.$item->nim)}}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                    Del
                                </button>
                            </form>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                detail
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                        <div>
                                            @if ($item->foto)
                                        <img style="max-width: 10rem; max-height:10rem" src="{{ url('foto/'.$item->foto) }}" alt="Foto">
                                        @endif
                                      <h1 class="modal-title fs-5" id="exampleModalLabel"><b>{{$item->nama}}</b></h1>

                                        </div>
                                        
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" >
                                        <div class="modal-body">
                                            <p><b>Nomor Induk</b> <span>: {{$item->nim}}</span></p>
                                            <p><b>Jurusan</b> <span>: {{$item->jurusan}}</span></p>
                                            <p><b>Alamat</b> <span>: {{$item->alamat}}</span></p>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>

                    </tr>
                    <?php $i++ ?>
                    @endforeach
                   
                </tbody>
            </table>
            {{ $data->links() }}
      </div>
      <!-- AKHIR DATA -->

    
@endsection    
