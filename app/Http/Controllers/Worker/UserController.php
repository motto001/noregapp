<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }
  return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
 //print_R($roles);

        $roles = $roles->pluck('label', 'name');
     //  print_R(compact('roles'));
//echo $roles[1]['root'];
        return view('admin.users.create', compact('roles'));
    }
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    { 
        //$user = Auth::user();
        if(Auth::check() && Auth::user()->hasRole('manager')) {
            $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required', 'roles' => 'required']);

            $data = $request->except('password');
            $data['password'] = bcrypt($request->password);
            $user = User::create($data);

            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }

            Session::flash('flash_message', 'User added!');

            return redirect('admin/users');
        }else{
            return response('Jogosultság hiba!');
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        /*
     $jog = DB::table('role_user')
            ->join('roles', 'roles.id', '=', 'role_user.user_id')
             ->where('role_user.user_id','=',$user->id)
            ->get();

     $result = $jog->toArray();
    print_r($jog);*/
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin.users.edit', compact('user', 'roles', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int      $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'roles' => 'required']);

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        Session::flash('flash_message', 'User updated!');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect('admin/users');
    }
}
