<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeminjamanMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Peminjaman; /* import model Peminjaman */
use App\Models\Penulis; /* import model penulis */
use App\Http\Resources\PeminjamanResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class PeminjamanController extends Controller
{
    
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $peminjaman=Peminjaman::join('Peminjaman','Peminjaman.buku','=','buku.id')->select('buku.id','penulis.nama','penulis.tanggal_lahir','Peminjamans.waktu_mulai','penulis.deskripsi')->get();
        $penulis = Penulis::all();
        // render
        return new PeminjamanResource(true, 'List Data Peminjaman', $peminjaman);
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
        $peminjaman = Peminjaman::create([
            'nama_Peminjaman' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'synopsis' => $request->synopsis,
            'genre' => $request->genre,
            'harga' => $request->harga,
            'penulis' => $request->penulis,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);
        return new PeminjamanResource(true, 'Data Peminjaman Berhasil Ditambahkan!', $peminjaman); 

         return redirect()->route('Peminjaman.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nomor_induk_Peminjaman,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new Mailable($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('Peminjaman.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('Peminjaman.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Peminjaman::find($id)->delete();
        return redirect()->route('Peminjaman.index')
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

        Peminjaman::find($id)->update($request->all());

        return redirect()->route('Peminjaman.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $peminjaman=Peminjaman::join('Peminjaman','Peminjaman.penulis','=','penulis.id')->select('penulis.id','penulis.nama','penulis.tanggal_lahir','Peminjamans.waktu_mulai','penulis.deskripsi')->find($id);
        $penulis = Penulis::all();
        return view('Peminjaman.edit',compact('Peminjaman','penulis'));
    }

    public function show($id){
        $peminjaman = Peminjaman::findOrfail($id);
        return new PeminjamanResource(true, 'Data Pegawai Berhasil Ditampilkan!', $peminjaman);
    }
}
