<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MiddleSize extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['price'=>$this->price,
                'stock'=>$this->stock,
                'middle_id'=>$this->id,
                'size'=>$this->size
                ];
    }
}
