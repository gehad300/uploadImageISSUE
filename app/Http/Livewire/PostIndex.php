<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PostIndex extends Component
{
    use WithFileUploads;
    public $showingPostModal = false;
    public $title;
    public $image;
    public $body;
    public $oldImage;
    public $isEditMode;
    public $post;

    public function ShowPostModal()
    {
        $this->reset();
        $this->showingPostModal = true;
    }
    public function storePost()
    {
        $this->validate([
            'image' => 'image|max:1024',
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($this->image) {
            $file     = $this->image;
            $filename = Str::random(5).$file->getClientOriginalName();
            $file->move(public_path()."/images/posts/", $filename);
            $input['image'] = $filename;
         }
        Post::create([
            'title' => $this->title,
            'image' => $input['image'] ,
            'body' => $this->body,
        ]);
        $this->reset();
    }
    public function showEditPostModal($id)
    {
        $this->post = Post::findOrFail($id);
        $this->title = $this->post->title;
        $this->body = $this->post->body;
        $this->isEditMode = true;
        $this->oldImage = $this->post->image;
        $this->showingPostModal = true;
    }
    public function UpdatePost()
    {
        $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $image = $this->post->image;
        if ($this->image) {
            $image = $this->image->store('public/posts');
        }
        $this->post->update([
            'title' => $this->title,
            'image' => $image,
            'body' => $this->body,
        ]);
        $this->reset();
        # code...
    }
    public function deletePost($id)
    {
       $post= Post::findOrFail($id);
       Storage::delete($post->image);
       $post->delete();
        $this->reset();
        # code...
    }
    public function render()
    {
        return view('livewire.post-index', [
            'posts' => Post::all()
        ]);
    }
}
