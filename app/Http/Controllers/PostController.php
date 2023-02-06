<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('/posts', compact('posts'));
    }



    public function myposts(){
        $userposts = User::with('posts')->find(Auth::user()->id);
        
        
        $myposts = $userposts->posts;


        return view('myposts',compact('myposts'));
        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if(!Auth::check()){
            return redirect('/signin');
        }

        $request->validate([
            'title'=>'required|string',
            'body'=>'required|string',
        ]);

        $post = new Post();
        
        $post->title = $request->title;
        $post->body = $request->body;

        $post->user()->associate(Auth::user()->id)->save();

        $mailData = $request->only('body','title');
        $email = Auth::user()->email;
        Mail::to($email)->send(new ExampleMail($mailData));

        return redirect('/createpost');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $post = Post::with('user')->find($id);
        
        return view('post', compact('post'));

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
        //
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
        
        if(!Auth::user()->isAdmin){
            return response('Not Allowed', '401');
        }

        $post = Post::find($id);


        $mailData = $post->only('body','title');
        $email = Auth::user()->email;
        Mail::to($email)->send(new ExampleMail($mailData));

        $post->delete();

        return redirect('myposts')->with('status', 'Post successfully deleted');
        
    }
}