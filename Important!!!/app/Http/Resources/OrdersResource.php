<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
     
            'id' => (string)$this->id,
            'attributes'=>[
    
                'user_id'=>$this->user_id,
                'session_id'=>$this->session_id,
                'status'=>$this->status,
                'total_price'=>$this->total_price,
                'created_at'=> $this->created_at,
                'updated_at'=>$this->updated_at,
                
            ],

            'relationships'=>[
'user'=>[
    'id'=> (string)$this->user->id,
    'name'=> $this->user->name,
    'username'=> $this->user->username,
    'is_admin'=> $this->user->is_admin,
    

],


'order_items'=>[
'id'=> (string)$this->order_items->id,
'order_id'=> $this->order_items->order_id,
'product_id'=> $this->order_items->product_id,
'amount'=>$this->order_items->amount,
'order_price'=>$this->order_items->order_price

]


                ]
    
            ];
    }
}
