<?php

namespace App\Http\Controllers;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    //Show / GET
    public function show(){
        return Kelas::all();

    }
    
    //Detail / GET
    public function detail($id) 
    { 
        if(Kelas::where('id_kelas', $id)->exists()) { 
            $data = DB::table('kelas')
            ->where('id_kelas', '=', $id) 
            ->select('kelas.*')
            ->get();

            return Response()->json($data);
        } 
        else { 
            return Response()->json(['message' => 'Tidak ditemukan' ]); 
        } 
    }

    //Update / PUT
    public function update($id, Request $request) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_kelas' => 'required',
                'kelompok' => 'required'
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $ubah = Kelas::where('id_kelas', $id)->update([ 
            'nama_kelas' => $request->nama_kelas,
            'kelompok' => $request->kelompok
        ]); 
 
        if($ubah) { 
            return Response()->json(['status' => 1]); 
        } 
        else { 
            return Response()->json(['status' => 0]); 
        } 
    }

    //Create / POST 
    public function store(Request $request) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_kelas' => 'required',
                'kelompok' => 'required'
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $simpan = Kelas::create([ 
            'nama_kelas' => $request->nama_kelas,
            'kelompok' => $request->kelompok
        ]); 
 
        if($simpan) { 
            return Response()->json(['status'=>1]); 
        } 
        else { 
            return Response()->json(['status'=>0]); 
        } 
    }

    //Destroy / DELETE
    public function destroy($id)
    {
        $hapus = Kelas::where('id_kelas', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
