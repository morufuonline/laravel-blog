<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "title", "body"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopePoster(Builder $query): void
    {
        $query->where('user_id', auth()->id());
    }

}
