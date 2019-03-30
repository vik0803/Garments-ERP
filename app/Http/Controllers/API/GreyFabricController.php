<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GreyFabric;

class GreyFabricController extends Controller
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
        return GreyFabric::paginate();
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
          'fabric_content' => 'required',
          'material' => 'required',
          'quantity' => 'required',
          'width' => 'required',
          'weight' => 'required',
          'useinfo' => 'required',
          'care' => 'required'
        ]);

        return GreyFabric::create($request->all());
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
        $updateinfo=GreyFabric::findOrFail($id);

        $this->validate($request, [
          'fabric_content' => 'required',
          'material' => 'required',
          'quantity' => 'required',
          'width' => 'required',
          'weight' => 'required',
          'useinfo' => 'required',
          'care' => 'required'
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
        $deleteinfo=GreyFabric::findOrFail($id);
        $deleteinfo->delete();
    }

    public function searchGreyFabric(Request $request){

        if ($search = $request->get('query')) {

            return GreyFabric::where('fabric_content','like','%'.$search.'%')
                            ->orWhere('quantity','like','%'.$search.'%')
                            ->orWhere('width','like','%'.$search.'%')
                            ->orWhere('care','like','%'.$search.'%')
                            ->paginate(5);

        }else {
          return GreyFabric::paginate();
        }
    }

}
