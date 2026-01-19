<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Screenshot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image_path', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function isLikedByAuthUser()
    {
        if (!Auth::check()) return false;
        return $this->likes->where('user_id', Auth::id())->count() > 0;
    }
}
