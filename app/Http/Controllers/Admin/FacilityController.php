<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard')->with('info', 'Modul Fasilitas sedang dalam pengembangan.');
    }
}
