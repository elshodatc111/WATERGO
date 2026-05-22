<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMoliyaNarxRequest;
use App\Models\Moliya;

class MoliyaSettingController extends Controller{

    public function index(){
        $moliya = Moliya::getMoliya();
        return view('moliya.setting', compact('moliya'));
    }

    public function update(UpdateMoliyaNarxRequest $request){
        $moliya = Moliya::getMoliya();
        $moliya->price_contaner = str_replace(',', '', $request->price_contaner);
        $moliya->price_water = str_replace(',', '', $request->price_water);
        $moliya->save();
        return redirect()->route('moliya_settings')->with('success', 'Narxlar muvaffaqiyatli yangilandi.');
    }

}
