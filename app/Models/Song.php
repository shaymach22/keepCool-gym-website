<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'artist', 'user_id'];

    public function votes()
    {
        return $this->hasMany(SongVote::class);
    }
}
