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
        ]);

        $data = $request->all();
        if (array_key_exists('kode', $validated)) {
            $data['kode'] = $validated['kode'];
        }

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
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        dd($asset->id);
        $asset = Asset::find($asset->id);
        dd($asset);
        $asset->delete();

        return redirect()->route('manajemen-asset.index')->with('success', 'Asset berhasil dihapus');
    }
}
