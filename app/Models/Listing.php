<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Listing extends Eloquent
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'company',
        'name',
        'location',
        'email',
        'website',
        'tags',
        'logo',
        'description'
    ];

    public function scopeFilter($query, array $filters){
        // dd(request());
        if($filters['taggy'] ?? false){
            $query->where('tags', 'like', '%'.request('taggy').'%');
        }
        if($filters['search'] ?? false){
            $query->where('tags', 'like', '%'.request('search').'%')
            ->orWhere('description', 'like', '%'.request('search').'%')
            ->orWhere('title', 'like', '%'.request('search').'%')
            ->orWhere('company', 'like', '%'.request('search').'%')
            ->orWhere('location', 'like', '%'.request('search').'%');
        }
        
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
