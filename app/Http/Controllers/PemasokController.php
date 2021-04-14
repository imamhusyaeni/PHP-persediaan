<?php

namespace App\Http\Controllers;

use App\Pemasok;
use App\Barang;
use Illuminate\Http\Request;
use Validator;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $barang = Barang::all();
        $pemasok = Pemasok::orderby('nama_p', 'asc')->paginate(5);

        if($request->ajax())
        {
            $pemasok = Pemasok::orderby('nama_p', 'asc')->paginate(5);
            return response()->json(view('pemasok.tabel', array('pemasok' => $pemasok))->render());
        }

        return view('pemasok.index', compact('pemasok', 'barang'));
    }

    public function search(Request $request)
    {
        $value = $request->value;

        $pemasok = Pemasok::where('nama_p', 'iLIKE', '%'.$value.'%')
                        ->orderby('nama_p', 'asc')->paginate(5);
        return view('pemasok.tabel', compact('pemasok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->nama_p = e($request->nama_p);
        $request->alamat = e($request->alamat);
        $request->no_telpon = e($request->no_telpon);
        $validator = Validator::make($request->all(), [
            'nama_p' => 'required|unique:pemasok',
            'alamat' => 'required',
            'no_telpon' => 'required|max:15',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query = Pemasok::create($request->all());
            if($query){
                return response()->json(['status'=>1, 'msg'=>'Data Pemasok Berhasil Ditambahkan!']);
            }
        }
        
        // $pemasok = new Pemasok;
        // Pemasok::create($request->all());
        // return redirect('/pemasok')->response()->json(['status'=>1, 'msg'=>'Data Barang Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemasok $b)
    {
        //
        $barang = Barang::all();
        return view('pemasok.edit', compact('b', 'barang'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemasok $b)
    {
        //
        $pemasok = Pemasok::where('id_p', $b->id_p)->get();
        foreach ($pemasok as $key) {
            if ($key->nama_p == $request->nama_p) {
                $rule_nama = 'required';
            } else {
                $rule_nama = 'required|unique:pemasok';
            }
        }


        $request->validate([
            'nama_p' => $rule_nama,
            'alamat' => 'required',
            'no_telpon' => 'required|max:15',
        ]);

        Pemasok::where('id_p', $b->id_p)
            ->update([
                'nama_p' => e($request->nama_p),
                'alamat' => e($request->alamat),
                'no_telpon' => e($request->no_telpon)
            ]);
        return redirect('/pemasok')->with('status', 'Data Pemasok Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pemasok  $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemasok $b)
    {
        //
        Pemasok::destroy($b->id_p);
        return redirect('/pemasok')->with('status', 'Data Barang Berhasil Dihapus!');
    }
}
