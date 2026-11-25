<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Subscription::create([
            'user_id' => Auth::id(),
            'plan_name' => $validated['plan_name'],
            'price' => $validated['price'],
        ]);

        return redirect('/offres')->with('success', 'You subscribed to the ' . $validated['plan_name'] . ' plan!');
    }
}
