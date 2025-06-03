<?php

namespace App\Http\Controllers;

use App\Models\Attendant;
use Illuminate\Http\Request;

class AttendantController extends Controller
{
    /**
     * Display a listing of the attendants.
     */
    public function index()
    {
        $attendants = Attendant::latest()->get();
        return view('attendant.index', compact('attendants'));
    }

    /**
     * Store a newly created attendant in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Attendant::create($validated);

        return redirect()->route('attendant.index')->with([
            'success' => 'Attendant created successfully!',
            'icon' => 'success'
        ]);
    }

    /**
     * Update the specified attendant in storage.
     */
    public function update(Request $request, $id)
    {
        $attendant = Attendant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $attendant->update($validated);

        return redirect()->route('attendant.index')->with([
            'success' => 'Attendant updated successfully!',
            'icon' => 'success'
        ]);
    }

    /**
     * Remove the specified attendant from storage.
     */
    public function destroy($id)
    {
        $attendant = Attendant::findOrFail($id);
        $attendant->delete();

        return redirect()->route('attendant.index')->with([
            'success' => 'Attendant deleted successfully!',
            'icon' => 'success'
        ]);
    }
}
