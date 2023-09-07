<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\izinInstrukturMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\JadwalUmum;
use App\Models\IzinInstruktur; /* import model izinInstruktur */
use App\Models\Kelas;
use App\Models\Instruktur;
use App\Http\Resources\izinInstrukturResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class IzinInstrukturController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        $izinInstruktur = IzinInstruktur::with('jadwalUmum.kelas', 'jadwalUmum.instruktur')->get();
    return response()->json([
        'success' => true,
        'message' => 'List Data izinInstruktur',
        'data' => $izinInstruktur,
    ]);

    //     $izinInstruktur = izinInstruktur::join('kelas', 'kelas.id', '=', 'jadwal_umums.kelas_id')
    // ->join('instrukturs', 'instrukturs.id', '=', 'jadwal_umums.instruktur_id')->select('jadwal_umums.id', 'jadwal_umums.hari', 'kelas.nama as kelas_nama', 'kelas.tariff', 
    // 'instrukturs.nama as instruktur_nama', 'instrukturs.password', 'instrukturs.email', 'instrukturs.nomor_telepon', 
    // 'jadwal_umums.jam');

        // render
        return new IzinInstrukturResource(true, 'List Data izinInstruktur', $izinInstruktur);
    }  

    public function create()
    {
        $izinInstruktur = IzinInstruktur::all();
        // $instruktur = Instruktur::all();
        // $kelas = Kelas::all();

        return view('izinInstruktur.create', compact('instruktur'), compact('kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'instruktur_id' => 'required|exists:instrukturs,id',
            'jam' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $izinInstruktur = IzinInstruktur::create([
            'hari' => $request->hari,
            'kelas_id' => $request->kelas_id,
            'instruktur_id' => $request->instruktur_id,
            'jam' => $request->jam,
        ]);

        // try {
        //     $content = [
        //         'body' => $izinInstruktur->nama,
        //     ];
        //     Mail::to('davehabelpaprindey@gmail.com')->send(new izinInstrukturMail($content));
        //     return redirect()->route('izinInstruktur.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        // } catch (Exception $e) {
        //     return redirect()->route('izinInstruktur.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        // }
    }

    public function destroy($id)
    {
        IzinInstruktur::find($id)->delete();
        return redirect()->route('izinInstruktur.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        // 'hari' => 'required',
        // 'kelas_id' => 'required|exists:kelas,id',
        // 'instruktur_id' => 'required|exists:instrukturs,id',
        // 'jam' => 'required|date_format:H:i',
        'konfirmasi' => 'required'
    ]);

    IzinInstruktur::findOrFail($id)->update($request->all());

    return redirect()->route('izinInstruktur.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{
    $izinInstruktur = IzinInstruktur::findOrFail($id);
    $kelas = Kelas::all();
    $instruktur = Instruktur::all();
    $jadwalUmum = JadwalUmum::all();

    return view('izinInstruktur.edit', compact('izinInstruktur', 'kelas', 'instruktur', 'jadwalUmum'));
}

    // public function show($nama_izinInstruktur){
    //     // $izinInstruktur = izinInstruktur::findOrfail($id);
    //     // return new izinInstrukturResource(true, 'Data izinInstruktur Berhasil Ditampilkan!', $izinInstruktur);
    //     $izinInstruktur = izinInstruktur::latest()->get();

    //         $data = $izinInstruktur->where('nama_izinInstruktur', 'LIKE', ($nama_izinInstruktur));

    //     // render
    //     return new izinInstrukturResource(true, 'List Data izinInstruktur', $data);
    // }

    public function show($id){
        
        $izinInstruktur = IzinInstruktur::findOrFail($id);
        return new IzinInstrukturResource(true, 'Data izinInstruktur Berhasil Ditampilkan!', $izinInstruktur);
    }
    

}

