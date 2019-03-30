<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GateEntry;
use PDF;
use App\User;
use App\YarnStore;
use App\GreyFabric;
use App\FinishFabric;
use App\DyeChemical;

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
        $greyinfo=GreyFabric::all();
        $finishinfo=FinishFabric::all();
        $dyesinfo=DyeChemical::all();
        return view('dashboard',compact('userinfo','gateinfo','yarninfo','greyinfo','finishinfo','dyesinfo'));
    }

    public function reportPDF(Request $request)
    {
        $this->validate($request,[
          'month' => 'required'
        ]);

        if ($request->has('month')) {
          $gedata=GateEntry::whereMonth('created_at',$request->month)->get();
          $ysdata=YarnStore::whereMonth('created_at',$request->month)->get();
          $gfdata=GreyFabric::whereMonth('created_at',$request->month)->get();
          $ffdata=FinishFabric::whereMonth('created_at',$request->month)->get();
          $dcdata=DyeChemical::whereMonth('created_at',$request->month)->get();
          if ($gedata->isNotEmpty() || $ysdata->isNotEmpty() || $gfdata->isNotEmpty() || $ffdata->isNotEmpty() || $dcdata->isNotEmpty()) {
            // $pdf = PDF::loadView('report', compact('data'));
            // return $pdf->stream('report.pdf');

            $pdf = PDF::loadView('report', compact('gedata','ysdata','gfdata','ffdata','dcdata'));
            return $pdf->download('report.pdf');
            redirect()->back();
          }
          session()->flash('Message','Report not available');
          return redirect('home');
        }


    }
}
