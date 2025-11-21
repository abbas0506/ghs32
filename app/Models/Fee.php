<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'voucher_id',
        'paid_amount',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
