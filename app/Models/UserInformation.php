<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'user_informations';
    protected $fillable = [
        'user_id',
        'photo',
        'document',
        'first_name',
        'last_name',
        'email',
        'country',
        'street_address',
        'city',
        'region',
        'postal_code',
    ];
}


