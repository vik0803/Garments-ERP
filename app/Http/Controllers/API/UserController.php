<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
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
      if (Gate::allows('isAdmin')) {
          return User::paginate();
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:100|unique:users',
          'type'=>'required',
          'password' => 'required|min:6'
        ]);

        return User::create([
          'name' => $request->name,
          'email' => $request->email,
          'type' =>$request->type,
          'password' => Hash::make($request['password'])
        ]);
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
        $updateuser=User::findOrFail($id);

        $this->validate($request, [
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:100|unique:users,email,'.$updateuser->id,
          'type' => 'required',
          'password' => 'sometimes|min:6'
        ]);
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $updateuser->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $deleteuser=User::findOrFail($id);
        $deleteuser->delete();
    }
}
