<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHududRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Region;
use App\Models\RegionUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function show(int $id){
        $region_a = Region::findOrFail($id);
        $region = [
            'id' => $region_a->id,
            'name' => $region_a->name,
            'description' => $region_a->description,
            'status' => $region_a->status,
            'currer' => count(RegionUser::where('region_id', $region_a->id)->where('status', 1)->get()),
            'admin' => $region_a->user->name,
            'created_at' => $region_a->created_at,
        ];
        $new_currer = [];
        foreach (User::where('type','currer')->where('status',true)->get() as $key => $value) {
            $checkRegion = RegionUser::where('user_id',$value['id'])->where('status',true)->first();
            if($checkRegion==null){
                $new_currer[] =[
                    'currer_id' => $value['id'],
                    'currer' => $value['name'],
                ];
            }            
        }
        $currer = RegionUser::where('region_id', $id)->orderBy('status', 'desc')->get();
        //dd($currer);
        return view('regions.show', compact('region','new_currer','currer'));
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

    public function update_status(Request $request){
        DB::transaction(function() use($request){
            $region = Region::findOrFail($request->region_id);
            $region->status = !$region->status;
            $region->save();
        });        
        return redirect()->back()->with('success', 'Hudud holati muvaffaqiyatli o\'zgartirildi.');
    }

    public function update(UpdateRegionRequest $request){
        $data = $request->validated();
        $region = Region::findOrFail($data['id']);
        $region->name = mb_strtoupper($data['name'], 'UTF-8');
        $region->description = $data['description'];
        $region->save();
        return redirect()->back()->with('success', 'Hudud muvaffaqiyatli tahrirlandi.');
    }

    public function add_currer(Request $request){
        $request->validate([
            'region_id' => 'required|string',
            'user_id' => 'required|string',
        ]);
        RegionUser::create([
            'region_id' => $request->region_id,
            'user_id' => $request->user_id,
            'status' => true,
        ]);
        return redirect()->back()->with('success', 'Hudud muvaffaqiyatli qo\'shildi.');
    }

    public function trash_currer(Request $request){
        $request->validate([
            'region_id' => 'required|string',
            'user_id' => 'required|string',
        ]);
        $regionUser = RegionUser::where('region_id', $request->region_id)->where('user_id', $request->user_id)->firstOrFail();
        $regionUser->status = false;
        $regionUser->save();
        return redirect()->back()->with('success', 'Haydovchi muvaffaqiyatli o\'chirildi.');
    }

}
