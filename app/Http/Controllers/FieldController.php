<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Field;
use App\Booking;
use App\User;
use Auth;
class FieldController extends Controller
{
    public function index()
    {
    	$fields = Field::paginate(3);
    	return view('admin.field', compact('fields'));
    }

    public function createfield()
    {
        return view('admin.createfield');
    }

    public function storefield(request $request)
    { 
        $destinationPath = public_path().'/img/field/';
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
                 Field::create([
                    'name' => $request->name,
                    'fasilitas' => $request->fasilitas,
                    'harga' => $request->price,
                    'image' => $fileName,
                    'status' => $request->status,
                    ]);
             }
    	return redirect()->route('data.field')->with('message','Your field has been added');
	}

	public function editfield($id)
    {
        $fields = Field::find($id);
        return view('admin.editfield',compact('fields'));
    }

    public function updatefield(Request $request, $id)
    {
        $fields = Field::find($id);
        if($request->file('image') == ""){
            $fields->update([
            'name' => $request->name,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->price,
            'status' => $request->status,
        ]);
        }
        else{
        $destinationPath = public_path().'/img/field/';
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
                $fields->update([
                    'name' => $request->name,
                    'fasilitas' => $request->fasilitas,
                    'harga' => $request->price,
                    'image' => $fileName,
                    'status' => $request->status,
                ]);
        	}

    	}
    return redirect()->route('data.field')->with('message','Your field has been updated');
	}

	public function destroyfield(field $field)
    {
        $field -> delete();
        return redirect()->back()->with('message','Your Field Has Been Deleted');
    }
    public function viewbook($id)
    {
        $book = Booking::where('lapangan',$id)->paginate(6);
        $field = Field::find($id);
        $limit = Booking::where('lapangan', $id)->where('status', 1)->count();

        return view('admin.booking', compact('book', 'limit','field'));
    }
    public function editbook(request $request,$id)
    { 
    Booking::where('id',$request->id)->update([ 'status' => $request->status]);
    $f = Field::where('id',$request->field);
    $u = User::where('id',$request->idu);

    if ($request->status == 1){
        if($request->idu == 0){
            Field::where('id',$request->field)->update([ 'pemesanan' => $f->first()->pemesanan +1]);
        }
        else{
        Field::where('id',$request->field)->update([ 'pemesanan' => $f->first()->pemesanan +1]);
        User::where('id',$request->idu)->update([ 'pemesanan' => $u->first()->pemesanan +1]);
        }
    }
    else{
        if($request->idu == 0){
            Field::where('id',$request->field)->update([ 'pemesanan' => $f->first()->pemesanan -1]);
        }
        else{
    Field::where('id',$request->field)->update([ 'pemesanan' => $f->first()->pemesanan -1]);
    User::where('id',$request->idu)->update([ 'pemesanan' => $u->first()->pemesanan -1]);
     }
    }
    return redirect()->back()->with('message','Booking has been updated');
}
}
