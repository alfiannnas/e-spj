<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\Ro;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komponens = Komponen::all();
        return view('settings.komponen.index', compact('komponens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ros = Ro::all();
        return view('settings.komponen.create', compact('ros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_komponen' => 'required|unique:komponens|max:255',
            'nama_komponen' => 'required|max:255',
            'ro_id' => 'nullable|exists:ros,id',
        ]);

        Komponen::create($validated);

        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komponen $komponen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komponen $komponen)
    {
        $ros = Ro::all();
        return view('settings.komponen.edit', compact('komponen', 'ros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komponen $komponen)
    {
        $validated = $request->validate([
            'kode_komponen' => 'required|unique:komponens,kode_komponen,' . $komponen->id . '|max:255',
            'nama_komponen' => 'required|max:255',
            'ro_id' => 'nullable|exists:ros,id',
        ]);

        $komponen->update($validated);

        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komponen $komponen)
    {
        $komponen->delete();

        return redirect()->route('komponen.index')->with('success', 'Komponen berhasil dihapus.');
    }
}
