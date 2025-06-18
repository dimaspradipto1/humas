<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['is_admin'] = false;
        $data['is_rektorat'] = false;
        $data['is_feb'] = false;
        $data['is_fst'] = false;
        $data['is_fikes'] = false;
        $data['is_users'] = true;
        $data['password'] = bcrypt($request->password);
        $data['remember_token']=Str::random(60);
        User::create($data);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $user= User::findOrfail($id);

       $user -> update([
            'is_admin' =>$request->has('is_admin') ? 1:0,
            'is_rektorat' => $request->has('is_rektorat') ? 1:0,
            'is_feb' => $request->has('is_feb') ? 1:0,
            'is_fst' => $request->has('is_fst') ? 1:0,
            'is_fikes' => $request->has('is_fikes') ? 1:0,
            'is_users' => $request->has('is_users') ? 1:0,
       ]);

       $updateData =[
            'name' => $request->name ?? '',
            'email' => $request->email ?? '',
       ];

       if($request->has('password')){
            $updateData['password'] = bcrypt($request->password);
       }

       $user->update($updateData);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
