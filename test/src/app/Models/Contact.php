<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
    ];

    public function categories(){ //追記
        return $this->hasMany('App\Models\Category');
    }

    public function getGender()
    {
        // 仮にgenderが数値（1: 男性, 2: 女性）だと仮定
        if ($this->gender == 1) {
            return '男性';
        } elseif ($this->gender == 2) {
            return '女性';
        } elseif ($this->gender == 3) {
            return 'その他';
        }
    }

    public function scopeSearch($query) {

        $request = request();

        $query->when($request->name, function($q, $name) {
            $q->where('name', 'LIKE', '%' . $name . '%');
        })
        ->when($request->gender, function($q, $gender) {
            $q->where('gender', 'LIKE', '%' . $gender . '%');
        })
        ->when($request->category_id, function($q, $category_id) {
            $q->where('category_id', 'LIKE', '%' . $category_id . '%');
        })
        ->when($request->created_at, function($q, $created_at) {
            $q->where('created_at', 'LIKE', '%' . $created_at . '%');
        });

    }
}
