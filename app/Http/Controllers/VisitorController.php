<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
{
    $ip = $request->ip();
    $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
    $visitor->increment('visits');
    $visitor->save();

    $visitors = Visitor::count();

    return view('forum.index', compact('visitors'));
}
}
