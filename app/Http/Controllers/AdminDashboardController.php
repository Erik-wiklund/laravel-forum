<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
   public function home()
   {
      $users = User::all()->count();
        return view('admin.pages.home',compact(['users']));
   }
}