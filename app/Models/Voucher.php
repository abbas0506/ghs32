<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'amount',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'fees', 'voucher_id', 'student_id');
    }
    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function sumOfPaidAmount()
    {
        return $this->fees->sum('paid_amount');
    }
    public function isOpen()
    {
        if ($this->due_date->gte(today()))
            return true;
        else
            return false;
    }
}
