<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Coupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
class MemberController extends Controller
{
    public function index()
    {
    	return view('member.account');
    }
    public function account()
    {
    	return view('member.update');
    }
    public function supdate(Request $request)
    {
        $member = User::where('id', auth()->user()->id);
        if($request->file('image') == ""){
        $member->update([
        	'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'club' => $request->club,
			'phone' => $request->phone,
		]);
    	}
    	else{
    		$destinationPath = public_path().'/img/club/';
        $validator = Validator::make($request->all(), [
            "image"    => "required|mimes:jpg,jpeg,png,gif|max:2048",
            ]);
            if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }
            else{
                $fileName = Input::file('image')->getClientOriginalName();
                $file = Input::file('image')->move($destinationPath, $fileName);     
                $member->update([
                    'name' => $request->name,
					'email' => $request->email,
					'password' => bcrypt($request->password),
					'phone' => $request->phone,
					'club' => $request->club,
                    'image' => $fileName,
                ]);
        	}
    	}
		return redirect()->back()->with('message','Berhasil Di Update');

    }
    public function coupon(Request $request)
    {
    	$cupp=Coupon::where('id', auth()->user()->code)->get();
    	$cupp->first()->update([
    		'code' => $request->code,
    	]);
    	return redirect()->back()->with('message','Berhasil Di Update');
    }
}
