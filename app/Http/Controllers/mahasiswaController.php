<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        if(strlen($katakunci)){
            $data = mahasiswa::where('nim','like',"%$katakunci%")
                                ->orWhere('nama','like',"%$katakunci%")
                                ->orWhere('jurusan','like',"%$katakunci%")
                                ->paginate(5);
        }
        else{
            $data = mahasiswa::orderBy('nim', 'desc')->paginate(5);
        }
        
        return view('mahasiswa.index')->with('data',$data);
        // return 'hy';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Session::flash('nim',$request->nim);
        // Session::flash('nim',$request->nama);
        // Session::flash('nim',$request->jurusan);
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,tiff|max:20480',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM harus berupa angka',
            'nim.unique' => 'NIM sudah ada dalam database',
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto.mimes' => 'Format gambar yang diizinkan adalah JPEG, PNG, JPG, GIF, BMP, SVG, atau TIFF',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 20MB',
        ]);
    
        // Proses penyimpanan data
        $fotofile = $request->file('foto');
        $fotoformat = $fotofile->extension();
        $fotonama = date("ymdhis").".".$fotoformat;
        $fotofile->move(public_path('foto'),$fotonama);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'foto'=>$fotonama,
        ];
        mahasiswa::create($data);
        
        // Mengalihkan pengguna ke halaman 'mahasiswa' dengan parameter 'success'
        //return redirect()->to('mahasiswa')->with('success', 'Data berhasil disimpan');
        return redirect()->to('mahasiswa?success=Berhasil+menambahkan+data');
        // return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan');

    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswa::where('nim',$id)->first();

        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
        ],[
            'nama.required'=>'Nama wajib di isi',
            'jurusan.required'=>'Jurusan wajib di isi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);
        // $fotofile = $request->file('foto');
        // $fotoformat = $fotofile->extension();
        // $fotonama = date("ymdhis").".".$fotoformat;
        // $fotofile->move(public_path('foto'),$fotonama);
        $data = [
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
            'alamat'=>$request->alamat,                       

        ];
        if($request->hasFile('foto')){
            $request->validate([
                'foto' => 'mimes:jpeg,png,jpg,gif,bmp,svg,tiff|max:20480',
            ],[
                'foto.mimes' => 'Format gambar yang diizinkan adalah JPEG, PNG, JPG, GIF, BMP, SVG, atau TIFF',
            ]);
            $fotofile = $request->file('foto');
            $fotoformat = $fotofile->extension();
            $fotonama = date("ymdhis").".".$fotoformat;
            $fotofile->move(public_path('foto'),$fotonama);
            
            $datafoto = mahasiswa::where('nim',$id)->first();
            File::delete(public_path('foto'.'/'.$datafoto));
            $data = [
                'foto' => $fotonama
            ];
        }
        

        
        mahasiswa::where('nim',$id)->update($data);
        return redirect()->to('mahasiswa?success=berhasil+mekakuakn+update+data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= mahasiswa::where('nim',$id)->first();
        File::delete(public_path('foto').'/'.$data->foto);
        mahasiswa::where('nim',$id)->delete();
        return redirect()->to('mahasiswa?success=Data+berhasil+dihapus');
    }
}
