<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();

        if (Auth::check()) {
            // User is logged in, delete the visitor record if it exists
            Visitor::where('ip_address', $ip)->delete();
        } else {
            // User is not logged in
            $visitor = Visitor::where('ip_address', $ip)->first();

            if (!$visitor) {
                // Create a new visitor record only if it doesn't exist
                Visitor::create(['ip_address' => $ip, 'visits' => 1]);
            }
        }

        $visitors = Visitor::count();

        // You can return the visitor count to any view that needs it
        return view('forum.index', compact('visitors'));
    }
}
