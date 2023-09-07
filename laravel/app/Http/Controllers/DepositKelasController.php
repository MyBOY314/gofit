<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\depositKelasMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\DepositKelas; /* import model depositKelas */
use App\Models\Kelas;
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\DepositKelasResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Exeption dipakai pada bagian mail
use Exception;

class DepositKelasController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        $depositKelas = DepositKelas::with(['kelas','member', 'pegawai'])->latest()->get();

        // render
        return new DepositKelasResource(true, 'List Data depositKelas', $depositKelas);
    }  

    public function create()
{
    $members = Member::all();
    $pegawais = Pegawai::all();
    $kelas = Kelas::all();
    return view('depositKelas.create', compact('kelas','members', 'pegawais'));
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

    $depositKelas = new DepositKelas;
    $depositKelas->jumlah_deposit = $request->jumlah_deposit;
    $depositKelas->expired_date = $request->expired_date ;
    $depositKelas->kelas_id = $request->kelas_id;
    $depositKelas->member_id = $request->member_id;
    $depositKelas->kasir_id = $request->kasir_id;

    // try {
    //     Mail::to('example@example.com')->send(new depositKelasMail($depositKelas));
    // } catch (Exception $e) {
    //     return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    // }

    $depositKelas->save();

    return response()->json(['message' => 'Data deposit berhasil disimpan.'], 200);
}

    public function destroy($id)
    {
        DepositKelas::find($id)->delete();
        return redirect()->route('depositKelas.index')
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

    DepositKelas::findOrFail($id)->update($request->all());

    return redirect()->route('depositKelas.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{

    $depositKelas = DepositKelas::findOrFail($id);
    return view('depositKelas.edit', compact('depositKelas'));
}


    public function show($id){
        
        $depositKelas = DepositKelas::findOrFail($id);
        return new DepositKelasResource(true, 'Data Deposit Kelas Berhasil Ditampilkan!', $depositKelas);
    }
    
    public function getMonthlyClass($year)
{
    $monthlySum = DepositKelas::select(DB::raw('SUM(deposit_kelas.jumlah_deposit * kelas.tariff) as total'))
        ->join('kelas', 'deposit_kelas.kelas_id', '=', 'kelas.id')
        ->whereYear('deposit_kelas.created_at', $year)
        ->groupBy(DB::raw('MONTH(deposit_kelas.created_at)'))
        ->get();

    return response()->json($monthlySum);
}

}

