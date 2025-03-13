<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
     
        'id'=> (string)$this->id,
        'attributes'=>[

            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'amount'=>$this->amount,
            'category_id'=>$this->category_id,
            'image'=> $this->image,
            'created_at'=> $this->created_at,
            'updated_at'=>$this->updated_at,
            'company_id'=>$this->category_id,
            
            ]


        ];
    }
}
