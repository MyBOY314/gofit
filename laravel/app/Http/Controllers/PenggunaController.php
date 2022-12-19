<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenggunaMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Pengguna; /* import model Pengguna */
use App\Http\Resources\PenggunaResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class PenggunaController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        $pengguna = Pengguna::latest()->get();

        // render
        return new PenggunaResource(true, 'List Data Pengguna', $pengguna);
    }  

    public function create()
    {
        //get 
        $pengguna = Pengguna::all();
        //render view with posts
        return view('pengguna.create', compact('pengguna'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request ->all(), [
            'nama' => 'required',
            'password' => 'required',
            'email' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);
        return new PenggunaResource(true, 'Data Pengguna Berhasil Ditambahkan!', $pengguna); 

         return redirect()->route('pengguna.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new PenggunaMail($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('pengguna.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('pengguna.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Pengguna::find($id)->delete();
        return redirect()->route('pengguna.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
        ]);

        Pengguna::find($id)->update($request->all());

        return redirect()->route('pengguna.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $pengguna = Pengguna::findOrfail($id);
        return view('pengguna.edit',compact('pengguna'));
    }

    public function show($id){
        $pengguna = Pengguna::findOrfail($id);
        return new PenggunaResource(true, 'Data Pegawai Berhasil Ditampilkan!', $pengguna);
    }
}

