<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $table = 'transactions';

    protected $fillable = [
        'm_id',
        'amount',
        'currency',
        'fees',
        'price',
        'currency_symbol',
        'transfer_to',
        'transfer',
        'receive_from',
        'swapamount',
        'swapfrom',
        'swapto',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'m_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
