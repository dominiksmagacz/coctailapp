<?php


namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;


class Posts extends Component

{
    public Post $post;
 
    protected $rules = [
        'post.title' => 'required|string|min:6',
        'post.content' => 'required|string|max:500',
        'post.image_path' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ];
    
       public function save()
       {
           $this->validate();
    
           $this->post->save();

        session()->flash('success', 'Artykuł został dodany !');

       }
   }
