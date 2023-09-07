<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\presensiGymMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\PresensiGym; /* import model presensiGym */
use App\Models\BookingGym;
use App\Models\Kelas;
use App\Models\Instruktur;
use App\Http\Resources\PresensiGymResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//Exeption dipakai pada bagian mail
use Exception;
use Carbon\Carbon;

class PresensiGymController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        // $presensiGym = presensiGym::with('kelas,instruktur')->latest()->get();
        $presensiGym = PresensiGym::with(['bookingGym', 'pegawai', 'bookingGym.member', 'bookingGym.gym'])->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Presensi Gym',
            'data' => $presensiGym,
        ]);

        // render
        return new PresensiGymResource(true, 'List Data presensiGym', $presensiGym);
    }  

    public function create()
    {
        $presensiGym = PresensiGym::all();
        return view('presensiGym.create', compact('jadwalHarian'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'booking_gym_id' => 'required',
            'kasir_id' => 'required|exists:kasir,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $presensiGym = PresensiGym::create([
            'status' => $request->status,
            'booking_gym_id' => 'required',
            'kasir_id' => $request->kasir_id,
        ]);
    }

    public function destroy($id)
    {
        PresensiGym::find($id)->delete();
        return redirect()->route('presensiGym.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        // 'status' => 'required',
        // 'booking_gym_id' => 'required',
        // 'kasir_id' => 'required|exists:kasir,id',
    ]);

    PresensiGym::findOrFail($id)->update($request->all());

    return redirect()->route('presensiGym.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{
    $presensiGym = PresensiGym::findOrFail($id);
    return view('presensiGym.edit', compact('presensiGym'));
}

    public function show($id){
        
        $presensiGym = PresensiGym::findOrFail($id);
        return new presensiGymResource(true, 'Data presensiGym Berhasil Ditampilkan!', $presensiGym);
    }

    public function countPresenceInGym($year, $month, $day)
{
    $startDate = Carbon::createFromDate($year, $month, 0);
    $endDate = Carbon::createFromDate($year, $month, $day);

    $presenceCounts = BookingGym::where('tanggal', '>=', $startDate)
        ->where('tanggal', '<=', $endDate)
        ->groupBy('tanggal')
        ->select('tanggal', DB::raw('count(*) as count'))
        ->get()
        ->map(function ($item) {
            return [
                'date' => Carbon::parse($item->tanggal)->format('j F Y'),
                'count' => $item->count,
            ];
        });

    return response()->json([
        'success' => true,
        'message' => 'Count of presence in the gym',
        'counts' => $presenceCounts,
    ]);
}
    

}

