<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\KassaChiqimRequest;
use App\Http\Requests\StoreIdishChiqimRequest;
use App\Http\Requests\StoreIshlabChiqarishRequest;
use App\Models\FarmHistory;
use App\Models\Moliya;
use App\Models\Ombor;
use App\Models\OmborHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OmborxonaController extends Controller{
    
    public function kassaIndex(){
        $ombor = Ombor::getOmbor();
        $history = FarmHistory::where('status',false)->where('type','!=','output_deffect')->orderby('created_at', 'desc')->get();
        return view('ombor.kassa.index', compact('ombor', 'history'));
    }

    public function kassaChiqim(KassaChiqimRequest $request){
        $validated = $request->validated();
        $payType = $validated['type'];
        $amount = $validated['count'];
        $ombor = Ombor::getOmbor();
        if (!isset($ombor->$payType) || $ombor->$payType < $amount) {
            $payTypeNames = [
                'cash' => 'Naqd pul',
                'card' => 'Karta',
                'bank' => 'Bank'
            ];
            $typeName = $payTypeNames[$payType] ?? 'Mablag\'';
            return redirect()->back()->withErrors(['count' => "{$typeName} miqdori yetarli emas."])->withInput();
        }
        DB::transaction(function() use ($validated, $ombor, $payType, $amount) {
            $ombor->decrement($payType, $amount);
            FarmHistory::create([
                'type'        => 'input_' . $payType,
                'status'      => false,
                'count'       => $amount,
                'description' => $validated['description'],
                'user_id'     => Auth::id(),
                'admin_id'    => null,
            ]);
        });
        return back()->with('success', 'Kassadan chiqim muvaffaqiyatli amalga oshirildi.');
    }

    public function kassaChiqimCancel(Request $request){
        $historyId = $request->input('history_id');
        $history = FarmHistory::findOrFail($historyId);
        if ($history->status) {
            return back()->withErrors(['error' => 'Bu chiqim allaqachon tasdiqlangan.']);
        }
        DB::transaction(function() use ($history) {
            $payType = str_replace('input_', '', $history->type);
            $ombor = Ombor::getOmbor();
            $ombor->increment($payType, $history->count);
            $history->delete();
        });
        return back()->with('success', 'Chiqim bekor qilindi va kassaga qaytarildi.');
    } 

    public function kassaChiqimConfirm(Request $request){
        $historyId = $request->input('history_id');
        $history = FarmHistory::findOrFail($historyId);
        if ($history->status) {
            return back()->withErrors(['error' => 'Bu chiqim allaqachon tasdiqlangan.']);
        }
        DB::transaction(function() use ($history) {
            $moliya = Moliya::getMoliya();
            $history->update(['status' => true, 'admin_id' => Auth::id()]);
            if($history->type == 'input_cash' || $history->type == 'input_card' || $history->type == 'input_bank'){
                $moliya->decrement($history->type == 'input_cash' ? 'cash' : ($history->type == 'input_card' ? 'card' : 'bank'), $history->count);
            }
        });
        return back()->with('success', 'Chiqim tasdiqlandi.');
    }

    public function omborchiIndex(){
        $ombor = Ombor::getOmbor();
        $history = FarmHistory::where('status',false)->where('type','output_deffect')->orderby('created_at', 'desc')->get();        
        $historyOmbor = OmborHistory::where('created_at', '>=', now()->subDays(60))->orderby('id', 'desc')->get();
        return view('ombor.omborchi.index', compact('ombor', 'history', 'historyOmbor'));
    }

    public function omborNosozChiqim(StoreIdishChiqimRequest $request){
        $validated = $request->validated();
        $ombor = Ombor::getOmbor();
        $payType = $validated['type'];
        $count = $validated['count'];
        if (!isset($ombor->$payType) || $ombor->$payType < $count) {
            return redirect()->back()->withErrors(['count' => 'Omborda yetarli idish mavjud emas.'])->withInput();
        }
        DB::transaction(function() use ($validated, $ombor, $payType, $count) {
            $ombor->decrement($payType, $count);
            FarmHistory::create([
                'type'        => 'output_deffect',
                'status'      => false,
                'count'       => $count,
                'description' => $validated['description'],
                'user_id'     => Auth::id(),
                'admin_id'    => null,
            ]);
        });
        return back()->with('success', 'Nosoz idishlar chiqim qilindi.');
    }

    public function nosozIdishChiqimConfirm(Request $request){
        $historyId = $request->input('history_id');
        $history = FarmHistory::findOrFail($historyId);
        if ($history->status) {
            return back()->withErrors(['error' => 'Bu chiqim allaqachon tasdiqlangan.']);
        }
        DB::transaction(function() use ($history) {
            $history->update(['status' => true, 'admin_id' => Auth::id()]);
        });
        return back()->with('success', 'Chiqim tasdiqlandi.');
    }

    public function ishlabChiqarish(StoreIshlabChiqarishRequest $request){
        $validated = $request->validated();
        $ombor = Ombor::getOmbor();
        DB::transaction(function() use ($validated, $ombor) {
            $ombor->decrement('empty_contaner', $validated['empty_contaner']);
            $ombor->increment('full_contaner', $validated['empty_contaner']);
            $ombor->decrement('full_cover', $validated['empty_contaner']);
            $ombor->decrement('full_label', $validated['full_label']);
            OmborHistory::create([
                'contaner' => $validated['empty_contaner'],
                'label' => $validated['full_label'],
                'cover' => $validated['empty_contaner'],
                'description' => $validated['description'],
                'user_id' => Auth::id(),
            ]);
        });
        return back()->with('success', 'Ishlab chiqarish muvaffaqiyatli amalga oshirildi.');
    }

    public function currerIndex(){
        return view('ombor.currer.index');
    }
}
