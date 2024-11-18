<?php

namespace App\Http\Controllers;

use App\Models\KursusModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {        
        $list_kursus = KursusModel::all();
        return view('user.home', [
            'list_kursus' => $list_kursus
        ]);
    }

    public function kursus()
    {
        return view('kursus');
    }
}
