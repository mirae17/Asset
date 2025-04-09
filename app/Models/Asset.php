<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use App\Models\Family;
use App\Models\User;


class Asset extends Model
{
    public $table = 'asset';
    
    protected $fillable = [
        'type',
        'user_id',
        'address',
        'date',
        'value',
    ];

    use HasFactory;

    public function familyMember()
    {
        return $this->belongsTo(Family::class, 'assigned_to_family_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
