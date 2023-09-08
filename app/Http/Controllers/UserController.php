<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index()

    {
        $users = User::orderBy('id')->paginate(4);
        return view( 'users.index', compact( 'users' ) );
    }

    public function create()
    {
        return view( 'users.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request )
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required'
        ] );
        User::create( $request->all() );
        return redirect()->route( 'users.index' )
        ->with( 'Success', 'User created successfully.' );
    }

    /**
    * Display the specified resource.
    */

    public function show( User $user )
    {
        return view( 'users.show', compact( 'user' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( User $user )
    {
        return view( 'users.edit', compact( 'user' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, User $user )
    {
        $request->validate( [
            'name' => 'required|max:50',
            'email' => 'required|email'
        ] );

        if ( $user->update( $request->all() ) ) {
            return redirect()->route( 'users.index' )
            ->with( 'Success', 'User updated successfully' );
        }
        return back()->withInput();

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( User $user )
    {
        $user->delete();
        return redirect()->route( 'users.index' )
        ->with( 'success', 'User deleted successfully' );
    }

}
