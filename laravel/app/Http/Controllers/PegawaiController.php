<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\PegawaiMail; /* import model mail */
use App\Models\Departemen;
use App\Models\Pegawai;
use Illuminate\Http\Request;

use App\Http\Resources\PegawaiResource;
use Illuminate\Support\Facades\Validator;


class PegawaiController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $pegawai = Pegawai::latest()->get();
        // $pegawai=Pegawai::join('departemens','pegawais.id_departemen','=','pegawais.id')->select('pegawais.nomor_induk_pegawai','pegawais.id','pegawais.nama_pegawai','departemens.nama_departemen','pegawais.email','pegawais.telepon','pegawais.gender','pegawais.status')->get();
        // $departemen =  Departemen::all();
        //render
        return new PegawaiResource(true, 'List Data Pegawai', $pegawai);
    }

    public function create() 
{ 
    $departemen =  Departemen::all();
    return view('pegawai.create',compact('departemen')); 
} 

    public function store(Request $request) { 
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'nomor_induk_pegawai' => 'required', 
            'nama_pegawai' => 'required', 
            'id_departemen' => 'required',
            'email' => 'required|email|max:255|regex:/(.*)@email.com/i|unique:users',
            'telepon' => 'required',
            'gender' => 'required',
            'status' => 'required'
        ]); 
        if ($validator->fails()) {             
            return response()->json($validator->errors(), 422);        
         } 
        //Fungsi Simpan Data ke dalam Database
        $pegawai = Pegawai  ::create([ 
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai, 
            'nama_pegawai' => $request->nama_pegawai, 
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'status' => $request->status
         ]); 
         
         return new PegawaiResource(true, 'Data Pegawai Berhasil Ditambahkan!', $pegawai); 

         return redirect()->route('pegawai.index')
                          ->with('success','Item deleted successfully'); 
        }

        public function destroy($id)
        {
            Pegawai::find($id)->delete();
            return redirect()->route('pegawai.index')
                            ->with('success','Item deleted successfully');                   
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'nomor_induk_pegawai' => 'required', 
                'nama_pegawai' => 'required', 
                'id_departemen' => 'required',
                'email' => 'required|email|max:255|regex:/(.*)@email.com/i|unique:users',
                'telepon' => 'required',
                'gender' => 'required',
                'status' => 'required'
            ]);
        
            Pegawai::find($id)->update($request->all());
        
            return redirect()->route('pegawai.index')
                            ->with('success','Item updated successfully');
        
                            $pegawai = Pegawai::create($request);
        
                            if ($pegawai) {
                                return back()->with('success', 'Success! User created');
                            }
                            else {
                                return back()->with('failed', 'Failed! User not created');
                            }
        }
        public function edit($id)
        {
            $pegawai=Pegawai::join('departemens','pegawais.id_departemen','=','pegawais.id')->find($id);
            $departemen =  Departemen::all();
            return view('pegawai.edit',compact('pegawai','departemen'));
        }

        public function show($id){
            $pegawai = Pegawai::findOrfail($id);
            return new PegawaiResource(true, 'Data Pegawai Berhasil Ditampilkan!', $pegawai);
        }

}

