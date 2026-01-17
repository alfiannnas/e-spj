<?php

namespace App\Http\Controllers;

use App\Models\BelanjaRedesain;
use Illuminate\Http\Request;

class BelanjaRedesainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $belanjaRedesains = BelanjaRedesain::all();
        $programs = \App\Models\Program::all();
        // dd($belanjaRedesains);
        return view('belanja-redesain.index', compact('belanjaRedesains', 'programs'));
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
    public function show(BelanjaRedesain $belanjaRedesain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BelanjaRedesain $belanjaRedesain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BelanjaRedesain $belanjaRedesain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BelanjaRedesain $belanjaRedesain)
    {
        //
    }

    /**
     * Store belanja redesain data via AJAX.
     */
    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'nama_uraian' => 'required|string|max:255',
        ]);

        try {
            $belanja = BelanjaRedesain::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Data belanja berhasil disimpan',
                'data' => $belanja
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
