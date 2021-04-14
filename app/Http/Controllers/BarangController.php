<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Barangkeluar;
use App\Pemasok;
use Illuminate\Http\Request;
use Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $barang = Barang::orderby('nama_b', 'asc')->paginate(5);
        $pemasok = Pemasok::all();

        if($request->ajax())
        {
            $barang = Barang::orderby('nama_b', 'asc')->paginate(5);;
            return response()->json(view('barang.tabel', array('barang' => $barang))->render());
        }

        return view('barang.index', compact('barang', 'pemasok'));
    }

    public function search(Request $request)
    {
        $value = $request->value;

        $barang = Barang::where('nama_b', 'iLIKE', '%'.$value.'%')
                        ->orderby('nama_b', 'asc')->paginate(5);
        return view('barang.tabel', compact('barang'));
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
        $request->alamat = e($request->alamat);
        $request->nama_b = e($request->nama_b);
        $request->brand = e($request->brand);

        $validator = Validator::make($request->all(), [
            'nama_b' => 'required|unique:barang',
            'brand' => 'required',
            'jumlah' => 'required',
            'tgl_m' => 'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query = Barang::create($request->all());
            if($query){
                return response()->json(['status'=>1, 'msg'=>'Data Barang Berhasil Ditambahkan!']);
            }
        }
        

        // $barang = new Barang;
        // Barang::create($request->all());
        // return redirect('/barang')->with('status', 'Data Barang Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $b)
    {
        //
        $barang = Barang::all();
        $pemasok = Pemasok::all();
        return view('barang.edit', compact('b', 'barang', 'pemasok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $b)
    {
        //
        $barang = Barang::where('id_b', $b->id_b)->get();
        foreach ($barang as $key) {
            if ($key->nama_b == $request->nama_b) {
                $rule_nama = 'required';
            } else {
                $rule_nama = 'required|unique:barang';
            }
        }

        $request->validate([
            'nama_b' => $rule_nama,
            'brand' => 'required',
            'jumlah' => 'required',
            'tgl_m' => 'required|after_or_equal:tgl_m',
        ]);

        $jumlah = $request->jumlah;
        $tambah = $request->tambah;
        $stok = $jumlah + $tambah;
        Barang::where('id_b', $b->id_b)
            ->update([
                'nama_b' => e($request->nama_b),
                'brand' => e($request->brand),
                'pemasok' => $request->pemasok,
                'jumlah' => $stok,
                'tgl_m' => $request->tgl_m
            ]);
        return redirect('/barang')->with('status', 'Data Barang Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $b)
    {
        //
        Barang::destroy($b->id_b);
        return redirect('/barang')->with('status', 'Data Barang Berhasil Dihapus!');
    }
}
