<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GateEntry;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function reportPDF(Request $request)
    {
        if ($request->has('month')) {
          $data=GateEntry::whereRaw('MONTH(created_at) = ?',[$request->month])->get();
          // $pdf = PDF::loadView('report', compact('data'));
          // return $pdf->stream('report.pdf');

          $pdf = PDF::loadView('report', compact('data'));
          return $pdf->download('report.pdf');
        }

        redirect()->back();






    }
}
