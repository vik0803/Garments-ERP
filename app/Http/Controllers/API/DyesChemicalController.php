<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DyeChemical;

class DyesChemicalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DyeChemical::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'color' => 'required',
          'classification' => 'required',
          'dyes' => 'required',
          'concentration' => 'required',
          'bulk_density' => 'required'
        ]);

        return DyeChemical::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateinfo=DyeChemical::findOrFail($id);

        $this->validate($request, [
          'color' => 'required',
          'classification' => 'required',
          'dyes' => 'required',
          'concentration' => 'required',
          'bulk_density' => 'required'
        ]);

        $updateinfo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $deleteinfo=DyeChemical::findOrFail($id);
      $deleteinfo->delete();
    }

    public function searchDyesChemical(Request $request){

        if ($search = $request->get('query')) {

            return DyeChemical::where('color','like','%'.$search.'%')
                            ->orWhere('classification','like','%'.$search.'%')
                            ->orWhere('dyes','like','%'.$search.'%')
                            ->orWhere('concentration','like','%'.$search.'%')
                            ->orWhere('bulk_density','like','%'.$search.'%')
                            ->paginate(5);

        }else {
          return DyeChemical::paginate();
        }
    }
}
