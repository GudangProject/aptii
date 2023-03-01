<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\PagesController;
use App\Models\Admin\Configuration;
use App\Models\JournalCollaboration;
use App\Models\Membership;
use App\Models\Prosiding\Agenda;
use App\Models\Prosiding\ProsidingNaskah;
use App\Models\User;
use App\Models\Video;
use Butschster\Head\Facades\Meta;
use RobertSeghedi\News\Models\Article;

class ScreensController extends Controller
{
    public function posts(Request $request, PagesController $page){
        HomeController::meta('Artikel Asosiasi');
        return view('client.screens.posts', [
            'data'      => $page->articles(12, $request->page),
            'headline'  => $page->headlineArticles(),
        ]);
    }

    public function tags(PagesController $page, $slug){
        HomeController::meta('Tags');

        return view('frontend.tags.index', [
            'slug'      => $slug,
            'headline'  => $page->headlineArticles(),
        ]);
    }

    public function seminarNasional(Request $request, PagesController $page){
        HomeController::meta('Seminar Nasional');

        return view('frontend.events.nasional');
    }

    public function seminarInternasional(Request $request, PagesController $page){
        HomeController::meta('Seminar Internasional');

        return view('frontend.events.internasional');
    }

    public function journals(Request $request){
        HomeController::meta('Jurnal Terafiliasi Asosiasi'.website()->name);

        if($request->search){
            $data = JournalCollaboration::where('title', 'LIKE', "%{$request->search}%")->orderByDesc('created_at')->where('status', true)->paginate(20);
            // dd($uid);
        }else{
            $data = JournalCollaboration::orderByDesc('created_at')->where('status', true)->paginate(20);
        }

        return view('client.screens.journals', [
            'data'          => $data,
            'popular'       => PagesController::popularArticle(),
            'activities'    => PagesController::activities(),
            'agenda'        => PagesController::agenda(),
        ]);
    }

    public function agenda(){
        HomeController::meta('Agenda');

        $data = Agenda::orderByDesc('created_at')->where('status', true)->paginate(20);

        return view('client.screens.agenda', [
            'data'          => $data,
            'popular'       => PagesController::popularArticle(),
            'activities'    => PagesController::activities(),
            'agenda'        => PagesController::agenda(),
        ]);
    }

    public function anggota(Request $request){
        HomeController::meta('Anggota');

        if($request->search){
            $uid  = User::where('name', 'LIKE', "%{$request->search}%")->pluck('id');
            $data = Membership::whereIn('user_id', $uid)->orderBy('created_at')->paginate(20);
            // dd($uid);
        }else{
            $data = Membership::orderBy('created_at')->paginate(20);
        }

        return view('client.screens.anggota', [
            'data'          => $data,
            'popular'       => PagesController::popularArticle(),
            'activities'    => PagesController::activities(),
            'agenda'        => PagesController::agenda(),
        ]);
    }

    public function videos(){
        HomeController::meta('Video');

        $data = Video::orderByDesc('created_at')->paginate(12);

        return view('client.screens.videos', [
            'data'          => $data,
        ]);
    }


}
