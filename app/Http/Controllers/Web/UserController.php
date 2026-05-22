<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\FarmHistory;
use App\Models\Moliya;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    public function index(){
        $users = User::where('type','!=','admin')->orderby('status','desc')->get();
        return view('users.index', compact('users'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        $salary = Salary::where('user_id', $id)->orderby('created_at','desc')->get();
        return view('users.show', compact('user', 'salary'));
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

    public function salaryStore(StoreSalaryRequest $request){
        $validated = $request->validated();
        $payType = $validated['amount_type'];
        $amount = $validated['count'];
        $moliya = Moliya::getMoliya();
        if (!isset($moliya->$payType) || $moliya->$payType < $amount) {
            $payTypeNames = [
                'cash' => 'Naqd pul',
                'card' => 'Karta',
                'bank' => 'Bank'
            ];
            $typeName = $payTypeNames[$payType] ?? 'Mablag\'';            
            return redirect()->back()->withErrors(['count' => "Ish haqi to‘lash uchun {$typeName} balansida mablag‘ yetarli emas."])->withInput();
        }
        DB::transaction(function() use ($validated, $moliya, $payType, $amount) {
            $moliya->decrement($payType, $amount);
            $user = User::findOrFail($validated['user_id']);
            FarmHistory::create([
                'type'        => 'salary_' . $payType,
                'status'      => true,
                'count'       => $amount,
                'description' => $user->name . ': ' . $validated['description'],
                'user_id'     => Auth::id(),
                'admin_id'    => Auth::id(),
            ]);
            Salary::create([
                'user_id' => $validated['user_id'],
                'amount' => $amount,
                'type' => $payType,
                'description' => $validated['description'],
                'admin_id' => Auth::id(),
            ]);
        });
        return redirect()->back()->with('success', 'Ish haqi muvaffaqiyatli to‘landi va qayd etildi!');
    }
}
