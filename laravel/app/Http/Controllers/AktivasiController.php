<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\aktivasiMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Aktivasi; /* import model aktivasi */
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\aktivasiResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Exeption dipakai pada bagian mail
use Exception;

class AktivasiController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        $aktivasi = Aktivasi::with(['member', 'pegawai'])->latest()->get();

        // render
        return new AktivasiResource(true, 'List Data aktivasi', $aktivasi);
    }  

    public function create()
{
    $members = Member::all();
    $pegawais = Pegawai::all();
    return view('aktivasi.create', compact('members', 'pegawais'));
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'expired' => 'required',
        'harga' => 'required',
        'member_id' => 'required|exists:members,id',
        'kasir_id' => 'required|exists:pegawais,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $aktivasi = new Aktivasi;
    $aktivasi->expired = $request->expired;
    $aktivasi->harga = $request->harga;
    $aktivasi->member_id = $request->member_id;
    $aktivasi->kasir_id = $request->kasir_id;

    // try {
    //     Mail::to('example@example.com')->send(new aktivasiMail($aktivasi));
    // } catch (Exception $e) {
    //     return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    // }

    $aktivasi->save();

    return response()->json(['message' => 'Data aktivasi berhasil disimpan.'], 200);
}

    public function destroy($id)
    {
        Aktivasi::find($id)->delete();
        return redirect()->route('aktivasi.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'expired' => 'required',
        'harga' => 'required',
        'member_id' => 'required|exists:members,id',
        'kasir_id' => 'required|exists:pegawais,id',
    ]);

    Aktivasi::findOrFail($id)->update($request->all());

    return redirect()->route('aktivasi.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{

    $aktivasi = Aktivasi::findOrFail($id);
    return view('aktivasi.edit', compact('aktivasi'));
}


    public function show($id){
        
        $aktivasi = Aktivasi::join('pegawai', 'aktivasi.pegawai', '=', 'pegawai.id')
        ->join('member', 'aktivasi.member', '=', 'member.id')
        ->select('pegawai.nama as nama_pegawai', 'member.nama as nama_member')
        ->where('aktivasi.id', $id)
        ->first();
    
    if (!$aktivasi) {
        // handle case where deposit reguler with given id is not found
    }
    
    // pass the variables to the view
    return view('aktivasi.struk', compact('aktivasi'));
    }

    public function getMonthlyAktivasi($year)
{
    $monthlySum = Aktivasi::select(DB::raw('SUM(harga) as total'))
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

    return response()->json($monthlySum);
}
    

}

