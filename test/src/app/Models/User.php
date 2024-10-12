<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
        $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('content', 'like', '%' . $keyword . '%');
        }
    }
    
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)) {
        $query->where('gender', $gender);
        }
    }

    public function scopeDateSearch($query, $created_at)
    {
        if (!empty($created_at)) {
        $query->where('created_at', $created_at);
        }
    }

    public function contacts(){ 
        return $this->hasMany('App\Models\Contact');
    }
}
