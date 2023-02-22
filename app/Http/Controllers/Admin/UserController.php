<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }


    public function create()
    {
        $data['roles'] = Role::all();

        return view('admin.users.create', [
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request);
        $before = User::where('status', 1)->latest()->first();
        if($before->code == null){
            $code = '1.'.date('d.m.Y').'.1';
        }else{
            $arr  = explode('.', $before->code);
            $id   = (int)$arr[0] + 1;
            $code = $id.'.'.date('d.m.Y').'.'.$id;
        }

        // dd($code);

        try {
            $input                  = $request->except(['_token', 'role', 'password']);
            $user                   = new User();
            $user->code             = $code;
            $user->status             = 1;
            $user->username         = Str::slug($request->name);
            $user->password         = Hash::make('Apti@123');
            $user->remember_token   = Str::random(8);
            $user->fill($input)->save();

            if($request->role == 0){
                $user->assignRole('guest');
            }else{
                $user->assignRole($request->role);
            }

            Alert::success('Success', 'User added successfully');
            return redirect()->route('users.index');
        } catch (Exception $error) {
            Alert::error('Error', $error->getMessage());
            return redirect()->route('users.index');
        }

    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        return view('admin.users.edit', [
            'data' => User::findOrFail($id),
            'roles' => Role::all()
        ]);

    }


    public function update(Request $request, $id)
    {
        // dd($request->role);
        try {
            $input  = $request->except(['_token', 'role', 'password']);
            $user = User::findOrFail($id);
            $user->fill($input)->save();

            if($request->role != 0){
                $user->syncRoles($request->role);
            }

            Alert::success('Success', 'User added successfully');
            return redirect()->route('users.index');
        } catch (Exception $error) {
            Alert::error('Error', $error->getMessage());
            return redirect()->route('users.index');
        }
    }


    public function destroy($id)
    {
        dd($id);
    }

    public function showTrashed(){
        return view('admin.users.trashed');
        // dd(User::onlyTrashed()->get());
    }
}