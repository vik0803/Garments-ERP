<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GateEntry;
use PDF;
use App\User;
use App\YarnStore;

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
        $userinfo=User::all();
        $gateinfo=GateEntry::all();
        $yarninfo=YarnStore::all();
        return view('dashboard',compact('userinfo','gateinfo','yarninfo'));
    }

    public function reportPDF(Request $request)
    {
        $this->validate($request,[
          'month' => 'required'
        ]);

        if ($request->has('month')) {
          $data=GateEntry::whereRaw('MONTH(created_at) = ?',[$request->month])->get();
          if ($data->isNotEmpty()) {
            // $pdf = PDF::loadView('report', compact('data'));
            // return $pdf->stream('report.pdf');

            $pdf = PDF::loadView('report', compact('data'));
            return $pdf->download('report.pdf');
            redirect()->back();
          }
          session()->flash('Message','Report not available');
          return redirect('home');
        }


    }
}
