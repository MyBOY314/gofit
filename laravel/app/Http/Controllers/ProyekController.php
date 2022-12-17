<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\ProyekMail;
use App\Models\Departemen;
use App\Models\Proyek;
use Illuminate\Http\Request;

use App\Http\Resources\ProyekResource;
use Illuminate\Support\Facades\Validator;

class ProyekController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $proyek=Proyek::join('departemens','proyeks.id_departemen','=','departemens.id')->select('proyeks.id','proyeks.nama_proyek','departemens.nama_departemen','proyeks.waktu_mulai','proyeks.waktu_selesai','proyeks.status')->get();
        $departemen = Departemen::all();
        //render
        return new ProyekResource(true, 'List Data Proyek', $proyek);
    }  

    public function create()
    {
        //get departemen
        $departemen = Departemen::all();
        //render view with posts
        return view('proyek.create', compact('departemen'));
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request ->all(), [
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'status' => 'required'
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $proyek = Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'id_departemen' => $request->id_departemen,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status
        ]);
        return new ProyekResource(true, 'Data Proyek Berhasil Ditambahkan!', $proyek); 

         return redirect()->route('proyek.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nomor_induk_proyek,
            ];
            // Mail::to('davehabelpaprindey@gmail.com')->send(new proyekMail($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('proyek.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('proyek.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Proyek::find($id)->delete();
        return redirect()->route('proyek.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'status' => 'required'
        ]);

        Proyek::find($id)->update($request->all());

        return redirect()->route('proyek.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $proyek=Proyek::join('departemens','proyeks.id_departemen','=','departemens.id')->select('proyeks.id','proyeks.nama_proyek','departemens.nama_departemen','proyeks.waktu_mulai','proyeks.waktu_selesai','proyeks.status')->find($id);
        $departemen = Departemen::all();
        return view('proyek.edit',compact('proyek','departemen'));
    }

    public function show($id){
        $proyek = Proyek::findOrfail($id);
        return new ProyekResource(true, 'Data Pegawai Berhasil Ditampilkan!', $proyek);
    }
}