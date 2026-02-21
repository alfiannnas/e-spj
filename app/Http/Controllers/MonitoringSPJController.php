<?php

namespace App\Http\Controllers;

use App\Models\MonitoringSPJ;
use Illuminate\Http\Request;

class MonitoringSPJController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitoringSpjs = MonitoringSPJ::orderBy('created_at', 'desc')->paginate(15);
        $title = 'Monitoring SPJ';
        return view('monitoring-spj.index', compact('monitoringSpjs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Monitoring SPJ';
        return view('monitoring-spj.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'submitted_at' => 'nullable|date',
            'activity_date' => 'nullable|date',
            'division' => 'nullable|string|max:255',
            'mak_number' => 'nullable|string|max:255',
            'activity_name' => 'nullable|string|max:255',
            'rab' => 'nullable|integer|min:0',
            'realization' => 'nullable|integer|min:0',
            'pelaksana_approved_at' => 'nullable|date',
            'tu_approved_at' => 'nullable|date',
            'ppk_approved_at' => 'nullable|date',
            'finance_approved_at' => 'nullable|date',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        MonitoringSPJ::create($validated);

        return redirect()->route('monitoring-spj.index')->with('success', 'Data monitoring SPJ berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MonitoringSPJ $monitoringSPJ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonitoringSPJ $monitoringSPJ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonitoringSPJ $monitoringSPJ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonitoringSPJ $monitoringSPJ)
    {
        //
    }
}
