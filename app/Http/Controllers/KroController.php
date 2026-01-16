<?php

namespace App\Http\Controllers;

use App\Models\Kro;
use App\Models\Program;
use Illuminate\Http\Request;

class KroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kros = Kro::all();
        return view('settings.kro.index', compact('kros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('settings.kro.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kro' => 'required|unique:kros|max:255',
            'nama_kro' => 'required|max:255',
            'program_id' => 'nullable|exists:programs,id',
        ]);

        Kro::create($validated);

        return redirect()->route('kro.index')->with('success', 'KRO berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kro $kro)
    {
        return view('settings.kro.show', compact('kro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kro $kro)
    {
        $programs = Program::all();
        return view('settings.kro.edit', compact('kro', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kro $kro)
    {
        $validated = $request->validate([
            'kode_kro' => 'required|unique:kros,kode_kro,' . $kro->id . '|max:255',
            'nama_kro' => 'required|max:255',
            'program_id' => 'nullable|exists:programs,id',
        ]);

        $kro->update($validated);

        return redirect()->route('kro.index')->with('success', 'KRO berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kro $kro)
    {
        $kro->delete();

        return redirect()->route('kro.index')->with('success', 'KRO berhasil dihapus.');
    }
}
