<?php

namespace App\Http\Controllers;

use App\Barangkeluar;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Validator;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $barangkeluar = Barangkeluar::orderby('tgl_k', 'desc')->paginate(5);
        $barang = Barang::orderby('nama_b', 'asc')->get();

        if($request->ajax())
        {
            $barangkeluar = Barangkeluar::orderby('tgl_k', 'desc')->paginate(5);
            return response()->json(view('barangkeluar.tabel', array('barangkeluar' => $barangkeluar))->render());
        }

        return view('barangkeluar.index', compact('barangkeluar', 'barang'));
    }

    public function search(Request $request)
    {
        $value = $request->value;

        $barangkeluar = Barangkeluar::where('nama_bk', 'iLIKE', '%'.$value.'%')
                        ->orderby('tgl_k', 'desc')->paginate(5);
        return view('barangkeluar.tabel', compact('barangkeluar'));
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
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
            'keterangan' => 'required',
            'tgl_k' => 'required',
        ]);

        $x = Str::of($request->nama_bk)->explode('|');
        $y = (int)$x[1];
        $nama_bk = $x[0];
        $stok = $y - $request->jumlah;

        $barangkeluar = new Barangkeluar;
        $barangkeluar->nama_bk = $nama_bk;
        $barangkeluar->keterangan = e($request->keterangan);
        $barangkeluar->tgl_k = $request->tgl_k;
        $barangkeluar->jumlah = $request->jumlah;
        // $query = $barangkeluar->save();

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            Barang::where('nama_b', $nama_bk)->update(['jumlah' => $stok]);
            $query = $barangkeluar->save();
            if($query){
                return response()->json(['status'=>1, 'msg'=>'Data Barang Keluar Berhasil Ditambahkan!']);
            }
        }
        
        Barang::where('nama_b', $nama_bk)->update(['jumlah' => $stok]);
        return redirect('/barangkeluar')->with('status', 'Data Barang Keluar Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barangkeluar  $barangkeluar
     * @return \Illuminate\Http\Response
     */
    public function show(Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barangkeluar  $barangkeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barangkeluar  $barangkeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barangkeluar  $barangkeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barangkeluar $b)
    {
        //
        $x = $b->nama_bk;
        $y = $b->jumlah;
        $barang = Barang::where('nama_b', $x)->get();
        foreach ($barang as $key) {
            $jumlah = $key->jumlah;
        }
        $stok = $jumlah + $y;        

        Barang::where('nama_b', $x)->update(['jumlah' => $stok]);
        Barangkeluar::destroy($b->id_bk);
        return redirect('/barangkeluar')->with('status', 'Data Barang Berhasil Dihapus!');
    }
}
