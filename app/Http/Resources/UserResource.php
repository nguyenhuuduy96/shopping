<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BillResource;
use App\Http\Resources\Decentralization;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['name'=>$this->name,
                 'phone'=>$this->phone,
                 'bills'=>  BillResource::collection($this->bills), 
                 'is_active'=> new Decentralization($this->decentralization)
            ];
    }
}
