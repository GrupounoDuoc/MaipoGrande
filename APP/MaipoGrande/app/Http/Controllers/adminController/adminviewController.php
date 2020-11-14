<?php


namespace App\Http\Controllers\adminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminviewController extends Controller
{
     public function ViewPanelAdmin()
    {
        return view('admin');
    }
}
