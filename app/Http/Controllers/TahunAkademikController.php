<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\TahunAkademikDataTable;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TahunAkademikDataTable $dataTable)
    {
        return $dataTable->render('pages.tahunAkademik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tahunAkademik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['tahun_akademik'] = $request->tahun_akademik;
        
        TahunAkademik::create($data);
        Alert::success('success', 'data created successfully')->autoclose(2000)->toToast();
        return redirect()->route('tahun-akademik.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAkademik $tahunAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAkademik $tahunAkademik)
    {
        return view('pages.tahunAkademik.edit', compact('tahunAkademik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAkademik $tahunAkademik)
    {
        $data = $request->all();
        $tahunAkademik->update($data);
        Alert::success('success', 'data updated sucessfully')->autoclose(2000)->toToast();
        return redirect()->route('tahun-akademik.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        $tahunAkademik->delete();
        Alert::success('success', 'data deleted successfully')->autoclose(2000)->toToast();
        return redirect()->route('tahun-akademik.index');
    }
}
