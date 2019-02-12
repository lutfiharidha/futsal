<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Coupon;
use App\Testimonial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Contact;

class AdminController extends Controller
{
    public function indexcontact()
    {
        $cont = Contact::paginate(5);
        return view('admin.contact',compact('cont'));
    }
    //memberS CONTROLLER
	public function indexmember()
    {
        $cup = Coupon::all();
    	$member = User::whereDoesntHave('roles')->paginate(3);
        return view('admin.member',compact('member','cup'));
    }

    public function createmember()
    {

        $user = User::latest()->take(1)->get();
        foreach ($user as $u) {
            $id=$u->id + 1;
        }
    	return view('admin.createmember',compact('id'));
    }


    public function storemember(request $request)
    { 
        $code = 'AF'.$request->id.substr( str_shuffle( str_repeat( '0123456789',1) ), 0, 4).date('y');
		$this->validate($request,[
			'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
		]);
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'phone' => $request->phone,
			]);
        Coupon::create([
            'code' => $code,
            'user' => $user->id,
            'batas' => 5,
            ]);
		return redirect()->back()->with('message','Your member Has Been Added');
	}


	public function editmember($id)
	{
		$member = User::find($id);
        return view('admin.editmember',compact('member'));
    }


    public function updatemember(Request $request, $id)
    {
        $member = User::find($id);
        $member->update([
        	'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'phone' => $request->phone,
		]);
		return redirect()->back()->with('message','Berhasil Di Update');

    }
    public function addcoupon(request $request,$id)
    {
        $us = User::find($id);
        $us->code = $request->code;
        $us->save();
        return redirect()->back()->with('message','Berhasil Di tambah');

    }
public function updatecoupon($id)
    {

        $cup = Coupon::find($id);
        $cup->update([
            'batas' => 5,
        ]);
        return redirect()->back()->with('message','Berhasil Di tambah');

    }

    public function memberdestroy(user $user)
	{
		$user -> delete();
        return redirect()->back()->with('message','Berhasil Di Delete');
    }
//END memberS CONTROLLER
        //Testi CONTROLLER
    public function testi()
    {
        $testi = Testimonial::paginate(7);
        return view('admin.testimonial',compact('testi'));
    }

    public function createtesti()
    {
        return view('admin.createtesti');
    }


    public function storetesti(request $request)
    { 
        $destinationPath = public_path().'/img/testi/';
        $validator = Validator::make($request->all(), [
            "image"    => "mimes:jpg,jpeg,png,gif|max:2048",
            ]);
            if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }
            else{
                $fileName = Input::file('image')->getClientOriginalName();
                $file = Input::file('image')->move($destinationPath, $fileName);
                 Testimonial::create([
                    'nama' => $request->name,
                    'description' => $request->description,
                    'image' => $fileName,
                    'status' => $request->status,
                    ]);
             }
        return redirect()->route('data.testi')->with('message','Your Testimonial Has Been Added');
    }


    public function edittesti($id)
    {
        $testi = Testimonial::find($id);
        return view('admin.edittesti',compact('testi'));
    }


    public function updatetesti(Request $request, $id)
    {
        $testi = Testimonial::find($id);
        if($request->file('image') == ""){
            $testi->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        }
        else{
        $destinationPath = public_path().'/img/testi/';
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
                $testi->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $fileName,
                    'status' => $request->status,
                ]);
            }

        }
    return redirect()->route('data.testi')->with('message','Your testimonial has been updated');
    }


    public function testidestroy(testi $testi)
    {
        $testi -> delete();
        return redirect()->back()->with('message','Berhasil Di Delete');
    }
//END memberS CONTROLLER
}
