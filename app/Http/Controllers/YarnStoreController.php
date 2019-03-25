<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\YarnStore;

class YarnStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'color' => 'required|string',
        'fiber_content' => 'required|sometimes|string|nullable',
        'weight' => 'required|nullable|string',
        'yardageORball' => 'required|nullable|string',
        'gauge' => 'required|string',
        'care' => 'required|string'
      ]);

      return YarnStore::create($request->all());
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $updateinfo=YarnStore::findOrFail($id);

        $this->validate($request, [
          'color' => 'required|string',
          'fiber_content' => 'required|sometimes|string|nullable',
          'weight' => 'required|nullable|string',
          'yardageORball' => 'required|nullable|string',
          'gauge' => 'required|string',
          'care' => 'required|string'
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
        $deleteinfo=YarnStore::findOrFail($id);
        $deleteinfo->delete();
    }

    public function getYarnStore()
    {
        return YarnStore::paginate(15);
    }
}
