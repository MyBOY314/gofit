<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\KelasMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Kelas;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\KelasResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class KelasController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
{
    $Kelas = Kelas::latest()->get();
        // render
    return new KelasResource(true, 'List Data Kelas', $Kelas);
}  

    public function create()
{
    $members = Member::all();
    $pegawais = Pegawai::all();
    $kelas = Kelas::all();
    return view('Kelas.create', compact('kelas','members', 'pegawais'));
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'jumlah_deposit' => 'required',
        'expired_date' => 'required',
        'kelas_id' => 'required|exists:kelas,id',
        'member_id' => 'required|exists:members,id',
        'kasir_id' => 'required|exists:pegawais,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $Kelas = new Kelas;
    $Kelas->jumlah_deposit = $request->jumlah_deposit;
    $Kelas->expired_date = $request->expired_date ;
    $Kelas->kelas_id = $request->kelas_id;
    $Kelas->member_id = $request->member_id;
    $Kelas->kasir_id = $request->kasir_id;

    // try {
    //     Mail::to('example@example.com')->send(new KelasMail($Kelas));
    // } catch (Exception $e) {
    //     return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    // }

    $Kelas->save();
    return response()->json(['message' => 'Data deposit berhasil disimpan.'], 200);
}

    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return redirect()->route('Kelas.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'jumlah_deposit' => 'required',
        'expired_date' => 'required',
        'kelas_id' => 'required|exists:kelas,id',
        'member_id' => 'required|exists:members,id',
        'kasir_id' => 'required|exists:pegawais,id',
    ]);
    Kelas::findOrFail($id)->update($request->all());
    return redirect()->route('Kelas.index')
                    ->with('success','Item updated successfully');
}
public function edit($id)
{
    $Kelas = Kelas::findOrFail($id);
    return view('Kelas.edit', compact('Kelas'));
}
    public function show($id){
        
        $Kelas = Kelas::findOrFail($id);
        return new KelasResource(true, 'Data Deposit Kelas Berhasil Ditampilkan!', $Kelas);
    }
}