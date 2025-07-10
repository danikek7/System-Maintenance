<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ParameterController extends Controller
{
    public function index()
    {
        return view('admin.parameter');
    }
}
