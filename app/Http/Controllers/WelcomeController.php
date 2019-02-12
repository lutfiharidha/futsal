<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Tournament;
use App\Province;
use App\Regencie;
use App\Usertour;
use App\Struk;
use App\Field;
use App\Booking;
use App\Coupon;
use Auth;
use App\User;
use App\Contact;
use App\Testimonial;
class WelcomeController extends Controller
{
    public function index()
    {
        $fields = Field::take(3)->get();
        $user = User::whereNotNull('image')->get();
    	$tournament = Tournament::take(2)->get();
        $testi = Testimonial::where('status',1)->take(5)->get();
    	return view('beranda', compact('tournament','fields','user','testi'));
    }

    public function tour()
    {
        $tournament = Tournament::latest()->paginate(7);
        return view('tournaments',compact('tournament'));
    }

    public function viewtour($id)
    {
    	$utor = Usertour::where('tour',$id)->where('status', 1)->get();
    	$province = Province::all();
        $tournament = Tournament::find($id);
        $limit = Usertour::where('tour', $id)->where('status', 1)->count();
        $tour = Tournament::inRandomOrder()->where('status','=',1)->take(3)->get();
         if(!$tournament)
            abort(404);
        return view('tournament',compact('tournament','limit','tour','province','utor'));
    }
    public function storetour(request $request, $id)
    { 
    	$tournament = Tournament::find($id);
        Usertour::create([
            'club' => $request->name,
            'tour' => $tournament->id,
			'pemain' => $request->pemain,
            'province' => $request->province,
            'city' => $request->city,
            'phone' => $request->hp,
            ]);
    	return redirect()->route('tour.view', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))] )->with('message','Thanks For Registed');
	}
	public function paytour($id)
    { 
    	$tournament = Tournament::find($id);
    	$club = Usertour::where('tour',$id)->where('status', 0)->get();
        return view('pay.tournament',compact('tournament','club'));
	}
	public function paystore(request $request, $id)
    { 
    	$tournament = Tournament::find($id);
    	$usertour = Usertour::all();
    	$destinationPath = public_path().'/img/struk/';
        $validator = Validator::make($request->all(), [
            "struk"    => "mimes:jpg,jpeg,png|max:2048",
            ]);
            if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }
            else{
                $fileName = Input::file('struk')->getClientOriginalName();
                $file = Input::file('struk')->move($destinationPath, $fileName);
                 Usertour::where('id',$request->club)->update([
                    'struk' => $fileName,
                    'ref' => $request->ref,
                    ]);
             }
             return redirect()->route('tour.view', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))] )->with('pay',"Thank you for payment, we'll verified your payment.");
	}

    public function book($id)
    {
        $book = Booking::where('lapangan',$id)->where('status', 1)->paginate(5);
        $field = Field::find($id);
        return view('pay.booking', compact('field','book'));
    }
    public function bookstore(request $request, $id)
    {
        $timestamp = strtotime($request->dari) + $request->waktu;
        $nobok=date('dmy').'AF'.substr( str_shuffle( str_repeat( '0123456789',1) ), 0, 3);
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $time = date('H:i', $timestamp);
        $field = Field::find($id);
        $kupon = Coupon::select('code')->get();
        foreach ($kupon as $key => $value) {
            $list = array($value->code);        
        }  
        if(Auth::guest()){
            if($request->kupon == ""){
            Booking::create([
            'no_book' => $nobok,
            'kupon' => $request->kupon,
            'nama' => $request->name,
            'lapangan' => $field->id,
            'phone' => $request->hp,
            'tanggal' => $request->date,
            'dari' => $request->dari,
            'sampai' => $time,
            'total' => $request->total,
            ]);
            return redirect()->back()->with('au','Thanks For Booking');
        }
        else{
            $ba = Coupon::where('code', $request->kupon)->get();
            if ($ba->first()->batas == 0) {
               return redirect()->back()->with('un','Your Coupon Not Valid');
            }
            elseif(in_array($request->kupon, $list)){
        $total =  $request->total *25/100;
        $kuppon = Coupon::where('code', $request->kupon)->get();
        $kuppon->first()->update([
            'batas' => $kuppon->first()->batas - 1
        ]);
            Booking::create([
            'no_book' => $nobok,
            'kupon' => $kuppon->first()->id,
            'nama' => $request->name,
            'lapangan' => $field->id,
            'phone' => $request->hp,
            'tanggal' => $request->date,
            'dari' => $request->dari,
            'sampai' => $time,
            'total' => $request->total - $total,
            ]);
            return redirect()->back()->with('su','Thanks For Booking with our coupon');
        }
            else{
            return redirect()->back()->with('un','Your Coupon Not Valid');
            }
        }
    }
        else{
            $pm = Auth::user()->pemesanan;
                if($pm%10==0){
                     $good = $request->total * 10/100;
                }else{
                    $good= 0;
                }
            if($request->used == ""){
            Booking::create([
            'no_book' => $nobok,
            'user' => Auth::user()->id,
            'nama' => $request->name,
            'lapangan' => $field->id,
            'phone' => $request->hp,
            'tanggal' => $request->date,
            'dari' => $request->dari,
            'sampai' => $time,
            'user' => auth()->user()->id,
            'total' => $request->total - $good,
            ]);
        return redirect()->back()->with('mem','Thanks For Booking And Still with Our');
        }
        else{

        $kuppon = Coupon::where('code', auth()->user()->cup->code)->get();
        $ba = Coupon::where('code', auth()->user()->cup->code)->get();
            if ($ba->first()->batas == 0) {
               return redirect()->back()->with('un','Your Coupon Not Valid');
            }
        else{
        $kuppon->first()->update([
            'batas' => $kuppon->first()->batas - 1
        ]);
        $total =  $request->total * 25/100;
        Booking::create([
            'no_book' => $nobok,
            'user' => Auth::user()->id,
            'kupon' => Auth::user()->cup->id,
            'nama' => $request->name,
            'lapangan' => $field->id,
            'phone' => $request->hp,
            'tanggal' => $request->date,
            'dari' => $request->dari,
            'sampai' => $time,
            'user' => auth()->user()->id,
            'total' => $request->total - $total - $good,
            ]);
        return redirect()->back()->with('mem','Thanks For Booking And Still with Our');
        }
        }
    }
        
    }
    public function paybook($id)
    { 
        $field = Field::find($id);
        $booked = Booking::where('lapangan',$id)->where('status',0)->get();
        return view('pay.pay',compact('field','booked'));
    }
    public function sbook(request $request, $id)
    { 
        $field = Field::find($id);
        $booked = Booking::all();
        $destinationPath = public_path().'/img/struk/';
        $validator = Validator::make($request->all(), [
            "struk"    => "mimes:jpg,jpeg,png|max:2048",
            ]);
            if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }
            else{
                $fileName = Input::file('struk')->getClientOriginalName();
                $file = Input::file('struk')->move($destinationPath, $fileName);
                 Booking::where('id',$request->user)->update([
                    'struk' => $fileName,
                    'ref' => $request->ref,
                    ]);
             }
             return redirect()->route('book', [$field->id,preg_replace('/\+/', '-',urlencode(strtolower($field->name)))] )->with('pay',"Thank you for payment, we'll verified your payment.");
    }

    public function prov($provinceId)
	{
		$a = Regencie::select('regencies.*')->join('provinces', 'provinces.id', '=', 'regencies.province_id')->where('provinces.id', $provinceId)->get();
		$b = json_encode($a);
     	return $b;
	}
    public function time($tanggal)
    {
        $a = Booking::where('tanggal', $tanggal)->where('status',1)->get();
        $b = json_encode($a);
        return $b;
    }
    public function bo($id)
    {
        $a = Booking::where('id', $id)->where('status',0)->get();
        $b = json_encode($a);
        return $b;
    }

    public function cont(request $request){
        Contact::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'message' => $request->message,
            ]);
        return redirect()->back()->with('message','Your Message Has Been Sended');
    }
}
