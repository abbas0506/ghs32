<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',    //section label A, B, C
        'user_id',
        'is_open',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testAllocations()
    {
        return $this->hasMany(TestAllocation::class);
    }
    public function allocations()
    {
        return $this->belongsToMany(Allocation::class, 'test_allocations', 'test_id', 'allocation_id')
            ->withTimestamps(); // Include timestamps if present
    }

    public function scopeCombined($query)
    {
        return $query->whereNull('user_id');
    }
    public function scopeIndividual($query)
    {
        return $query->whereNotNull('user_id');
    }
}
