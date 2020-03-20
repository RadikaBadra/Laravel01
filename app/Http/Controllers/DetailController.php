<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail;

class DetailController extends Controller
{
    public function index()
    {
       $users = detail::all();
       return view ('details/index',['users'=>$users]);
    }
    public function create()
    {
       return view('details/create');
    }

    public function edit(Detail $users)
    {
        return view('details/edit',compact('users'));
    }

    public function update(Request $request,Detail $users)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        detail::where('id',$users->id)
            ->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);
        return redirect('/Details')->with('status','Editing Succes');    
    }

    public function destroy(Detail $users)
    {
        detail::destroy($users->id); 
        return redirect('/Details')->with('status','Deleting Succes');
       
    }
    public function show(Detail $users)
    {
        return view('details.view',compact('users'));
      
    }
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        Detail::create($request->all());
        return redirect('/Details')->with('status','Input Succes');
    }
    public function json(){
        $users = detail::all();
        return $users;
    }
}
