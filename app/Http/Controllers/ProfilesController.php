<?php

namespace Ciklas\Http\Controllers;

use Illuminate\Http\Request;
use Ciklas\Http\Requests\UpdateProfile;
use Ciklas\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        // user
        $viewData = [
            'user' => $user,
        ];
        // render view with data
        return view('profile.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request, User $user)
    {
        // form data
        $data = $request->all();
        $user->update($data);
        return redirect(route('profile.edit', ['user' => $user]))
                    ->with('info', 'Your profile has been updated successfully.');
    }
}
