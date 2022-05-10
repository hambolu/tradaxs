<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'BTC',
        'ETH',
        'BCH',
        'BSV',
        'BTG',
        'LTC',
        'BNB',
        'USDT'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class,'m_id');
    // }
}
