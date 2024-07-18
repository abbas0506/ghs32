<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'father',
        'phone',
        'adddress',
        'bise_name',
        'rollno',
        'obtained',
        'total',
        'pass_year',
        'medium',       //english / urdu
        'group_id',     //applied for
        'objection',
        'fee_paid',
        'paid_at',
        'concession',

        'grade_id',

    ];

    protected $dateFormat = 'Y-m-d';
    protected $dates = ['paid_at'];

    public function clas()
    {
        return $this->belongsTo(Clas::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function status()
    {
        $status = '';    //under process
        if ($this->objection != null) $status = $this->objection; //objection over
        elseif ($this->fee_paid != null) $status = 'finalized';   //fee paid
        return $status;
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeUnderprocess($query)
    {
        return $query->whereNull('objection')->whereNull('fee_paid');
    }
    public function scopeObjectioned($query)
    {
        return $query->whereNotNull('objection');
    }
    public function scopeFeepaid($query)
    {
        return $query->whereNotNull('fee_paid');
    }
    public function scopeRecentlyPaid($query)
    {
        return $query->whereDate('paid_at', today());
    }

    public function obtainedPercentage()
    {
        return round($this->obtained / $this->total * 100, 2);
    }
}
