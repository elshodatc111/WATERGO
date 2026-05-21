<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHududRequest;
use App\Models\Region;
use App\Models\RegionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller{
    
    public function index(){
        $regionAll = Region::orderby('status', 'desc')->orderby('status', 'desc')->get();
        $region = [];
        foreach($regionAll as $item){
            $region[] = [
                'id' => $item->id,
                'name' => $item->name,
                'status' => $item->status,
                'currer' => count(RegionUser::where('region_id', $item->id)->where('status', 1)->get()),
                'created_at' => $item->created_at,
            ];
        }
        return view('regions.index', compact('region'));
    }

    public function show($id){
        return view('regions.show', ['id' => $id]);
    }

    public function store(StoreHududRequest $request){
        $data = $request->validated();
        Region::create([
            'name' => mb_strtoupper($data['name'], 'UTF-8'),
            'description' => $data['description'],
            'status' => 1,
            'user_id' => Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Hudud muvaffaqiyatli qo\'shildi.');
    }
}
