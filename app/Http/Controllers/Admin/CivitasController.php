<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CivitasController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard')->with('info', 'Modul Civitas sedang dalam pengembangan.');
    }
}
