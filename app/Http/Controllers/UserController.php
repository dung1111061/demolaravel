<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the sharks
        $users = User::paginate(10);
        // load the view and pass the sharks
        return View::make('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the view and pass the sharks
        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->updateInsert( null, $request );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // load the view and pass the sharks
        return View::make('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // load the view and pass the sharks
        return View::make('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        return $this->updateInsert($user,$request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    	$user->destroy();
        return redirect()->route('user.show');
    }

    public function search()
    {
        return 'as';
    }
    private function updateInsert(User $user = null,UserRequest $request)
    {
        if($user)
            $user->update( $request->all() );
        else
            $user = new User( $request->all() );
        if($request->file('avatar')){
            $path = $request->file('avatar')->store('avatar');
            $user->avatar = $path;
        }
        if($request->has('switch_leader')){
            $user->is_leader = abs(1-$user->is_leader);
        }   
        if( $user->save() ){ 
            if($request->has('projects')){
                $user->projects()->sync($request->input('projects'));
            }
            return redirect( route('user.index') );
        }  else {
            return back()->withInput();
        }
    }
}
