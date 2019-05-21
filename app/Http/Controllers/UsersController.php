<?php

namespace Ciklas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ciklas\Http\Requests\UpdateProfile;
use Illuminate\Support\Str;
use Ciklas\User;
use Ciklas\Note;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->role_id;

        $users = User::paginate(10);
        
        return view('users.all')
            ->with('users', $users)
            ->with('role', $role)
            ->with('name','Visi vartotojai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = auth()->user()->role;
        $usr = User::find($id);
        $name = $usr->name;

        return view('users.show')
            ->with('usr', $usr)
            ->with('role', $role)
            ->with('name', $name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        User::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role_id' => request()->get('role_id'),
        ]);

        //finds last insterted and creates notes table entry with its id
        $inserted = User::orderby('created_at', 'desc')->first();

        $notes = new Note;
        $notes->note = 'Jūsų privatūs užrašai';
        $notes->user_id = $inserted->id;
        $notes->save();

        return redirect()->back()->with('success', 'Pridėtas vartotojas');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = auth()->user()->role;

        $users = User::find($id);

        return view('users.edit')
            ->with('users', $users)
            ->with('role', $role)
            ->with('name', $users->name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, User $user)
    {
        $role = auth()->user()->role;

        // form data
        $data = $request->all();
        $user->update($data);
        return redirect('/users')
            ->with('success', 'Vartotojo duomenys atnaujinti')
            ->with('role', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $notes = Note::where('user_id', '=', $id);
        $notes->delete();
        
        return redirect('/users')->with('success', 'Vartotojas pašalintas');
    }
}
