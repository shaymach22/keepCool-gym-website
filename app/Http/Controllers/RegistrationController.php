<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
     public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required|integer|min:1|max:120',
            'training_focus' => 'nullable|string',
        ]);

        Registration::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        if ($validated['age'] < 15) {
            return redirect('/book-coach');
        }

        return redirect('/offres')->with('success', 'Registration complete! Choose your plan below.');
    }
}
