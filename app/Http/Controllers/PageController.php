<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function attendanceScanner()
    {
        return view('page.attendance-scanner');
    }

    public function survey()
    {
        return view('page.survey');
    }
}
