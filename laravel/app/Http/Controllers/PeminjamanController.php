<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeminjamanMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Peminjaman; /* import model Peminjaman */
use App\Models\Buku; /* import model buku */
use App\Models\Pengguna;
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
        $peminjaman = Peminjaman::latest()->get();
        // $peminjaman=Peminjaman::join('Peminjaman','Peminjaman.buku','=','buku.id')->select('buku.id','buku.nama','buku.tahun_terbit','buku.tahun_terbit','buku.synopsis'
        // ,'buku.genre','buku.harga','buku.penulis','buku.created_at','buku.updated_at')->get();
        // $buku = Buku::all();

        // render
        return new PeminjamanResource(true, 'List Data Peminjaman', $peminjaman);
    }  

    public function create()
    {
        //get 
        $buku = Buku::all();
        $pengguna = Pengguna::all();
        //render view with posts
        return view('peminjaman.create', compact('buku'), compact('pengguna'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request ->all(), [
            'tanggal_peminjaman' => 'required|date',
            'durasi_peminjaman' => 'required',
            'buku' => 'required',
            'pengguna' => 'required',
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $peminjaman = Peminjaman::create([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'durasi_peminjaman' => $request->durasi_peminjaman,
            'buku' => $request->buku,
            'pengguna' => $request->pengguna,
        ]);
        return new PeminjamanResource(true, 'Data Peminjaman Berhasil Ditambahkan!', $peminjaman); 

         return redirect()->route('Peminjaman.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->pengguna,
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
            'tanggal_peminjaman' => 'required|date',
            'durasi_peminjaman' => 'required',
            'buku' => 'required',
            'pengguna' => 'required',
        ]);

        Peminjaman::find($id)->update($request->all());

        return redirect()->route('Peminjaman.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $peminjaman=Peminjaman::join('Peminjaman','Peminjaman.buku','=','buku.id')->select('buku.id','buku.nama','buku.tahun_terbit','buku.tahun_terbit','buku.synopsis'
        ,'buku.genre','buku.harga','buku.penulis','buku.created_at','buku.updated_at')->get();
        $buku = Buku::all();
        return view('Peminjaman.edit',compact('peminjaman','buku'));
    }

    public function show($id){
        $peminjaman = Peminjaman::findOrfail($id);
        return new PeminjamanResource(true, 'Data Pegawai Berhasil Ditampilkan!', $peminjaman);
    }
}
