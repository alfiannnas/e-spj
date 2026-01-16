<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return view('settings.program.index', compact('programs'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kegiatan' => 'required|unique:programs|max:255',
            'nama_kegiatan' => 'required|max:255',
        ]);

        Program::create($validated);

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('settings.program.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('settings.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'kode_kegiatan' => 'required|unique:programs,kode_kegiatan,' . $program->id . '|max:255',
            'nama_kegiatan' => 'required|max:255',
        ]);

        $program->update($validated);

        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus.');
    }
}

