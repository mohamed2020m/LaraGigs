<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'email',
        'logo',
        'website',
        'tags',
        'description',
        'user_id'
    ];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orwhere('description', 'like', '%' . request('search') . '%')
            ->orwhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship with Listings
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
