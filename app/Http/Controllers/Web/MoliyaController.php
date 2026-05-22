<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoliyaMaxsulotChiqimRequest;
use App\Http\Requests\StoreDaromadChiqimRequest;
use App\Http\Requests\StoreMaxsulotKirimRequest;
use App\Http\Requests\StoreXarajatRequest;
use App\Models\FarmHistory;
use App\Models\Moliya;
use App\Models\Ombor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoliyaController extends Controller{
    
    public function index(){
        $moliya = Moliya::getMoliya();
        $history = FarmHistory::where('status', true)->where('created_at', '>=', now()->subDays(60))->orderby('id', 'desc')->get();
        return view('moliya.index', compact('moliya', 'history'));
    }

    public function maxsulotKirim(StoreMaxsulotKirimRequest $request){
        DB::transaction(function() use($request){
            $data = $request->validated();
            $moliya = Moliya::getMoliya();
            if($data['type'] == 'input_contaner'){
                $moliya->increment('contaner', $data['count']);
            }elseif($data['type'] == 'input_cover'){
                $moliya->increment('cover', $data['count']);
            }elseif($data['type'] == 'input_label'){
                $moliya->increment('label', $data['count']);
            }
            FarmHistory::create([
                'type' => $data['type'],
                'status' => true,
                'count' => $data['count'],
                'description' => $data['description'],
                'user_id' => Auth::id(),
                'admin_id' => Auth::id(),
            ]);
        });
        return redirect()->route('moliya_index')->with('success', 'Maxsulot kirimi muvaffaqiyatli qo\'shildi.');
    }

    public function maxsulotChiqim(MoliyaMaxsulotChiqimRequest $request){
        $validated = $request->validated();
        $moliya = Moliya::getMoliya();
        $type = $validated['type'];
        if($type == 'input_contaner' && $moliya->contaner < $validated['count']){
            return redirect()->back()->withErrors(['count' => 'Yetarli idish mavjud emas.'])->withInput();
        }elseif($type == 'input_cover' && $moliya->cover < $validated['count']){
            return redirect()->back()->withErrors(['count' => 'Yetarli qopqoq mavjud emas.'])->withInput();
        }elseif($type == 'input_label' && $moliya->label < $validated['count']){
            return redirect()->back()->withErrors(['count' => 'Yetarli yorliq mavjud emas.'])->withInput();
        } 
        DB::transaction(function() use($validated, $type, $moliya){
            $ombor = Ombor::getOmbor();
            if($type == 'input_contaner'){
                $moliya->decrement('contaner', $validated['count']);
                $ombor->increment('empty_contaner', $validated['count']);
            }elseif($type == 'input_cover'){
                $moliya->decrement('cover', $validated['count']);
                $ombor->increment('full_cover', $validated['count']);
            }elseif($type == 'input_label'){
                $moliya->decrement('label', $validated['count']);
                $ombor->increment('full_label', $validated['count']);  
            }
            FarmHistory::create([
                'type' => $validated['type']=='input_contaner' ? 'output_contaner' : ($validated['type']=='input_cover' ? 'output_cover' : 'output_label'),
                'status' => true,
                'count' => $validated['count'],
                'description' => $validated['description'],
                'user_id' => Auth::id(),
                'admin_id' => Auth::id(),
            ]);
        });
        return redirect()->back()->with('success', 'Mahsulot chiqimi muvaffaqiyatli saqlandi!');
    }

    public function daromadChiqim(StoreDaromadChiqimRequest $request){
        $validated = $request->validated();
        $payType = $validated['pay_type'];
        $amount = $validated['count'];
        $moliya = Moliya::getMoliya();
        if (!isset($moliya->$payType) || $moliya->$payType < $amount) {
            $payTypeNames = [
                'cash' => 'Naqd pul',
                'card' => 'Karta',
                'bank' => 'Bank'
            ];
            $typeName = $payTypeNames[$payType] ?? 'Mablag\'';
            return redirect()->back()->withErrors(['count' => "{$typeName} miqdori yetarli emas."])->withInput();
        }
        DB::transaction(function() use ($validated, $moliya, $payType, $amount) {
            $moliya->decrement($payType, $amount);
            FarmHistory::create([
                'type'        => 'income_' . $payType,
                'status'      => true,
                'count'       => $amount,
                'description' => $validated['description'],
                'user_id'     => Auth::id(),
                'admin_id'    => Auth::id(),
            ]);
        });
        return redirect()->back()->with('success', 'Chiqim muvaffaqiyatli saqlandi!');
    }

    public function storeXarajat(StoreXarajatRequest $request){
        $validated = $request->validated();
        $payType = $validated['pay_type'];
        $amount = $validated['count'];
        $moliya = Moliya::getMoliya();
        if (!isset($moliya->$payType) || $moliya->$payType < $amount) {
            $payTypeNames = [
                'cash' => 'Naqd pul',
                'card' => 'Karta',
                'bank' => 'Bank'
            ];
            $typeName = $payTypeNames[$payType] ?? 'Mablag\'';            
            return redirect()->back()->withErrors(['count' => "Balansda yetarli mablag‘ mavjud emas. Tasdiqlangan {$typeName} balansi: " . number_format($moliya->$payType) . " so'm."])->withInput();
        }
        DB::transaction(function() use ($validated, $moliya, $payType, $amount) {
            $moliya->decrement($payType, $amount);
            FarmHistory::create([
                'type'        => 'cost_' . $payType, // Masalan: expense_cash
                'status'      => true,
                'count'       => $amount,
                'description' => $validated['description'],
                'user_id'     => Auth::id(),
                'admin_id'    => Auth::id(),
            ]);
        });
        return redirect()->back()->with('success', 'Xarajat muvaffaqiyatli qayd etildi!');
    }

}
