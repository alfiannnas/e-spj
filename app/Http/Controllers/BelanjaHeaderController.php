<?php

namespace App\Http\Controllers;

use App\Models\BelanjaHeader;
use Illuminate\Http\Request;

class BelanjaHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $belanjaHeaders = BelanjaHeader::all();
        $programs = \App\Models\Program::all();
        $kros = \App\Models\Kro::all();
        // dd($belanjaHeaders);
        return view('belanja-redesain.index', compact('belanjaHeaders', 'programs', 'kros'));
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
    public function show(BelanjaHeader $belanjaHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BelanjaHeader $belanjaHeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BelanjaHeader $belanjaHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BelanjaHeader $belanjaHeader)
    {
        //
    }

    /**
     * Store belanja header data via AJAX.
     */
    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'nama_uraian' => 'required|string|max:255',
        ]);

        try {
            $belanja = BelanjaHeader::create($validated);
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

    /**
     * Store KRO for belanja header via AJAX.
     */
    public function storeKro(Request $request, BelanjaHeader $belanjaHeader)
    {
        $validated = $request->validate([
            'kro_id' => 'required|exists:kros,id',
        ]);

        try {
            $belanjaHeader->update(['kro_id' => $validated['kro_id']]);
            
            return response()->json([
                'success' => true,
                'message' => 'KRO berhasil dipilih',
                'data' => $belanjaHeader
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
