<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\ArticleDetails;
use App\Models\Categories;

class BlogPage extends Component
{

    public $blogs;
    public $pageTitle;
    public $categoryName;
    public $authorName;
    public $totalBlogs;
    public $isCategory = false;
    public $isAuthor = false;
    public $currentPage = 1;
    public $perPage = 9;

    public function mount($category = null, $name = null)
    {
        $this->loadBlogs($category, $name);
    }

    public function loadBlogs($category = null, $name = null)
    {
        // Category filter
        if ($category) {
            $categoryModel = Categories::where('slug', $category)->first();

            if ($categoryModel) {
                $this->isCategory = true;
                $this->categoryName = $categoryModel->name;
                $this->pageTitle = $categoryModel->name;

                $allBlogs = ArticleDetails::with('Categories', 'Author')
                    ->whereHas('Categories', function ($q) use ($categoryModel) {
                        $q->where('id', $categoryModel->id);
                    })
                    ->where('is_published', 1)
                    ->where('domain_type', 'glob_pulse')
                    ->latest()
                    ->get();

                $this->totalBlogs = $allBlogs->count();
                $this->blogs = $allBlogs->forPage($this->currentPage, $this->perPage);
                return;
            }
        }

        // Author filter
        if ($name) {
            $this->isAuthor = true;
            $this->authorName = ucwords(str_replace('-', ' ', $name));
            $this->pageTitle = "Posts by " . $this->authorName;

            $allBlogs = ArticleDetails::with('Categories', 'Author')
                ->whereHas('Author', function ($q) use ($name) {
                    $q->where('name', 'LIKE', str_replace('-', ' ', $name));
                })
                ->where('is_published', 1)
                ->where('domain_type', 'glob_pulse')

                ->latest()
                ->get();

            $this->totalBlogs = $allBlogs->count();
            $this->blogs = $allBlogs->forPage($this->currentPage, $this->perPage);
            return;
        }

        // Default all blogs
        $allBlogs = ArticleDetails::with('Categories', 'Author')
            ->where('is_published', 1)
            ->where('domain_type', 'glob_pulse')
            ->latest()
            ->get();

        $this->pageTitle = "B2B Marketplace Blog, Trade News & Global Business Insights";
        $this->totalBlogs = $allBlogs->count();
        $this->blogs = $allBlogs->forPage($this->currentPage, $this->perPage);
    }

    // === Pagination functions ===
    public function gotoPage($page)
    {
        $this->currentPage = $page;
        $this->loadBlogs(
            $this->isCategory ? request()->segment(2) : null,
            $this->isAuthor ? request()->segment(2) : null
        );
    }

    public function nextPagePost()
    {
        if ($this->currentPage < ceil($this->totalBlogs / $this->perPage)) {
            $this->gotoPage($this->currentPage + 1);
        }
    }

    public function prevPagePost()
    {
        if ($this->currentPage > 1) {
            $this->gotoPage($this->currentPage - 1);
        }
    }

    // === Limit words with HTML preserve ===
    public function limitWordsHtml($html, $limit = 50)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $textWords = 0;
        $truncated = '';
        $body = $dom->getElementsByTagName('body')->item(0);

        foreach ($body->childNodes as $node) {
            if ($textWords >= $limit) break;
            $truncated .= $this->truncateNode($node, $limit - $textWords, $textWords);
        }

        return $truncated;
    }

    private function truncateNode($node, $remainingWords, &$textWords)
    {
        if ($textWords >= $remainingWords) return '';

        if ($node->nodeType === XML_TEXT_NODE) {
            $words = preg_split('/\s+/', $node->nodeValue, -1, PREG_SPLIT_NO_EMPTY);
            $toTake = min(count($words), $remainingWords - $textWords);
            $textWords += $toTake;
            return implode(' ', array_slice($words, 0, $toTake)) . ($textWords >= $remainingWords ? '...' : ' ');
        }

        $inner = '';
        foreach ($node->childNodes as $child) {
            if ($textWords >= $remainingWords) break;
            $inner .= $this->truncateNode($child, $remainingWords, $textWords);
        }

        $outer = '<' . $node->nodeName;
        if ($node->hasAttributes()) {
            foreach ($node->attributes as $attr) {
                $outer .= ' ' . $attr->nodeName . '="' . $attr->nodeValue . '"';
            }
        }
        $outer .= '>' . $inner . '</' . $node->nodeName . '>';

        return $outer;
    }
    public function render()
    {
        return view('livewire.front.blog-page');
    }
}
