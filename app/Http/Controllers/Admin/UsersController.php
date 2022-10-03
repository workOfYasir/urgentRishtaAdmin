<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $users = User::with('userPlan')->get();
        $plans = Plan::all();
        return view('admin.users.index', compact('users','plans'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $user = User::create($request->all());
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $user->update($request->all());
        // $roles = $request->input('roles') ? $request->input('roles') : [];
        // $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $user->load('userPlan');
        $plans = Plan::all();
        return view('admin.users.show', compact('user','plans'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }
        User::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

    public function addUserSubscription(Request $request)
    {

       $user = User::find($request->user_id);

       $user->userPlan()->sync([$request->plan_id,$request->plan_id,$request->plan_id]);

        return redirect()->back(); 
    }
    public function forgotPasswordEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        return response()->json($user->email,200);

    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $user->update(['password'=>$request->password]);
        return 'ok';
    }

}
