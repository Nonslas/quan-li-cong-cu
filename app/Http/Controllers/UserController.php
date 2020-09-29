<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = new User;
        $user->fill($input);
        $user->password = Hash::make($input['password']);
        $user->save();
        $user->syncRoles($request->roles);
        return redirect('/users');
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
    public function edit(int $id)
    {
    	$user = User::find($id);
    	$roles = Role::all();

        // convert object to array
        $userRoles = json_decode(json_encode($user->getRoleNames()));

        return view('users.edit', [
        	'roles' => $roles,
        	'user' => $user,
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->fill($data);

        if (!empty($data['password'])) {
        	$user->password = Hash::make($data['password']);
        }

        $user->save();

        if ($user->can('manage-role')) {
            $user->syncRoles($request->roles);
        }

        // $role = RoleUser::where('user_id', $id)->update(['role_id' => $data['role_id']]);

        // dd($user);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	User::destroy($id);
    }
}
