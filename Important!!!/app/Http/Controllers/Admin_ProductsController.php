<?php

namespace App\Http\Controllers;

use App\Http\Traits\HttpResponses;
use App\Http\Traits\Total_Revenue;
use App\Models\Order_items;
use App\Models\Product;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_ProductsController extends Controller
{
    use HttpResponses,Total_Revenue;
    public function index(){
 $total_revenue=$this->total_revenue();
  $products=Product::select("products.*","categories.name as category_name" )->leftJoin('categories','categories.id','products.category_id')->paginate(5);
 $total_products=$products->count();
 $low_stock=$products->filter(function($product){
return $product->amount <10; 
 })->count();



 $top_selling = Order_items::selectRaw('products.name, COUNT(order_items.id) as number')  
->rightJoin('products', 'order_items.product_id', '=', 'products.id')  
->groupBy('products.name')  
->orderBy('number', 'desc')  
->get();  

$data=[
   
   "total_revenue"=>$total_revenue,
   "total_products"=>$total_products,
   "low_stock"=>$low_stock,
    "top_selling"=>$top_selling,
    "products"=> $products,
];

return $this->success($data,"OK");

    }






}
