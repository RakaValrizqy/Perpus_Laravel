<?php  
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use App\Buku; 
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\DB;
 
class BukuController extends Controller 
{ 
    public function show() 
    { 
        return Buku::all();
    }
    public function detail($id) 
    { 
        if(Buku::where('id', $id)->exists()) { 
            $data = DB::table('buku')
            ->where('id','=',$id)
            ->select('buku.*')
            ->get();
        } 
        else { 
            return Response()->json(['message' => 'Tidak ditemukan' ]); 
        } 
    }
    
    public function update($id, Request $request) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_buku' => 'required', 
                'pengarang' => 'required', 
                'deskripsi' => 'required', 
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $ubah = Buku::where('id', $id)->update([ 
            'nama_buku' => $request->nama_buku, 
            'pengarang' => $request->pengarang, 
            'deskripsi' => $request->deskripsi,
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
                'nama_buku' => 'required', 
                'pengarang' => 'required', 
                'deskripsi' => 'required', 
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        $simpan = Buku::create([ 
            'nama_buku' => $request->nama_buku, 
            'pengarang' => $request->pengarang, 
            'deskripsi' => $request->deskripsi
        ]); 
 
        if($simpan) 
        { 
            // return response()->json([
            // 'status' => 1,
            // 'message' => 'Succes Add Book!'
            // ]);
            $data = Buku::where('nama_buku', '=', $request->nama_buku)-> get();
            return response()->json([
                'status' => 1,
                'message' => 'Success Add Book!',
                'data' => $data
            ]);
        } 
        else  
        { 
            return response()->json([
                'status' => 0,
                'message' => 'Failed Add Book!'
            ]); 
        } 
    }

    public function uploadCover(Request $request, $id) 
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'cover' => 'required|image|mimes:jpeg,png,jpg'
            ] 
        ); 
 
        if($validator->fails()) { 
            return Response()->json($validator->errors()); 
        } 
 
        //definisi nama file yang akan diupload
        $imageName = time().'.'.request()->cover->getClientOriginalExtension();
        //proses upload
        request()->cover->move(public_path('images'), $imageName);

        $ubah = Buku::where('id', $id)->update([ 
            'cover' => $imageName
        ]); 
 
        if($ubah) 
        { 
            // return response()->json([
            // 'status' => 1,
            // 'message' => 'Succes Add Book!'
            // ]);
            $data = Buku::where('nama_buku', '=', $request->nama_buku)-> get();
            return response()->json([
                'status' => 1,
                'message' => 'Success upload new cover!',
                'data' => $data
            ]);
        } 
        else  
        { 
            return response()->json([
                'status' => 0,
                'message' => 'Failed upload Book!'
            ]); 
        } 
    }
    
    public function destroy($id)
    {
        $hapus = Buku::where('id', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
 
}