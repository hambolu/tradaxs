<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'unique_id'=> $this->unique_id,
            'username'=> $this->username,
            'email_verified_at'=> $this->email_verified_at,
            'role' => $this->role,
            'account' =>[
                'id' => $this->account->id ?? '',
                'accountId' => $this->account->accountId ?? '',
                'accountStatus' => $this->account->accountStatus ?? '',
                'accountNumber' => $this->account->accountNumber ?? '',
                'accountRef' => $this->account->accountRef ?? '',
                'bankName' => $this->account->bankName ?? '',
                'accountBalance' => $this->account->accountBalance ?? ''
            ]
        ];
    }
}
