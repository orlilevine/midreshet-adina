<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
public function purchases()
{
$user = auth()->user();
$purchases = Purchase::where('user_id', $user->id)->with('shiur')->get();

return view('user.purchases', compact('purchases'));
}
}
