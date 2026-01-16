<?php

namespace App\Http\Controllers;

use App\Models\Ro;
use App\Models\Kro;
use Illuminate\Http\Request;

class RoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ros = Ro::all();
        return view('settings.ro.index', compact('ros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kros = Kro::all();
        return view('settings.ro.create', compact('kros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ro' => 'required|unique:ros|max:255',
            'nama_ro' => 'required|max:255',
            'kro_id' => 'nullable|exists:kros,id',
        ]);

        Ro::create($validated);

        return redirect()->route('ro.index')->with('success', 'RO berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ro $ro)
    {
        return view('settings.ro.show', compact('ro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ro $ro)
    {
        $kros = Kro::all();
        return view('settings.ro.edit', compact('ro', 'kros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ro $ro)
    {
        $validated = $request->validate([
            'kode_ro' => 'required|unique:ros,kode_ro,' . $ro->id . '|max:255',
            'nama_ro' => 'required|max:255',
            'kro_id' => 'nullable|exists:kros,id',
        ]);

        $ro->update($validated);

        return redirect()->route('ro.index')->with('success', 'RO berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ro $ro)
    {
        $ro->delete();

        return redirect()->route('ro.index')->with('success', 'RO berhasil dihapus.');
    }
}
