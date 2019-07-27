<?php

namespace App\Http\Controllers;

use App\Files;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Messages;
use App\Group;
use Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function add($group_id)
    {
        return view('files/add', compact('group_id'));
    }
    public function add_group()
    {
        return view('files/add_group');
    }
        public function show()
    {
        $groups =  Group::where('user_id', auth()->id())->with('files')->get();
        return view('files/show', compact('groups'));
    }
    public function remove($id)
    {
       // $filename = Files::find($id);
       // Storage::delete('files/'.$filename->file_name);
        $groups =  Group::find($id)->with('files')->get();
        $groups[0]->files()->delete();
        $groups[0]->delete();
        return redirect ("/group/show");
    }
    public function store_group(Request $request)
    {
        $request = Request::all();
        $group = new Group;
        $group->user_id = auth()->id();
        $group->group_name=$request['group_name'];
        $group->save();
       return redirect("group/show");
    }
    public function store(Request $request, $group_id)
    {
        $uploadedFile = Request::file('file');
        $filename = time() . $uploadedFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            'files/',
            $uploadedFile,
            $filename
        );
        $file = new Files;
        $file->user_id = auth()->id();
        $file->file_name=$filename;
        $file->availability="allowed";
        $file->group_id=$group_id;
        $file->save();
        $id=$file->id;
        $message = new Messages();
        $message->storeBase($id);
        return redirect("/group/show");
    }
}
