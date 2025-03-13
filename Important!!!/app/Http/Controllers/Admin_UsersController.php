<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_UsersController extends Controller
{
    public function index(){
$year=now()->year;
   return     $new_users_by_month = User::selectRaw('  
        CASE   
            WHEN MONTH(created_at) IN (1, 2) THEN "Jan-Feb"  
            WHEN MONTH(created_at) IN (3, 4) THEN "Mar-Apr"  
            WHEN MONTH(created_at) IN (5, 6) THEN "May-Jun"  
            WHEN MONTH(created_at) IN (7, 8) THEN "Jul-Aug"  
            WHEN MONTH(created_at) IN (9, 10) THEN "Sep-Oct"  
            WHEN MONTH(created_at) IN (11, 12) THEN "Nov-Dec"  
        END AS month_range,  
        COUNT(*) as user_count  
    ')  
    ->whereYear('created_at', $year) // Filter by the current year  
    ->groupBy('month_range')  
    ->get();  
    

         $total_users=User::get();
         return $new_users_today=User::where(DB::raw('Day(created_at)'),now()->today())->get();

    }


    
    
}
