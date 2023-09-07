<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\bookingGymMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\BookingGym; /* import model bookingGym */
use App\Models\Pegawai;
use App\Models\Member;
use App\Models\Gym;
use App\Http\Resources\BookingGymResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class BookingGymController extends Controller
{
    
    /**
    * index
    *
    */
    public function index()
    {
        //get posts
        // $bookingGym = bookingGym::with('kelas,instruktur')->latest()->get();
        $bookingGym = BookingGym::with([ 'gym', 'member'])->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Booking Gym',
            'data' => $bookingGym,
        ]);

    //     $bookingGym = bookingGym::join('kelas', 'kelas.id', '=', 'jadwal_umums.kelas_id')
    // ->join('instrukturs', 'instrukturs.id', '=', 'jadwal_umums.instruktur_id')->select('jadwal_umums.id', 'jadwal_umums.hari', 'kelas.nama as kelas_nama', 'kelas.tariff', 
    // 'instrukturs.nama as instruktur_nama', 'instrukturs.password', 'instrukturs.email', 'instrukturs.nomor_telepon', 
    // 'jadwal_umums.jam');

        // render
        return new BookingGymResource(true, 'List Data bookingGym', $bookingGym);
    }  

    public function create()
    {
        $bookingGym = BookingGym::all();
        // $instruktur = Instruktur::all();
        // $kelas = Kelas::all();

        return view('bookingGym.create', compact('jadwalHarian'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'member_id' => 'required|exists:member,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bookingGym = BookingGym::create([
            'status' => $request->status,
            'member_id' => $request->member_id,
        ]);
    }

    public function destroy($id)
    {
        BookingGym::find($id)->delete();
        return redirect()->route('bookingGym.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
        'member_id' => 'required|exists:member,id',
    ]);

    BookingGym::findOrFail($id)->update($request->all());

    return redirect()->route('bookingGym.index')
                    ->with('success','Item updated successfully');
}

public function edit($id)
{
    $bookingGym = BookingGym::findOrFail($id);
    return view('bookingGym.edit', compact('bookingGym'));
}

    public function show($id){
        
        $bookingGym = BookingGym::findOrFail($id);
        return new BookingGymResource(true, 'Data bookingGym Berhasil Ditampilkan!', $bookingGym);
    }
    
}

