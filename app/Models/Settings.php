<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'convertingRate',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'m_id');
    // }
}
