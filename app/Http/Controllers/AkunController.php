<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akuns = Akun::all();
        return view('settings.akun.index', compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_akun' => 'required|unique:akuns|max:255',
            'nama_akun' => 'required|max:255',
        ]);

        Akun::create($validated);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        return view('settings.akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        $validated = $request->validate([
            'kode_akun' => 'required|unique:akuns,kode_akun,' . $akun->id . '|max:255',
            'nama_akun' => 'required|max:255',
        ]);

        $akun->update($validated);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
