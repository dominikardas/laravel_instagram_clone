<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class ProfilesController extends Controller
{

    private $_validateRules = [        
        // 'name' => 'required|string',
        // 'username' => 'required|string',
        'title' => ['string', 'nullable'],
        'description' => ['string', 'nullable'],
        'url' => ['url', 'nullable']
        // 'image' => ''
    ];

    /**
     * Display profile by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $data = ['user' => $user];

        return view('profiles.show', $data);
    }

    /**
     * Edit profile of logged in user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user->profile);
        
        $data = array('user' => $user);
        return view('profiles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user->profile);

        $data = request()->validate($this->_validateRules);
        auth()->user()->profile->update($data);

        return redirect('/profile/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
