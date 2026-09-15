<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard')->with('info', 'Modul Beasiswa sedang dalam pengembangan.');
    }
}
