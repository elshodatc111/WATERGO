<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Moliya;
use Illuminate\Http\Request;

class MoliyaController extends Controller{
    public function index(){
        $moliya = Moliya::getMoliya();
        return view('moliya.index', compact('moliya'));
    }
}
