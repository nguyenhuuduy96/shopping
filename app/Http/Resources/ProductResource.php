<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'id'=>$this->id,
                'name'=>$this->name,
                'source'=>$this->source,
                'time_expired'=>$this->time_expired,
                'image'=>$this->firstImage,
                'price'=>$this->firstPrice
                ];
    }
}
