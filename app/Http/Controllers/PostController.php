<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get()->toQuery()->paginate(5);

        $posts2 = Post::get()->toQuery()->paginate(5);


        return view('posts.index', compact('posts', 'posts2'));


        // return view ('blog.index', [
        //     'posts' => Post::orderBy('updated_at', 'desc')->get()
        // )];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => '',
            'author_id' => auth()->id()
        ]);
    
        return redirect()->route('posts.index')->with('message', 'Przepis został dodany.');;
            //dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'post' => Post::where('id', $id)->first()
            ]);
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
        //dd('test');

        Post::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect(route('posts.index'))->with('message', 'Przepis został zmodyfikowany.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route('posts.index'))->with('message', 'Artykuł został usunięty.');
    }


    public function search(Request $request)
    {
      
        $search = $request->input('searchInput');
        $posts = Post::where('title', 'LIKE', '%' . $search . '%')->paginate(5);
        $posts2 = $posts;

        if (count($posts) > 0)
            return view('posts.index', compact('posts', 'posts2'));
            else
            return view('posts.index', compact('posts', 'posts2'))->with('success', 'your message,here');
    }
}
