<?php

namespace App\Http\Controllers;

use App\GateEntry;
use Illuminate\Http\Request;

class GateEntryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GateEntry::paginate(10);
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
          'category' => 'required|string',
          'gateIn' => 'required|sometimes|integer|nullable',
          'gateOut' => 'nullable|integer',
          'gatePass' => 'nullable|integer'
        ]);

        return GateEntry::create([
          'category' => $request->category,
          'gateIn' =>$request->gateIn,
          'gateOut' => $request->gateOut ?: 0,
          'gatePass' => $request->gatePass ?: 0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GateEntry  $gateEntry
     * @return \Illuminate\Http\Response
     */
    public function show(GateEntry $gateEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GateEntry  $gateEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(GateEntry $gateEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GateEntry  $gateEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info=GateEntry::findOrFail($id);

        $this->validate($request, [
          'category' => 'required|string',
          'gateIn' => 'required|sometimes|integer|nullable',
          'gateOut' => 'sometimes|integer',
          'gatePass' => 'sometimes|integer'
        ]);

        $info->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GateEntry  $gateEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteinfo=GateEntry::findOrFail($id);
        $deleteinfo->delete();
    }

    public function getGateEntry()
    {
        return GateEntry::paginate(10);
    }
}
