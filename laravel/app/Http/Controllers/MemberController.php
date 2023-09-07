<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberMail; /* import model mail */

use Illuminate\Mail\Mailable;
use App\Models\Member; /* import model member */
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Validator;

//Exeption dipakai pada bagian mail
use Exception;

class MemberController extends Controller
{
    
    /**
    * index
    *
    */
    public function index(Request $request)
    {
        $query = $request->input('q');
        //get posts
        $member = Member::latest()->get();

        if (!empty($query)) {
            $member->where('nama_member', 'LIKE', "%$query%")
                   ->orWhere('email', 'LIKE', "%$query%")
                   ->orWhere('no_telpon', 'LIKE', "%$query%")
                   ->orWhere('expired_date', 'LIKE', "%query%");
        }

        // render
        return new MemberResource(true, 'List Data member', $member);
    }  

    public function create()
    {
        //get 
        $member = Member::all();
        //render view with posts
        return view('member.create', compact('member'));
    }

    public function store(Request $request)
    {
         //Validasi Formulir
         $validator = Validator::make($request ->all(), [
            'nama_member' => 'required',
            'password_member' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required|numeric|digits_between:11,13|starts_with:08',
            'tanggal_lahir' => 'required|date',
            'expired_date' => 'required',
            'depositKelas' => 'required',
        ]);
        if ($validator->fails()) { return response()->json($validator->errors(), 422);         } 
        //Fungsi Simpan Data ke dalam Database
        $member = Member::create([
            'nama_member' => $request->nama_member,
            'password_member' => $request->password_member,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'expired_date' => $request->expired_date,
            'depositKelas' => $request->depositKelas,
        ]);
        return new MemberResource(true, 'Data member Berhasil Ditambahkan!', $member); 

         return redirect()->route('member.index')
                          ->with('success','Item deleted successfully'); 
        try {
            //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama,
            ];
            Mail::to('davehabelpaprindey@gmail.com')->send(new Mailable($content));
            //Redirect jika berhasil mengirim email
            return redirect()->route('member.index')->with(['success'
            => 'Data Berhasil Disimpan, email telah terkirim!']);
        } catch (Exception $e) {
            //Redirect jika gagal mengirim email
            return redirect()->route('member.index')->with(['success'
            => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }
    public function destroy($id)
    {
        Member::find($id)->delete();
        return redirect()->route('member.index')
                        ->with('success','Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_member' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required|numeric|digits_between:11,13|starts_with:08',
            'tanggal_lahir' => 'required|date',
            'expired_date' => 'required',
            // 'depositKelas' => 'required',
        ]);

        Member::find($id)->update($request->all());

        return redirect()->route('member.index')
                        ->with('success','Item updated successfully');
    }
    public function edit($id)
    {
        $member = Member::findOrfail($id);
        return view('member.edit',compact('member'));
    }

    // public function show($nama_member){
    //     // $member = Member::findOrfail($id);
    //     // return new MemberResource(true, 'Data member Berhasil Ditampilkan!', $member);
    //     $member = Member::latest()->get();

    //         $data = $member->where('nama_member', 'LIKE', ($nama_member));

    //     // render
    //     return new MemberResource(true, 'List Data member', $data);
    // }

    public function show($id){
        $member = Member::findOrfail($id);
        return new MemberResource(true, 'Data Member Berhasil Ditampilkan!', $member);
    }

    public function expiredKelas($id)
{
    $member = Member::find($id);

    if ($member) {
        $member->depositKelas = 0;
        $member->save();

        return response()->json(['message' => 'Deposit Kelas RESET']);
    } else {
        return response()->json(['message' => 'Member not found'], 404);
    }
}
    

}

