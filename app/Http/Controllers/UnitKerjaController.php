<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\DataTables\UnitKerjaDataTable;
use RealRashid\SweetAlert\Facades\Alert;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UnitKerjaDataTable $dataTable)
    {
        return $dataTable->render('pages.unitKerja.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.unitKerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_unit' => 'required',
        ]);

        UnitKerja::create($validated);
        Alert::success('success','Data berhasil ditambahkan')->autoClose(3000)->toToast()->timerProgressBar();
        return redirect()->route('unit-kerja.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitKerja $unitKerja)
    {
        return view('pages.unitKerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitKerja $unitKerja)
    {
        $validated = $request->validate([
            'nama_unit' => 'required',
        ]);

        $unitKerja->update($validated);
        Alert::success('success','Data berhasil diupdate')->autoClose(3000)->toToast()->timerProgressBar();
        return redirect()->route('unit-kerja.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitKerja $unitKerja)
    {
        $unitKerja->delete();
        Alert::success('success','Data berhasil dihapus')->autoClose(3000)->timerProgressBar()->toToast();
        return redirect()->route('unit-kerja.index');
    }
}
