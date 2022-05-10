<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = 'merchants';

    protected $fillable = [
        'm_id',
        'offer_type',
        'amount_max',
        'amount_max',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'m_id');
    }
}
