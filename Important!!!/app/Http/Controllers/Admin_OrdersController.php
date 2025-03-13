<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Total_Revenue;
use App\Http\Traits\HttpResponses;
class Admin_OrdersController extends Controller
{
    
use HttpResponses,Total_Revenue;


public function orders(){

    $orders=Order::with('user')->orderBy('created_at','asc')
->filter(request(['user','total_price']))->get();

$num_of_paid_orders=Order::where('status','paid')->count();
$num_of_orders=Order::count();
$total_revenue=$this->total_revenue();

$data=[
'orders'=>$orders,
'num_of_orders'=>$num_of_orders,
'num_of_paid_orders'=>$num_of_paid_orders,
'total_revenue'=>$total_revenue,
];

return  $this->success($data,"OK");  
}







public function order_items(Order $order){
    return  $this->success(Order_items::where('order_id',$order->id)->get(),'OK');
        
    
    } 
    
}
