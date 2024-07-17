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
        'concession',

        'grade_id',

    ];



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
        $status = 0;    //under process
        if ($this->objection != null) $status = 1; //objection over
        elseif ($this->fee != null) $status = 2;   //fee paid
        return $status;
    }

    public function scopeToday($query)
    {
        return $query->whereDate('updated_at', today());
    }

    public function scopeUnderprocess($query)
    {
        return $query->whereNull('objection')->whereNull('fee');
    }
    public function scopeObjectioned($query)
    {
        return $query->whereNotNull('objection');
    }
    public function scopeFeepaid($query)
    {
        return $query->whereNotNull('fee');
    }
    public function scopeMedical($query)
    {
        return $query->where('group_id', 1);
    }
    public function scopeEngg($query)
    {
        return $query->where('group_id', 2);
    }
    public function scopeIcs($query)
    {
        return $query->where('group_id', 3);
    }
    public function scopeArts($query)
    {
        return $query->where('group_id', 4);
    }
    public function scopeGroup($query, $id)
    {
        return $query->where('group_id', $id);
    }
}
