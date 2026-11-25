<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\SongVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $songs = Song::withCount('votes')->orderByDesc('votes_count')->get();

        return view('playlist.index', ['songs' => $songs]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
        ]);

        Song::create([
            'title' => $validated['title'],
            'artist' => $validated['artist'],
            'user_id' => Auth::id(),
        ]);

        return redirect('/playlist');
    }

    public function vote(Song $song)
    {
        $existingVote = SongVote::where('song_id', $song->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingVote) {
            $existingVote->delete(); // toggle off (un-vote)
        } else {
            SongVote::create([
                'song_id' => $song->id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect('/playlist');
    }
    public function destroy(Song $song)
    {
    if ($song->user_id !== Auth::id()) {
        abort(403, 'You can only delete your own songs.');
    }

    $song->delete();

    return redirect('/playlist');
    }
}