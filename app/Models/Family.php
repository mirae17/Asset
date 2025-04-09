<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Asset;
use App\Models\User;

class Family extends Model
{
    use HasFactory, Notifiable;

    public $table = 'family';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'relation',
        'assigned_by_user_id',
        'password',
       
    ]; 

   

   
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_by_user_id');
    }

}
