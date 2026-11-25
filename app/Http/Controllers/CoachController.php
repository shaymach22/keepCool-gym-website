<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CoachController extends Controller
{
    public function index()
    {
         $coaches = Coach::all();

        return view('coaches.index', ['coaches' => $coaches]);
    }
    public function create()
    {
    return view('coaches.create');
    }
    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'specialty' => 'required|string|max:255',
        'bio' => 'required|string',
        'photo' => 'nullable|image|max:2048',
        'phone' => 'nullable|string|max:20',
    ]);

    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('coaches', 'public');
    }

    Coach::create($validated);

    return redirect('/coaches');
    }
    public function edit(Coach $coach)
   { 
    return view('coaches.edit', ['coach' => $coach]);
   }
   public function update(Request $request, Coach $coach)
   {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'specialty' => 'required|string|max:255',
        'bio' => 'required|string',
        'photo' => 'nullable|image|max:2048',
        'phone' => 'nullable|string|max:20',
    ]);
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('coaches', 'public');
    }

    $coach->update($validated);

    return redirect('/coaches');
   }
   public function destroy(Coach $coach)
   {
    $coach->delete();

    return redirect('/coaches');
   }
   public function removePhoto(Coach $coach)
   {
    if ($coach->photo) {
        Storage::disk('public')->delete($coach->photo);
        $coach->update(['photo' => null]);
    }

    return redirect('/coaches');
    }
}
