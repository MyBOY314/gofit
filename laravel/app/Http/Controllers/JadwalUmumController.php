<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalUmumMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\JadwalUmum; /* import model JadwalUmum */
use App\Models\Kelas;
use App\Models\Instruktur;
use App\Http\Resources\JadwalUmumResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class JadwalUmumController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        // $jadwalUmum = JadwalUmum::with('kelas,instruktur')->latest()->get();
        $jadwalUmum = JadwalUmum::with(['kelas', 'instruktur'])->latest()->get();

    //     $jadwalUmum = JadwalUmum::join('kelas', 'kelas.id', '=', 'jadwal_umums.kelas_id')
    // ->join('instrukturs', 'instrukturs.id', '=', 'jadwal_umums.instruktur_id')->select('jadwal_umums.id', 'jadwal_umums.hari', 'kelas.nama as kelas_nama', 'kelas.tariff', 
    // 'instrukturs.nama as instruktur_nama', 'instrukturs.password', 'instrukturs.email', 'instrukturs.nomor_telepon', 
    // 'jadwal_umums.jam');

        // render
        return new JadwalUmumResource(true, 'List Data JadwalUmum', $jadwalUmum);
    }  

    public function create()
    {
        $jadwalUmum = JadwalUmum::all();
        // $instruktur = Instruktur::all();
        // $kelas = Kelas::all();

        return view('jadwalUmum.create', compact('instruktur'), compact('kelas'));
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

        $jadwalUmum = JadwalUmum::create([
            'hari' => $request->hari,
            'kelas_id' => $request->kelas_id,
            'instruktur_id' => $request->instruktur_id,
            'jam' => $request->jam,
        ]);

        // try {
        //     $content = [
        //         'body' => $jadwalUmum->nama,
        //     ];
        //     Mail::to('davehabelpaprindey@gmail.com')->send(new JadwalUmumMail($content));
        //     return redirect()->route('jadwalUmum.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        // } catch (Exception $e) {
        //     return redirect()->route('jadwalUmum.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        // }
    }

    public function destroy($id)
    {
        JadwalUmum::find($id)->delete();
        return redirect()->route('jadwalUmum.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'hari' => 'required',
        'kelas_id' => 'required|exists:kelas,id',
        'instruktur_id' => 'required|exists:instrukturs,id',
        'jam' => 'required|date_format:H:i',
    ]);

    JadwalUmum::findOrFail($id)->update($request->all());

    return redirect()->route('jadwalUmum.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{
    // $jadwalUmum=JadwalUmum::join('jadwalUmum','jadwalUmum.kelas','=','kelas.id')->select('kelas.id','kelas.nama','kelas.tariff')->find($id);
    //     $kelas = Kelas::all();

    // $jadwalUmum=JadwalUmum::join('jadwalUmum','jadwalUmum.instruktur','=','instruktur.id')
    // ->select('instruktur.id','instruktur.nama','instruktur.password','instruktur.email','instruktur.nomor_telepon')->find($id);
    //     $instruktur = Instruktur::all();

    $jadwalUmum = JadwalUmum::findOrFail($id);
    return view('jadwalUmum.edit', compact('jadwalUmum'));
}

    // public function show($nama_JadwalUmum){
    //     // $JadwalUmum = JadwalUmum::findOrfail($id);
    //     // return new JadwalUmumResource(true, 'Data JadwalUmum Berhasil Ditampilkan!', $JadwalUmum);
    //     $JadwalUmum = JadwalUmum::latest()->get();

    //         $data = $JadwalUmum->where('nama_JadwalUmum', 'LIKE', ($nama_JadwalUmum));

    //     // render
    //     return new JadwalUmumResource(true, 'List Data JadwalUmum', $data);
    // }

    public function show($id){
        
        $jadwalUmum = JadwalUmum::findOrFail($id);
        return new JadwalUmumResource(true, 'Data JadwalUmum Berhasil Ditampilkan!', $jadwalUmum);
    }
    

}

