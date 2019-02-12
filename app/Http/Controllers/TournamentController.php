<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Tournament;
use App\Usertour;
class TournamentController extends Controller
{
    public function index()
    {
    	$tournament = Tournament::paginate(3);
        return view('admin.tournament', compact('tournament'));
    }
    public function createtour()
    {
        return view('admin.createtournament');
    }
    public function storetour(request $request)
    { 

        $destinationPath = public_path().'/img/tournament/';
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
                 Tournament::create([
                    'tournament' => $request->name,
                    'description' => $request->description,
                    'syarat' => $request->syarat,
                    'image' => $fileName,
                    'status' => $request->status,
                    'club' => $request->club,
                    ]);
             }
    return redirect()->route('data.tournament')->with('message','Your tournament has been added');
}
public function edittour($id)
    {
        $tournament = tournament::find($id);
        return view('admin.edittournament',compact('tournament'));
    }
    public function updatetour(Request $request, $id)
    {
        $tournament = tournament::find($id);
        if($request->file('image') == ""){
            $tournament->update([
            'tournament' => $request->name,
            'description' => $request->description,
            'syarat' => $request->syarat,
            'status' => $request->status,
        ]);
        }
        else{
        $destinationPath = public_path().'/img/tournament/';
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
                $tournament->update([
                    'tournament' => $request->name,
                    'description' => $request->description,
                    'syarat' => $request->syarat,
                    'image' => $fileName,
                    'status' => $request->status,
                ]);
        }

    }
    return redirect()->route('data.tournament')->with('message','Your tournament has been updated');

}
    public function destroytour(tournament $tournament)
    {
        $tournament -> delete();
        return redirect()->back()->with('message','Your tournament Has Been Deleted');
    }

    public function viewtour($id)
    {
        $user = Usertour::where('tour',$id)->paginate(6);
        $tour = Tournament::find($id);
        $limit = Usertour::where('tour', $id)->where('status', 1)->count();
        return view('admin.tournaments', compact('user', 'limit','tour'));
    }
    public function edituser(request $request,$id)
    { 
                 Usertour::where('id',$request->id)->update([
                    'status' => $request->status,
                    ]);
    return redirect()->back()->with('message','Club has been updated');
}
}
