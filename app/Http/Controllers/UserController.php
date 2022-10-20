<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\SuccessRegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $redirectTo = '/';

    // function __construct()
    // {
    //      $this->middleware('role:admin', ['only' => ['index']]);
    //      $this->middleware('permission:delete-users', ['only' => ['destroy']]);
        
    // }

    public function index()
    {
        //
        if(Auth::user()->roles=='admin'){
        $data = User::all();
        return response()->json($data); 
        }
        else{
            abort(403);
        }
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
        //
        $user=User::create($request ->except("roles"));
        $user->assignRole($user['roles']);
        $user->notify(new SuccessRegisterNotification($user));

        return response()->json($user);
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
        return User::findOrfail($id);

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
    public function update(UpdateUserRequest $request,User $user)
    {
        //
        // $user = User::findOrfail($id);   

        if(Auth::user()->roles=='admin'){
            $user->update($request->all());
        return new UserResource($user);
        $user->assignRole($user['roles']);
        

        }
        else if(Auth::user()->user_id === $user->user_id){
            return tap($user)->update($request->except('roles'));
        }
        else{
            abort(403);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrfail($id);
        $user->delete();
        return response('Delete User: '. $id,204);
    }
}
