<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepartemenMail; /* import model mail */
use App\Models\Departemen; /* import model departemen */
use Illuminate\Http\Request;

use App\Http\Resources\DepartemenResource;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    /** 
     * index 
     * 
     * @return void 
     */
    public function index()
    {
        //get departemen         
        $departemen = Departemen::latest()->get();
        //render view with posts        
        return new DepartemenResource(true, 'List Data Departemen', $departemen);
    }
    /**
     * create 
     *
     * @return void
     */

    public function create()
    {
        return view('departemen.create');
    }

    /**
     * store 
     *
     * @param Request $request 
     * @return void 
     */

    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), ['nama_departemen'  => 'required','nama_manager'=> 'required','jumlah_pegawai' => 'required']);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database 
        $departemen = Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai
        ]);

        return new DepartemenResource(true, 'Data Departemen Berhasil Ditambahkan!', $departemen);

        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama_departemen,
            ];

            //Mengirim email ke emailtujuan@gmail.com 
            Mail::to('davehabelpaprindey@gmail.com')->send(new DepartemenMail($content));

            //Redirect jika berhasil mengirim email
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email 
            return redirect()->route('departemen.index')->with([
                'success' => 'Data Berhasil Disimpan, namun gagal mengirim email!'
            ]);
        }
        
    }
    public function destroy($id)
    {
        Departemen::find($id)->delete();
        return redirect()->route('departemen.index')
            ->with('success', 'Item deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_departemen' => 'required',
        ]);

        Departemen::find($id)->update($request->all());

        return redirect()->route('departemen.index')
            ->with('success', 'Item updated successfully');

        $departemen = Departemen::create($request);

        if ($departemen) {
            return back()->with('success', 'Success! User created');
        } else {
            return back()->with('failed', 'Failed! User not created');
        }
    }
    public function edit($id)
    {
        $departemen = Departemen::find($id);

        return view('departemen.edit', compact('departemen'));
    }

    public function show($id){
        $departemen = Departemen::findOrfail($id);
        return new DepartemenResource(true, 'Data Departemen Berhasil Ditampilkan!', $departemen);
    }
}
