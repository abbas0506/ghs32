<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'name',
        'father_name',
        'bform',
        'gender',
        'phone',
        'address',
        'dob',
        'identification_mark',
        'caste',
        'is_orphan',
        'guardian_relation',
        'guardian_name',
        'guardian_cnic',
        'mother_cnic',
        'guardian_profession',
        'guardian_income',
        'grade',
        'group_id',
        'pass_year',
        'medium',
        'previous_school',
        'bise',
        'rollno',
        'obtained_marks',
        'total_marks',
        'status',
        'amount_paid',
        'payment_date',
        'payment_mehtod',
        'fee_concession',
        'rejection_note',
    ];

    protected $casts = [
        'dob' => 'date',
        'pass_year' => 'integer',
        'guardian_income' => 'integer',
        'grade' => 'integer',
        'obtained_marks' => 'integer',
        'total_marks' => 'integer',
        'amount_paid' => 'integer',
        'payment_date' => 'date',
        'fee_concession' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Optional: relationship to Group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function  objections()
    {
        return $this->hasMany(Objection::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeUnderprocess($query)
    {
        return $query->whereNull('objection')->whereNull('amount_paid');
    }
    public function scopeObjectioned($query)
    {
        return $query->whereNotNull('objection');
    }
    public function scopeFeepaid($query)
    {
        return $query->whereNotNull('amount_paid');
    }
    public function scopeRecentlyPaid($query)
    {
        return $query->whereDate('payment_date', today());
    }

    public function obtained_percentage()
    {
        return round($this->obtained_marks / $this->total_marks * 100, 2);
    }
}
