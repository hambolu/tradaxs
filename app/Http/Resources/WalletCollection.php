<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletCollection extends JsonResource
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
            'wallet' => [
                'id' => $this->id,
                'coin_type' => $this->coin_type,
                'privateKey'=> $this->uid,
                'address' => $this->address,
                'balance'=> $this->balance,
                'user_id'=> $this->user_id
            ],
        ];
    }
}
