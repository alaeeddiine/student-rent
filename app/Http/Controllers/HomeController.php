<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Announcement;
use App\Models\Contact;
use App\Models\Student;
use App\Models\Owner;


class HomeController extends Controller
{
    public function index()
    {
    $recentProperties = Property::latest()->take(3)->get(); 
    return view('home', compact('recentProperties'));
    }
}