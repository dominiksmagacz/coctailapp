<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

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
    public function store(StorePostRequest $request)
    {

        // dd($request);
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $this->storeImageinStore($request),
            'author_id' => auth()->id()
        ]);
        
    
        return redirect()->route('posts.index')->with('message', 'Przepis został dodany.');
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
    public function update(UpdatePostRequest $request, $id)
    {
        // dd($request->file('image_path'));
        Post::where('id', $id)->update($request->except(['_token', '_method']));

        // Post::updated([
        //     'image_path' => $this->storeImageinStore($request),
        // ]);

        Post::where('id', $id)->update(['image_path' => $this->storeImageinStore($request)]);
        // $file = request()->file('image_path');
        // $file->store(public_path('public'));
        // dd($request);
        // $imageName = time().'.'.$request->file('image_path')->getClientOriginalExtension();
        // $request->file('image_path')->move(public_path('images'), $imageName);
        // dd($cs);

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
        $posts = Post::with('user')     
        ->when($search, function ($query) {
            $query->where(function($q) {
                $q->where('title', 'like', '%'.request('searchInput'). '%')
                ->orWhere('content', 'like', '%'.request('searchInput'). '%');
        });
    })->paginate(5);

        if ( $posts->total() > 0)
            return view('posts.index', compact('posts'));
            else
            return view('posts.index', compact('posts'))->with('success', 'your message,here');
    }


    private function storeImage($request)
    {
        //do zmiany na Store::....
        $imageName = time().'.'.$request->image_path->extension();  
        $request->image_path->move(public_path('images'), $imageName);

        return public_path('images'.'/'.$imageName); 
    }

    private function storeImageinStore($request){
        $path = $request->file('image_path')->store('public');
 
        return $path;
    }
}
