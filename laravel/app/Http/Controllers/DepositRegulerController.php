<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\depositRegulerMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\DepositReguler; /* import model depositReguler */
use App\Models\Member;
use App\Models\Pegawai;
use App\Http\Resources\DepositRegulerResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Exeption dipakai pada bagian mail
use Exception;

class DepositRegulerController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        $depositReguler = DepositReguler::with(['member', 'pegawai'])->latest()->get();

        // render
        return new DepositRegulerResource(true, 'List Data depositReguler', $depositReguler);
    }  

    public function create()
{
    $members = Member::all();
    $pegawais = Pegawai::all();
    return view('depositReguler.create', compact('members', 'pegawais'));
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'deposit_uang' => 'required',
        'member_id' => 'required|exists:members,id',
        'kasir_id' => 'required|exists:pegawais,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $depositReguler = new DepositReguler;
    $depositReguler->deposit_uang = $request->deposit_uang;
    $depositReguler->member_id = $request->member_id;
    $depositReguler->kasir_id = $request->kasir_id;

    // try {
    //     Mail::to('example@example.com')->send(new depositRegulerMail($depositReguler));
    // } catch (Exception $e) {
    //     return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    // }

    $depositReguler->save();

    return response()->json(['message' => 'Data deposit berhasil disimpan.'], 200);
}

    public function destroy($id)
    {
        DepositReguler::find($id)->delete();
        return redirect()->route('depositReguler.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'deposit_uang' => 'required',
            'member_id' => 'required|exists:member,id',
            'kasir_id' => 'required|exists:pegawai,id',
    ]);

    DepositReguler::findOrFail($id)->update($request->all());

    return redirect()->route('depositReguler.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{

    $depositReguler = DepositReguler::findOrFail($id);
    return view('depositReguler.edit', compact('depositReguler'));
}


    public function show($id){
        
        $depositReguler = DepositReguler::join('pegawai', 'depositReguler.pegawai', '=', 'pegawai.id')
        ->join('member', 'depositReguler.member', '=', 'member.id')
        ->select('pegawai.nama as nama_pegawai', 'member.nama as nama_member')
        ->where('depositReguler.id', $id)
        ->first();
    
    if (!$depositReguler) {
        // handle case where deposit reguler with given id is not found
    }
    
    // pass the variables to the view
    return view('depositReguler.struk', compact('depositReguler'));
    }

    public function getMonthlySum($year)
{
    $monthlySum = DepositReguler::select(DB::raw('SUM(deposit_uang) as total'))
        ->whereYear('created_at', $year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

    return response()->json($monthlySum);
}
    

}

