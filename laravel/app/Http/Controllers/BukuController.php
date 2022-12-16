<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BukuMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Buku; /* import model buku */
use App\Models\Penulis; /* import model penulis */
use App\Http\Resources\BukuResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class BukuController extends Controller
{
    
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $buku=Buku::join('buku','buku.penulis','=','penulis.id')->select('penulis.id','penulis.nama','penulis.tanggal_lahir','bukus.waktu_mulai','penulis.deskripsi')->get();
        $penulis = Penulis::all();
        // render
        return new BukuResource(true, 'List Data Buku', $buku);
    }  

    public function create()
    {
        //get departemen
        $penulis = Penulis::all();
        //render view with posts
        return view('penulis.create', compact('penulis'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request ->all(), [
            'nama' => 'required',
            'tahun_terbit' => 'required|date',
            'synopsis' => 'required',
            'genre' => 'required',
            'harga' => 'required',
            'penulis' => 'penulis',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai'
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $buku = Buku::create([
            'nama_buku' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'synopsis' => $request->synopsis,
            'genre' => $request->genre,
            'harga' => $request->harga,
            'penulis' => $request->penulis,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);
        return new BukuResource(true, 'Data buku Berhasil Ditambahkan!', $buku); 

         return redirect()->route('buku.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nomor_induk_buku,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new Mailable($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('buku.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('buku.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Buku::find($id)->delete();
        return redirect()->route('buku.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_terbit' => 'required|date',
            'synopsis' => 'required',
            'genre' => 'required',
            'harga' => 'required',
            'penulis' => 'penulis',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai'
        ]);

        Buku::find($id)->update($request->all());

        return redirect()->route('buku.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $buku=Buku::join('buku','buku.penulis','=','penulis.id')->select('penulis.id','penulis.nama','penulis.tanggal_lahir','bukus.waktu_mulai','penulis.deskripsi')->find($id);
        $penulis = Penulis::all();
        return view('buku.edit',compact('buku','penulis'));
    }

    public function show($id){
        $buku = Buku::findOrfail($id);
        return new BukuResource(true, 'Data Pegawai Berhasil Ditampilkan!', $buku);
    }
}
