<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
       {
    // 1. Validate the form data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:20', // Add validation
        'message' => 'required|string',
    ]);
    
    $nameParts = explode(' ', $validated['name'], 2);
    $firstName = $nameParts[0];
    $lastName = $nameParts[1] ?? '';

    // 2. Create or find the customer, now including the phone number
    $customer = Customer::firstOrCreate(
        ['email' => $validated['email']],
        [
            'first_name' => $firstName, 
            'last_name' => $lastName,
            'phone_number' => $validated['phone_number'] // Save the phone number
        ]
    );

    // 3. Create a new deal for this customer
    $customer->deals()->create([
        'name' => 'Website Inquiry from ' . $validated['name'],
        'value' => 0,
        'stage' => 'Lead',
    ]);

    // 4. Create a note with the message content
    $latestDeal = $customer->deals()->latest()->first();
    if ($latestDeal) {
        $latestDeal->notes()->create([
            'body' => $validated['message'],
            'user_id' => 1, // Assumes a system user with ID 1 exists
        ]);
    }

    // 5. Redirect back with a success message
    return redirect()->route('home')
                     ->with('success', 'Thank you for your message! We will get back to you shortly.');
}
    }
}
