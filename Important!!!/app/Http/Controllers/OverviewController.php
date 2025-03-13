<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Models\Order_items;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\Total_Revenue;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    use HttpResponses,Total_Revenue;

    public function index(){
$total_sales=0;

$new_users=User::where(DB::raw('YEAR(created_at)'),now()->year())->count();
$order_items=Order_items::select('amount','price_order','created_at')->get();  
$products_count=Product::count();
$total_sales_per_month=[];
$category_percentage=Category::select('categories.name',DB::raw("count(order_items.product_id) as purchased_products"))->leftJoin('products','categories.id','products.category_id')
->leftJoin('order_items','products.id','order_items.product_id')->groupBy('categories.name')->get();
$total_sales=$this->total_revenue();



for($i=1;$i<=12;$i++){
    $money=0;
foreach($order_items as $order_item){
    $year= $order_item->created_at->year ;
    $month=$order_item->created_at->month ;

     
    if($year == now()->format('Y') && $month == $i)
         {$money+=$order_item->amount*$order_item->price_order;} 
        
         $total_sales_per_month[$i]=[
            'total_sales_per_month'=> $money
         ];


}
    
}




$data=[
'total_sales'=>$total_sales,
'total_sales_per_month'=> $total_sales_per_month,
'new_users'=>$new_users,
'products_count'=>$products_count,
'category_percentage'=>$category_percentage,
'conversion_rate'=>'12.5'

];


return $this->success($data,"Ok");




    }
}
