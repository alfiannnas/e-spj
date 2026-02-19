<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::orderBy('created_at', 'desc')->paginate(15);
        $title = 'Manajemen Kontrak';
        return view('contract.index', compact('contracts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Manajemen Kontrak';
        return view('contract.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'satuan_kerja' => 'required|string|max:255',
            'tanggal_sp' => 'required|date',
            'nama_pejabat_penandatangan' => 'required|string|max:255',
            'nama_penyedia' => 'required|string|max:255',
            'nama_paket_pengadaan' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'nilai_kontrak' => 'required|integer|min:0',
        ]);

        Contract::create($validated);

        return redirect()->route('contract.index')->with('success', 'Kontrak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        $title = 'Manajemen Kontrak';
        return view('contract.edit', compact('contract', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'satuan_kerja' => 'required|string|max:255',
            'tanggal_sp' => 'required|date',
            'nama_pejabat_penandatangan' => 'required|string|max:255',
            'nama_penyedia' => 'required|string|max:255',
            'nama_paket_pengadaan' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'nilai_kontrak' => 'required|integer|min:0',
        ]);

        $contract->update($validated);

        return redirect()->route('contract.index')->with('success', 'Kontrak berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contract.index')->with('success', 'Kontrak berhasil dihapus');
    }
}
