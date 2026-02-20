<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoomBooking;
use Illuminate\Http\Request;

class MeetingRoomBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = MeetingRoomBooking::orderBy('created_at', 'desc')->paginate(15);
        $title = 'Peminjaman Ruang Rapat';
        return view('meeting-room-booking.index', compact('bookings', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Peminjaman Ruang Rapat';
        return view('meeting-room-booking.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer|min:1',
            'booking_date' => 'nullable|date',
            'booking_time' => 'nullable',
            'booking_purpose' => 'nullable|string|max:255',
        ]);

        MeetingRoomBooking::create($validated);

        return redirect()->route('meeting-room-booking.index')->with('success', 'Peminjaman ruang rapat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingRoomBooking $meetingRoomBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingRoomBooking $meetingRoomBooking)
    {
        $title = 'Peminjaman Ruang Rapat';
        return view('meeting-room-booking.edit', compact('meetingRoomBooking', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeetingRoomBooking $meetingRoomBooking)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer|min:1',
            'booking_date' => 'nullable|date',
            'booking_time' => 'nullable',
            'booking_purpose' => 'nullable|string|max:255',
        ]);

        $meetingRoomBooking->update($validated);

        return redirect()->route('meeting-room-booking.index')->with('success', 'Peminjaman ruang rapat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingRoomBooking $meetingRoomBooking)
    {
        //
    }
}
