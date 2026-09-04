<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Nantinya di sini kamu bisa mengambil data dari database 
        // untuk ditampilkan sebagai statistik (misal: total berita, total beasiswa).
        // Untuk sekarang, kita langsung tampilkan halaman view-nya saja.
        
        return view('admin.dashboard');
    }
}