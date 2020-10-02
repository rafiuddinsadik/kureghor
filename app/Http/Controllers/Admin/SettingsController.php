<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function paymentMethodIndex(){
        $settings = DB::table('settings')->where('id', '1')->get();
        return view('admin.paymentmethod.index', compact('settings'));
    }

    public function bkashNumUpdate(Request $request){
        DB::table('settings')->where('id', '1')->update(['bkash_num'=>$request->bkash_num]);
        return redirect()->route('admin.payment.method');
    }
    public function deliveryChargeUpdate(Request $request){
        DB::table('settings')->where('id', '1')->update(['delivery_charge'=>$request->delivery_charge]);
        return redirect()->route('admin.payment.method');
    }

    public function methodStatusSwitch($var){
        if(DB::table('settings')->where('id', '1')->get()[0]->$var == 0){
            DB::table('settings')->where('id', '1')->update([$var => 1]);
        }else{
            DB::table('settings')->where('id', '1')->update([$var => 0]);

        }
        return redirect()->route('admin.payment.method');
    }

}
