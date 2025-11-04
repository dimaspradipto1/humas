<?php

namespace App\Http\Controllers;

use App\Models\KotakMasukPengajuan;
use Illuminate\Http\Request;
use App\DataTables\KotakMasukPengajuanDataTable;

class KotakMasukPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(KotakMasukPengajuanDataTable $dataTable)
    {
        return $dataTable->render('pages.kotakMasukPengajuan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KotakMasukPengajuan $kotakMasukPengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KotakMasukPengajuan $kotakMasukPengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KotakMasukPengajuan $kotakMasukPengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KotakMasukPengajuan $kotakMasukPengajuan)
    {
        //
    }
}
