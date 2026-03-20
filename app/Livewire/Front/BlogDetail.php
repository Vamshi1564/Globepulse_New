<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\ArticleDetails;


class BlogDetail extends Component
{

    public $blog;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $slug;

    public function mount($slug)
    {
        // Fetch single blog by slug
        $this->blog = ArticleDetails::where('slug', $slug)->firstOrFail();



        $this->meta_title = $this->blog->meta_title ?? null;
        $this->meta_description = $this->blog->meta_description ?? null;
        $this->meta_keywords = $this->blog->meta_keywords ?? null;
        $this->slug = $this->blog->slug ?? null;
    }
    public function render()
    {
        return view('livewire.front.blog-detail');
    }
}
