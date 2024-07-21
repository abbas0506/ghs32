<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cnic',
        'can_borrow_books',

        //school tag
        'clas_id',
        'rollno',
    ];

    public function clas()
    {
        return $this->belongsTo(Clas::class);
    }
}
