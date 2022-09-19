<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\pendudukRumahModels;

class DataPendudukKK extends DashboardController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['dataPenduduk'] = pendudukRumahModels::all();
		$this->data['active'] = 'Data Penduduk';
		// dd($this->data['dataPenduduk']);
		return view('dashboard.penduduk_index', $this->data); //
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data['active'] = 'Tambah Penduduk';
		return view('dashboard.penduduk_tambah', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
//  validation
		$this->validate($request, [
			'namaKK' => 'required',
			'nomerKK' => 'required|unique:penduduk_rumah,nama_kk|numeric|max:value:16',
			'jumlahAnggota' => 'required',
			'rt' => 'required',
			'koordinatx' => 'required',
			'koordinaty' => 'required',
		],[
			'namaKK.required' => 'Nama KK tidak boleh kosong',
			'nomerKK.required' => 'Nomer KK tidak boleh kosong',
			'nomerKK.unique' => 'Nomer KK sudah terdaftar',
			'nomerKK.numeric' => 'Nomer KK harus berupa angka',
			'nomerKK.max' => 'Nomer KK maksimal 16 angka',
			'jumlahAnggota.required' => 'Jumlah Anggota tidak boleh kosong',
			'rt.required' => 'RT tidak boleh kosong',
			'koordinatx.required' => 'Koordinat X tidak boleh kosong',
			'koordinaty.required' => 'Koordinat Y tidak boleh kosong',
		]);

		$penduduk = new pendudukRumahModels;
		$penduduk->nama_kk = $request->namaKK;
		$penduduk->noKK = $request->nomerKK;
		$penduduk->jumlah_anggota = $request->jumlahAnggota;
		$penduduk->rt = $request->rt;
		$penduduk->koor_x = $request->koordinatx;
		$penduduk->koor_y = $request->koordinaty;
		$penduduk->created_at = date('Y-m-d H:i:s');
		$penduduk->save();

		return redirect()->route('data-penduduk.index')->with('success', 'Data Penduduk Berhasil Ditambahkan');
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
