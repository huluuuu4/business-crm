<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Models\Note; // Ensure Note model is imported

class NoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request, Deal $deal)
    {
        // 1. Validate the request
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        // 2. Create the note using the relationship
        $deal->notes()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id(), // Associate with the logged-in user
        ]);

        // 3. Redirect back to the deal page with a success message
        return redirect()->route('deals.show', $deal)
                         ->with('success', 'Note added successfully.');
    }
}