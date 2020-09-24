<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StatusResource;
class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id'=>$this->id,
                'bill_code'=>$this->bill_code,
                'total'=>$this->total,
                'status'=>new StatusResource($this->status),
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at
            ];
    }
}
