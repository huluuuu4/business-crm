<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Deal; // <-- Make sure this line is here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DealController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        return view('deals.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'stage' => 'required|string',
            'expected_close_date' => 'nullable|date',
        ]);

        $customer->deals()->create($validated);

        return redirect()->route('customers.show', $customer)
                         ->with('success', 'Deal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $deal->load('customer', 'notes.user');
        
        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'stage' => 'required|string',
            'expected_close_date' => 'nullable|date',
        ]);

        $deal->update($validated);

        return redirect()->route('customers.show', $deal->customer)
                         ->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        Gate::authorize('is-admin'); 
        $customer = $deal->customer;
        $deal->delete();

        return redirect()->route('customers.show', $customer)
                         ->with('success', 'Deal deleted successfully.');
    }
}