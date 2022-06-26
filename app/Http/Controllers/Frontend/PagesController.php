<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RobertSeghedi\News\Models\Article;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public static function articles($limit){
        $data = Cache::rememberForever('articles', function () use($limit) {
            $rows = Article::orderByDesc('created_at')->paginate($limit)->withQueryString();
            return $rows;
        });
        return $data;
    }

    public static function recentArticles($limit){
        $data = Cache::rememberForever('recent-articles', function () use($limit) {
            $rows = Article::orderByDesc('created_at')->paginate($limit);
            return $rows;
        });
        return $data;
    }

    public static function headlineArticles($limit){
        $data = Cache::rememberForever('headline', function () use($limit) {
            $rows = Article::where('type', 1)->orderByDesc('created_at')->paginate($limit);
            return $rows;
        });
        return $data;
    }

    public static function sliderArticles($limit){
        $data = Cache::rememberForever('slider', function () use($limit) {
            $rows = Article::where('type', 2)->orderByDesc('created_at')->paginate($limit);
            return $rows;
        });
        return $data;
    }
}
