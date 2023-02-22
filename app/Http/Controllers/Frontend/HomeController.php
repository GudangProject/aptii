<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Configuration;
use App\Models\Image;
use App\Models\Post\PostArticles;
use App\Models\Prosiding\CustomerCare;
use App\Models\Prosiding\ProsidingNaskah;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use RobertSeghedi\News\Models\Article;

class HomeController extends Controller
{
    public function index(){
        self::meta('Home');
        $statistics = [
            'posts' => PostArticles::where('status', true)->get()->count(),
            'users' => User::where('status', true)->get()->count(),
            'naskah' => ProsidingNaskah::where('status', true)->get()->count(),
        ];
        // dd(PagesController::prosidingInfo());
        $banners = array([
            'header' => Image::where('status', true)->where('category_id', 1)->orderByDesc('created_at')->get(),
            'header_right_top' => Image::where('status', true)->where('category_id', 2)->orderByDesc('created_at')->get(),
            'header_right_bottom' => Image::where('status', true)->where('category_id', 3)->orderByDesc('created_at')->get(),
            'home_center_left' => Image::where('status', true)->where('category_id', 5)->orderByDesc('created_at')->get(),
            'home_center_right' => Image::where('status', true)->where('category_id', 6)->orderByDesc('created_at')->get(),
        ]);

        return view('client.home', [
            'banner'        => $banners,
            'recent'        => PagesController::recentArticles(4),
            'headline'      => PagesController::headlineArticles(),
            'events'        => PagesController::events(),
            'agenda'        => PagesController::agenda(),
            'activities'    => PagesController::activities(),
            'prosidingInfo' => PagesController::prosidingInfo(),
            'posts'         => PagesController::articles(6, null),
            'statistics'    => $statistics,
            'customerCare'  => CustomerCare::where('status', true)->get(),
            'videos'        => Video::where('status', 1)->orderByDesc('created_at')->paginate(3),
        ]);
    }

    public static function meta($title)
    {
        $web = Configuration::where('status', 1)->first();
        Meta::prependTitle($title)
                ->setContentType('text/html')
                ->setViewport('width=device-width, initial-scale=1')
                ->setDescription($web->description)
                ->setKeywords(explode(',', $web->tags))
                ->setRobots('nofollow,noindex')
                ->addMeta('author', [
                    'content' => $web->getOwner->name,
                ]);

        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('og_meta');

        $og->setType('website')
            ->setSiteName($web->name)
            ->setTitle('Beranda')
            ->setDescription($web->description)
            ->setUrl(config('app.url'))
            ->setLocale('id_ID')
            ->addImage(asset('storage/images/logo').'/'.$web->logo);

        $og->toHtml();
        Meta::registerPackage($og);

        $card = new \Butschster\Head\Packages\Entities\TwitterCardPackage('twitter_meta');

        $card->setType('summary')
            ->setSite('@jarwonoztech')
            ->setTitle($web->name)
            ->setDescription($web->description)
            ->setCreator('@jarwonoztech')
            ->setImage(asset('storage/images/logo').'/'.$web->logo)
            ->addMeta('image:alt', $web->name);

        $card->toHtml();
        Meta::registerPackage($card);
    }
}
