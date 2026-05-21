<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index(){
        $users = User::where('type','!=','admin')->orderby('status','desc')->get();
        return view('users.index', compact('users'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function store(StoreUserRequest $request){
        $data = $request->validated();
        User::create([
            'name' => mb_strtoupper($data['name'], 'UTF-8'),
            'phone' => $data['phone'],
            'type' => $data['type'],
            'salary' => $data['balans'],
            'status' => true,
            'password' => 'password',
        ]);
        return redirect()->route('users_index')->with('success', 'Hodim muvaffaqiyatli qo\'shildi!');
    }

    public function update(UpdateUserRequest $request){
        $data = $request->validated();
        $user = User::findOrFail($data['id']);
        $user->update([
            'name' => mb_strtoupper($data['name'], 'UTF-8'),
            'phone' => $data['phone'],
            'type' => $data['type'], 
            'balans' => $data['balans'],
        ]); 
        return redirect()->back()->with('success', 'Xodim ma\'lumotlari muvaffaqiyatli yangilandi!');
    }

    public function update_status(Request $request){
        $user = User::findOrFail($request->id);
        $user->update([
            'status' => !$user->status, 
        ]); 
        return redirect()->back()->with('success', 'Xodim statusi muvaffaqiyatli yangilandi!');
    }

    public function update_password(Request $request){
        $user = User::findOrFail($request->id);
        $user->update([
            'password' => bcrypt('password'),
        ]);
        return redirect()->back()->with('success', 'Xodim paroli muvaffaqiyatli yangilandi!');
    }
}
