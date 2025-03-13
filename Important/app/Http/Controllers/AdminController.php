<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

public function orders(User $user){

return   Order::where('user_id',$user->id)->with('user','product')->get();  



}







}
