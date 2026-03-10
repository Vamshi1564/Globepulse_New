<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Component;

class TextEditor extends Component
{

    public $post_id;
    public $title;
    public $slug;
    public $content;
    public function mount($id = null)
    {
        if ($id) {
            $this->post_id = $id;
            $post = BlogPost::findOrFail($id);
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->content = $post->description;
        }
    }

    public function save()
    {
        // try {
        //     $this->validate([
        //         'title' => 'required|string|max:255',
        //         'slug' => 'required|string|max:255|unique:tbl_blog,slug',
        //         'content' => 'required|string',
        //     ]);

        //     BlogPost::create([
        //         'title' => $this->title,
        //         'slug' => $this->slug,
        //         'description' => $this->content,
        //     ]);
        // } catch (\Exception $e) {
        //     session()->flash('error', 'Blog post not saved!' . $e);
        //     // See the actual error
        // }

        // session()->flash('message', 'Blog post saved successfully!');


        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tbl_blog,slug,' . $this->post_id,
            'content' => 'required|string',
        ];

        $this->validate($rules);

        try {
            if ($this->post_id) {
                // Update existing
                $post = BlogPost::findOrFail($this->post_id);
                $post->update([
                    'title' => $this->title,
                    'slug' => $this->slug,
                    'description' => $this->content,
                ]);
                session()->flash('message', 'Blog post updated successfully!');
            } else {
                // Create new
                BlogPost::create([
                    'title' => $this->title,
                    'slug' => $this->slug,
                    'description' => $this->content,
                ]);
                session()->flash('message', 'Blog post saved successfully!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Blog post not saved! ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.text-editor');
    }
}
