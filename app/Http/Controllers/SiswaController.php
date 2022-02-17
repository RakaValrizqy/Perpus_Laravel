<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Siswa; 
use Illuminate\Support\Facades\Validator; 
 
class SiswaController extends Controller 
{ 
    public function show() 
    { 
        $data_siswa = Siswa::join('kelas', 'kelas.id_kelas', 'siswa.id_kelas')->get(); 
        return Response()->json($data_siswa); 
    }
    public function detail($id) 
    { 
        if(Siswa::where('id', $id)->exists()) { 
            $data_siswa = Siswa::join('kelas', 'kelas.id_kelas', 'siswa.id_kelas') 
                                      ->where('siswa.id', '=', $id) 
                                      ->get(); 
             
            return Response()->json($data_siswa); 
        } 
        else { 
            return Response()->json(['message' => 'Tidak ditemukan' ]); 
        } 
    }
    
    public function update($id, Request $request) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_siswa' => 'required', 
                'tanggal_lahir' => 'required', 
                'gender' => 'required', 
                'alamat' => 'required', 
                'id_kelas' => 'required' 
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $ubah = Siswa::where('id', $id)->update([ 
            'nama_siswa' => $request->nama_siswa, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'gender' => $request->gender, 
            'alamat' => $request->alamat, 
            'id_kelas' => $request->id_kelas 
        ]); 
 
        if($ubah) { 
            return Response()->json(['status' => 1]); 
        } 
        else { 
            return Response()->json(['status' => 0]); 
        } 
    }

    public function store(Request $request) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_siswa' => 'required', 
                'tanggal_lahir' => 'required', 
                'gender' => 'required', 
                'alamat' => 'required', 
                'id_kelas' => 'required' 
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $simpan = Siswa::create([ 
            'nama_siswa' => $request->nama_siswa, 
            'tanggal_lahir' => $request->tanggal_lahir, 
            'gender' => $request->gender, 
            'alamat' => $request->alamat, 
            'id_kelas' => $request->id_kelas 
        ]); 
 
        if($simpan) 
        { 
            return Response()->json(['status' => 1]); 
        } 
        else  
        { 
            return Response()->json(['status' => 0]); 
        } 
    }
    
    public function destroy($id)
    {
        $hapus = Siswa::where('id', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
 
}