<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Http\Resources\OneProductResource;
use App\Http\Resources\ProductsResource;
use App\Http\Traits\HttpResponses;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkoutprocess(){
        
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $products=Product::all(); 
       $LineItems=[];
       $total_price=0; 
       foreach($products as $product){
$total_price +=$product->price;


        $LineItems[]= [
            
                'price_data' => [
                  'currency' => 'usd',
                  'product_data' => [
                    'name' => $product->name,
                  ],
                  'unit_amount' => $product->price *100,
                ],
                'quantity' => 1,
              
        ];



       }
        $checkout_session = $stripe->checkout->sessions->create([
          'line_items' => $LineItems,
          'mode' => 'payment',
          'success_url' => "http://127.0.0.1:8000/checkoutprocess/success?session_id={CHECKOUT_SESSION_ID}",
          'cancel_url' => "http://127.0.0.1:8000/checkoutprocess/cancel",
        
        ]);
        
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
        $order=new Order();
        $order->status="unpaid";    
        $order->total_price=$total_price; 
        $order->session_id=$checkout_session->id;
        $order->user_id=1;
        $order->product_id=
        $order->save();
        

        return redirect($checkout_session->url);



    }

public function success_stripe(Request $request){
    
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    $sessionId=$request->get('session_id');
 try{
    $session = $stripe->checkout->sessions->retrieve($sessionId);
    if(!$session){
 
    throw new NotFoundHttpException;
 
    } 
     
    // $customer = $stripe->customers->retrieve($session->customer_details->name);
    $customer = $session->customer_details->name;
 $order= Order::where('session_id',$session->id)->where('status','unpaid')->first();
 
 if(!$order){
 
     throw new NotFoundHttpException();
 }
 $order->status='paid';
 $order->save();
    return view("success" ); 

 }catch(\Exception $e){
throw new NotFoundHttpException();


 }
 
   
}


public function cancel(){



}


    public function index()
    {
        
         return ProductsResource::Collection(
            Product::filter(request(['price','search','category']))->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {


$request->validated($request->all());

$product=Product::create([
'name'=> $request->name,
'description'=> $request->description,
'price'=>$request->price,
'amount'=>$request->amount,
'image' => $request->file('image')->store('images','public'),
'package_insert'=> $request->file('package_insert')->store('Package_Inserts','public'),
'category_id'=>'1',
'company_id'=>'1'


]);

return new OneProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

     //return view('welcome',['product'=> $product]);


     return new OneProductResource($product);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        


    }


    public function update(Request $request,Product $product)
    {
        
// $validatedData=$request->validate([
//     'name'=>['string'],
//     'description'=>['string'],
//     'price' => ['numeric', 'between:0,99999'],
// 'amount' => ['numeric', 'between:0,99999'],
// 'image'=>['string','mimes:jpeg,png'],
//     'package_insert'=>['string','mimes:pdf','max:2048']
// ]);

        


//     $product->update($validatedData);

//     return new ProductsResource($product);


        $validatedData = $request->validate([
        'name' => ['string'],
        'description' => ['string'],
        'price' => ['numeric', 'between:0,9999999999'],
        'amount' => ['numeric', 'between:0,9999999999'],
        'image' => ['nullable', 'file', 'mimes:jpeg,png'],
        'package_insert' => ['nullable', 'file', 'mimes:pdf'],
    ]);

    // Handle file uploads
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $validatedData['image'] = $imagePath;
    }

    if ($request->hasFile('package_insert')) {
        $packageInsertPath = $request->file('package_insert')->store('package_inserts', 'public');
        $validatedData['package_insert'] = $packageInsertPath;
    }

    // Update the product
    $product->update($validatedData);

    return response($product);



        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete();
        return $this->success('','The product has been deleted',200);


    }
    public function checkout(){


        
    }
}
