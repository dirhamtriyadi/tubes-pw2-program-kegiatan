<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailProgram;

class DetailProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DetailProgram::where('program_kegiatan_id', $id)->with('program_kegiatan')->get();
        return response()->json($data, 200);
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
        // dd($request->all());
        $validatedData = $request->validate([
            'program_kegiatan_id' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal' => 'required',
            'pengeluaran' => 'required',
            'bukti' => 'required|file|image|mimes:jpeg,png,jpg',
        ], [
            'program_kegiatan_id.required' => 'Program Kegiatan tidak boleh kosong',
            'nama_kegiatan.required' => 'Nama Kegiatan tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'pengeluaran.required' => 'Pengeluaran tidak boleh kosong',
            'bukti.required' => 'Bukti tidak boleh kosong',
            'bukti.file' => 'Bukti harus berupa file',
            'bukti.image' => 'Bukti harus berupa gambar',
            'bukti.mimes' => 'Bukti harus berupa gambar dengan format jpeg, png, atau jpg',
        ]);

        $bukti = $request->file('bukti')->getClientOriginalName();
        $request->file('bukti')->move(public_path('bukti'), $bukti);

        $data = DetailProgram::create([
            'program_kegiatan_id' => $request->program_kegiatan_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'pengeluaran' => $request->pengeluaran,
            'bukti' => $bukti,
        ]);

        return redirect()->route('prokeg')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}