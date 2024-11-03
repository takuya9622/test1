<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function getGenderAttribute($value){
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        return $genders[$value] ?? '不明';
    }

    public function scopeKeywordSearch($query, $keyword){
        if (!empty($keyword)) {
            $query->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
        }
    }

    public function scopeGenderSearch($query, $gender){
        if (!empty($gender)) {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id){
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date){
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }
}



/*if ($request->filled('keyword')) {
            $query->where('name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }*/
