<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Return view for admin dashboard
        return view('admin.dashboard');
    }
}
