<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\jadwalHarianMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\JadwalHarian; /* import model jadwalHarian */
use App\Models\JadwalUmum;
use App\Models\Instruktur;
use App\Http\Resources\jadwalHarianResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class JadwalHarianController extends Controller
{
 
    public function index()
    {
        $jadwalHarian = JadwalHarian::with(['jadwalUmum', 'instruktur'])->latest()->get();

        return new JadwalHarianResource(true, 'List Data jadwalHarian', $jadwalHarian);
    }  

    public function create()
    {
        $jadwalHarian = JadwalHarian::all();
        return view('jadwalHarian.create', compact('instruktur'), compact('jadwalUmum'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'jadwal_umum_id' => 'required|exists:jadwalUmums,id',
            'instruktur_id' => 'required|exists:instrukturs,id',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jadwalHarian = JadwalHarian::create([
            'hari' => $request->hari,
            'jadwal_umum_id' => $request->jadwal_umum_id,
            'instruktur_id' => $request->instruktur_id,
            'status' => $request->status,
        ]);
    }

    public function destroy($id)
    {
        JadwalHarian::find($id)->delete();
        return redirect()->route('jadwalHarian.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'tanggal' => 'required',
        'jadwal_umum_id' => 'required|exists:jadwalUmums,id',
        'status' => 'required',
    ]);

    JadwalHarian::findOrFail($id)->update($request->all());

    return redirect()->route('jadwalHarian.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{
    $jadwalHarian = JadwalHarian::findOrFail($id);
    return view('jadwalHarian.edit', compact('jadwalHarian'));
}


    public function show($id){    
        $jadwalHarian = JadwalHarian::findOrFail($id);
        return new JadwalHarianResource(true, 'Data jadwalHarian Berhasil Ditampilkan!', $jadwalHarian);
    }
    

}

