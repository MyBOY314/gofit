<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstrukturMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Instruktur; /* import model instruktur */
use App\Http\Resources\InstrukturResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class InstrukturController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        $instruktur = Instruktur::latest()->get();

        // render
        return new InstrukturResource(true, 'List Data instruktur', $instruktur);
    }  

    public function create()
    {
        //get 
        $instruktur = Instruktur::all();
        //render view with posts
        return view('instruktur.create', compact('instruktur'));
    }

    public function store(Request $request)
    {
         //Validasi Formulir
         $validator = Validator::make($request ->all(), [
            'nama_instruktur' => 'required',
            'password_instruktur' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required|numeric|digits_between:11,13|starts_with:08',
            'terlambat' => 'required|numeric'
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $instruktur = Instruktur::create([
            'nama_instruktur' => $request->nama_instruktur,
            'password_instruktur' => bcrypt($request->password_instruktur),
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'terlambat' => $request->terlambat,
        ]);
        return new InstrukturResource(true, 'Data instruktur Berhasil Ditambahkan!', $instruktur); 

         return redirect()->route('instruktur.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new Mailable($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('instruktur.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('instruktur.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Instruktur::find($id)->delete();
        return redirect()->route('instruktur.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_instruktur' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'nomor_telepon' => 'required|numeric|digits_between:11,13|starts_with:08',
            'terlambat' => 'required'
        ]);

        Instruktur::find($id)->update($request->all());

        return redirect()->route('instruktur.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $instruktur = Instruktur::findOrfail($id);
        return view('instruktur.edit',compact('instruktur'));
    }

    public function show($id){
        $instruktur = Instruktur::findOrfail($id);
        return new InstrukturResource(true, 'Data Instruktur Berhasil Ditampilkan!', $instruktur);
    }

    public function resetTerlambat(){
        $instrukturs = Instruktur::all();

        foreach($instrukturs as $instruktur){
            $instruktur->terlambat = 0;
            $instruktur->timestamps = false;
            $instruktur->save();
        }
        return response()->json(['message' => 'Instruktur terlambat RESET']);
    }

    

}

