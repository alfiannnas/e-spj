<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::orderBy('created_at', 'desc')->paginate(15);
        $title = 'Manajemen Asset';

        return view('manajemen-asset.index', compact('assets', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Manajemen Asset';
        return view('manajemen-asset.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'nullable|unique:assets,kode',
            'nama' => 'required|string|max:255',
            'nup' => 'nullable|string|max:100',
            'tgl_perolehan' => 'nullable|date',
            'jumlah' => 'nullable|integer|min:1',
            'satuan' => 'nullable|string|max:50',
            'merk_tipe' => 'nullable|string|max:255',
            'kondisi' => 'nullable|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'nullable|in:Aktif,Tidak Aktif',
            'penanggung_jawab' => 'nullable|string|max:255',
        ]);

        $data = $request->only(array_keys($validated));

        Asset::create($data);

        return redirect()->route('manajemen-asset.index')->with('success', 'Asset berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $manajemen_asset)
    {
        $title = 'Manajemen Asset';
        return view('manajemen-asset.edit', compact('manajemen_asset', 'title'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $manajemen_asset)
    {
        $validated = $request->validate([
            'kode' => 'nullable|unique:assets,kode,' . $manajemen_asset->id,
            'nama' => 'required|string|max:255',
            'nup' => 'nullable|string|max:100',
            'tgl_perolehan' => 'nullable|date',
            'jumlah' => 'nullable|integer|min:1',
            'satuan' => 'nullable|string|max:50',
            'merk_tipe' => 'nullable|string|max:255',
            'kondisi' => 'nullable|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'nullable|in:Aktif,Tidak Aktif',
            'penanggung_jawab' => 'nullable|string|max:255',
        ]);

        $manajemen_asset->update($validated);

        return redirect()
            ->route('manajemen-asset.index')
            ->with('success', 'Asset berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('manajemen-asset.index')->with('success', 'Asset berhasil dihapus');
    }
}
