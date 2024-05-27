<?php

namespace App\Http\Controllers;

use App\Models\Admin\News;
use App\Models\Admin\NewsCategory;
use App\Models\Admin\TermRule;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index () {
        return view('public.index');
    }

    public function syarat_ketentuan ($type) {
        $term_rules = TermRule::first();
        return view('public.syarat-ketentuan', compact('term_rules', 'type'));
    }

    public function news () {
        $news = News::orderBy('id', 'desc')->where('status', true)->get();
        return view('public.syarat-ketentuan', compact('news'));
    }

    public function news_category_index ($category) {
        $news = News::where('news_category_id', $category)->orderBy('id', 'desc')->get();
        $is_category     = true;
        $news_categories = NewsCategory::orderBy('id', 'desc')->get();
        $news_category = NewsCategory::where('id', $category)->first();
        return view('public.news.index', compact('news', 'news_categories', 'is_category', 'news_category'));
    }

    public function news_index () {
        $news = News::orderBy('id', 'desc')->get();
        $is_category     = false;
        $news_categories = NewsCategory::orderBy('id', 'desc')->get();
        return view('public.news.index', compact('news', 'news_categories', 'is_category'));
    }

    public function news_show ($category, $slug) {
        $news_show = News::where('news_category_id', $category)->where('slug', $slug)->first();
        $news = News::whereNotIn('slug', [$slug])->orderBy('id', 'desc')->get();
        // dd($news);
        return view('public.news.show', compact('news', 'news_show'));
    }


}