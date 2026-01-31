<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $pegawai = Pegawai::firstOrCreate(['user_id' => auth()->id()]);
        return view('pages.pegawai.index', compact('users', 'pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('pages.pegawai.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['email', 'user_id', 'foto']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $users = User::all();
        return view('pages.pegawai.edit', compact('pegawai', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['email', 'user_id', 'foto']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
