<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'accountId',
        'accountType',
        'accountStatus',
        'accountNumber',
        'accountRef',
        'bankCode',
        'bankName',
        'currency',
        'country',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
