<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'asset_name'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'m_id');
    // }
}
