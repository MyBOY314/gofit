<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenulisMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Penulis; /* import model Penulis */
use App\Http\Resources\PenulisResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class PenulisController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        $penulis = Penulis::latest()->get();

        // render
        return new PenulisResource(true, 'List Data Penulis', $penulis);
    }  

    public function create()
    {
        //get 
        $penulis = Penulis::all();
        //render view with posts
        return view('penulis.create', compact('penulis'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request ->all(), [
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'deskripsi' => 'required',
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $penulis = Penulis::create([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'deskripsi' => $request->deskripsi,
        ]);
        return new PenulisResource(true, 'Data Penulis Berhasil Ditambahkan!', $penulis); 

         return redirect()->route('penulis.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new Mailable($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('penulis.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('penulis.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Penulis::find($id)->delete();
        return redirect()->route('penulis.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'email' => 'required',
            'telepon' => 'required',
        ]);

        Penulis::find($id)->update($request->all());

        return redirect()->route('penulis.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $penulis = Penulis::findOrfail($id);
        return view('penulis.edit',compact('penulis'));
    }

    public function show($id){
        $penulis = Penulis::findOrfail($id);
        return new PenulisResource(true, 'Data Pegawai Berhasil Ditampilkan!', $penulis);
    }
}

