<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function index() {

        $posts = Post::orderBy( 'id', 'desc' )->paginate( 5 );
        return view( 'posts.index', [ 'posts' => $posts ] );

        // $post = User::find( 4 )->posts;
        // return response()->json( [
        //     $post
        // ] );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'posts.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $validated = $request->validate( [
            'title' => 'required|max:100',
            'body' => 'required|max:1000'
        ] );

        // $user = User::find( $id );
        // $post = new Post;
        // $user->posts()->create( [
        //     'title' => $request->title,
        //     'body' => $request->body
        // ] );
        // $user->posts()->save( $post );

        $post = new Post;
        $post->title = $request[ 'title' ];
        $post->body = $request[ 'body' ];
        $post->user()->associate( Auth::user() );
        $post->save();
        return redirect()->route( 'posts.index' )->with( [ 'Success' => 'Your Post added successfully' ] );

    }

    /**
    * Display the specified resource.
    */

    public function show( Post $post ) {
        return view( 'posts.show', compact( 'post' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Post $post ) {
        return view( 'posts.edit', compact( 'post' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( PostStoreRequest $request ) {
			$request->validated();
			return redirect()->route( 'posts.index' )
        ->with( 'Success', 'Post updated successfully' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        Post::where( 'id', $id )
        ->delete();
        return redirect()->back();
    }
}
