<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\PageController;
use App\Models\Admin\Configuration;
use App\Models\Prosiding\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Butschster\Head\Facades\Meta;

class MetaController extends Controller
{
    public static function meta($slug){

        $web    = Configuration::where('status', 1)->first();
        $data   = PageController::article($slug);

        Meta::prependTitle($data->title)
                ->setContentType('text/html')
                ->setViewport('width=device-width, initial-scale=1')
                ->setDescription(Str::words(html_entity_decode($data->content), 15))
                ->setKeywords(explode(',', $data->tags))
                ->setRobots('nofollow,noindex')
                ->addMeta('author', [
                    'content' => 'aptii',
                ]);

        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('og_meta');

        $og->setType('website')
            ->setSiteName(config('app.name'))
            ->setTitle($data->title)
            ->setDescription(Str::words(html_entity_decode($data->content), 15))
            ->setUrl(config('app.url').'/post/'.$data->slug)
            ->setLocale('id_ID')
            ->addImage(asset('storage/pictures/post/16_9/mid/'.$data->image));

        $og->toHtml();
        Meta::registerPackage($og);

        $card = new \Butschster\Head\Packages\Entities\TwitterCardPackage('twitter_meta');

        $card->setType('summary')
        ->setSite('@aptii')
        ->setTitle($data->title)
        ->setDescription(Str::words(html_entity_decode($data->content), 15))
        ->setCreator('@aptii')
        ->setImage(asset('storage/pictures/post/16_9/mid/'.$data->image))
        ->addMeta('image:alt', $data->title);

        $card->toHtml();
        Meta::registerPackage($card);
    }

    public static function metaSeminar($slug){

        $web    = Configuration::where('status', 1)->first();
        $data   = Event::where('slug', $slug)->first();

        Meta::prependTitle($data->judul)
                ->setContentType('text/html')
                ->setViewport('width=device-width, initial-scale=1')
                ->setDescription(Str::words(html_entity_decode($data->keterangan), 15))
                ->setKeywords($data->judul)
                ->setRobots('nofollow,noindex')
                ->addMeta('author', [
                    'content' => 'aptii',
                ]);

        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('og_meta');

        $og->setType('website')
            ->setSiteName(config('app.name'))
            ->setTitle($data->judul)
            ->setDescription(Str::words(html_entity_decode($data->keterangan), 15))
            ->setUrl(config('app.url').'/post/'.$data->slug)
            ->setLocale('id_ID')
            ->addImage($data->imageFull);

        $og->toHtml();
        Meta::registerPackage($og);

        $card = new \Butschster\Head\Packages\Entities\TwitterCardPackage('twitter_meta');

        $card->setType('summary')
        ->setSite('@aptii')
        ->setTitle($data->judul)
        ->setDescription(Str::words(html_entity_decode($data->content), 15))
        ->setCreator('@aptii')
        ->setImage($data->imageFull)
        ->addMeta('image:alt', $data->judul);

        $card->toHtml();
        Meta::registerPackage($card);
    }

    public static function journal($data){
        Meta::prependTitle($data->title)
                ->setContentType('text/html')
                ->setViewport('width=device-width, initial-scale=1')
                ->setDescription(Str::words(html_entity_decode($data->title), 15))
                ->setKeywords(['jurnal', 'afiliasi', 'aptii'])
                ->setRobots('nofollow,noindex')
                ->addMeta('author', [
                    'content' => 'aptii',
                ]);

        $og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('og_meta');

        $og->setType('website')
            ->setSiteName(config('app.name'))
            ->setTitle($data->title)
            ->setDescription(Str::words(html_entity_decode($data->title), 15))
            ->setUrl(route('journal.detail', ['judul' => $data->slug ]))
            ->setLocale('id_ID')
            ->addImage($data->imageUrl);

        $og->toHtml();
        Meta::registerPackage($og);

        $card = new \Butschster\Head\Packages\Entities\TwitterCardPackage('twitter_meta');

        $card->setType('summary')
        ->setSite('@aptii')
        ->setTitle($data->title)
        ->setDescription(Str::words(html_entity_decode($data->title), 15))
        ->setCreator('@aptii')
        ->setImage($data->imageUrl)
        ->addMeta('image:alt', $data->title);

        $card->toHtml();
        Meta::registerPackage($card);
    }
}
