<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ChatsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Event\EventController;
use App\Http\Controllers\Admin\Jobs\JobsAppliedController;
use App\Http\Controllers\Admin\Jobs\JobsCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\User\ProfileController;
use App\Http\Controllers\Admin\User\UserSettingController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\Admin\Post\ArticleController;
use App\Http\Controllers\Admin\Post\CategoryController;
use App\Http\Controllers\Admin\Post\UploadController;
use App\Http\Controllers\Admin\Settings\ConfigurationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ScreenController;
use App\Http\Controllers\Frontend\ScreensController;
use App\Http\Controllers\Admin\Jobs\JobsController;
use App\Http\Controllers\Admin\Post\TagController;
use App\Http\Controllers\Admin\Asosiasi\AsosiasiController;
use App\Http\Controllers\Admin\Asosiasi\FinanceController;
use App\Http\Controllers\Admin\Asosiasi\GudieController;
use App\Http\Controllers\Admin\Asosiasi\JournalCollabController;
use App\Http\Controllers\Admin\Asosiasi\ManagerController;
use App\Http\Controllers\Admin\Asosiasi\MembershipController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Prosiding\AgendaController;
use App\Http\Controllers\Admin\Prosiding\NaskahController;
use App\Http\Controllers\Admin\Prosiding\PembayaranController;
use App\Http\Controllers\Admin\Prosiding\PesertaController;
use App\Http\Controllers\Admin\Prosiding\BidangIlmuController;
use App\Http\Controllers\Admin\Prosiding\Certificate;
use App\Http\Controllers\Frontend\JobsController as FrontendJobsController;
use App\Http\Controllers\Admin\Settings\RolePermissionController;
use App\Http\Controllers\Admin\Prosiding\CustomerCareController;
use App\Http\Controllers\Admin\Prosiding\RekeningController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Frontend\PagesController;
use App\Models\JournalCollaboration;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{slug}', [ScreenController::class, 'post']);
Route::get('/seminar/{slug}', [ScreenController::class, 'seminar']);
Route::post('apply', [FrontendJobsController::class, 'store'])->name('jobs-apply');
Route::get('/tag/{slug}', [ScreensController::class, 'tags']);
Route::get('/nota/{id}', [ScreenController::class, 'nota']);
Route::get('/page/{slug}', [ScreenController::class, 'page']);
Route::get('/videos', [ScreensController::class, 'videos']);
Route::get('/video', [ScreenController::class, 'video'])->name('videos.detail');

// menu
Route::get('/seminar-nasional', [ScreensController::class, 'seminarNasional']);
Route::get('/seminar-internasional', [ScreensController::class, 'seminarInternasional']);
Route::get('/posts', [ScreensController::class, 'posts']);
Route::get('/post/{slug}', [ScreenController::class, 'post'])->name('post.detail');
Route::get('/jurnal', [ScreensController::class, 'journals'])->name('journal.list');
Route::get('/jurnal-detail', [ScreenController::class, 'journal'])->name('journal.detail');
Route::get('/kegiatan', [ScreenController::class, 'kegiatan'])->name('kegiatan.detail');
Route::get('/agenda', [ScreensController::class, 'agenda'])->name('agenda');
Route::get('/anggota', [ScreensController::class, 'anggota'])->name('anggota');
Route::get('/anggota-detail', [ScreenController::class, 'anggota'])->name('anggota.detail');
Route::get('/contact', [ScreenController::class, 'contact']);
Route::get('/author', [ScreenController::class, 'author'])->name('author');

// BACKEND DASHBOARD
Route::group(['middleware' => ['role:anggota|super admin|writer|admin|peserta']], function () {
    Route::get('qrcodes', [QrCodeController::class, 'index']);
    Route::resource('friends', FriendsController::class);
    Route::controller(FriendsController::class)->group(function(){
        Route::get('/friends', 'friends')->name('profile.friends');
        Route::get('/friends/add/{id}', 'add')->name('addfriends');
        Route::get('/friends/delete/{id}', 'unfriends')->name('profile.friends.delete');
    });

    Route::prefix('cms')->group(function (){
        // data prosiding
        Route::prefix('asosiasi')->group(function (){
            // menu peserta
            Route::resource('upload-naskah', NaskahController::class);
            Route::resource('upload-pembayaran', PembayaranController::class);
            Route::resource('activity', ActivityController::class);
            Route::post('activity_update', [ActivityController::class, 'setBudget'])->name('activity.setBudget');
            Route::resource('journal_collab', JournalCollabController::class);


            Route::get('info', [AsosiasiController::class, 'info'])->name('asosiasi.info');
            Route::get('info/{slug}', [AsosiasiController::class, 'infoDetail'])->name('asosiasi.info-detail');
            Route::get('seminar', [AsosiasiController::class, 'seminar'])->name('asosiasi.seminar');
            Route::get('seminar/{slug}', [AsosiasiController::class, 'seminarDetail'])->name('asosiasi.seminar-detail');
            Route::get('sertifikat', [AsosiasiController::class, 'sertifikat'])->name('asosiasi.sertifikat');
            Route::get('sertifikat-member/{id}', [AsosiasiController::class, 'sertifikatDetail'])->name('ceritifiate-member.detail');
            Route::get('upload-naskah', [NaskahController::class, 'upload'])->name('asosiasi.upload-naskah');
            Route::get('bukti-pembayaran', [PembayaranController::class, 'uploadPembayaran'])->name('asosiasi.bukti-pembayaran');
            Route::get('panduan-user', [DashboardController::class, 'guide'])->name('user.guide');

            // admin access
            Route::group(['middleware' => ['role:admin|super admin|writer']], function () {
                Route::get('peserta', [PesertaController::class, 'index'])->name('asosiasi.peserta');
                Route::get('naskah', [NaskahController::class, 'naskah'])->name('asosiasi.naskah');
                Route::get('pembayaran', [PembayaranController::class, 'index'])->name('asosiasi.pembayaran');
                Route::get('link-prosiding', [AsosiasiController::class, 'prosidingNasional'])->name('asosiasi.nasional');

                Route::get('info-prosiding', [ArticleController::class, 'infoProsiding'])->name('asosiasi.table-info-prosiding');
                Route::get('template', [AsosiasiController::class, 'template'])->name('asosiasi.template');
                Route::get('journal-finance', [FinanceController::class, 'journal'])->name('finance.journal-afiliasi');
                Route::resource('finance', FinanceController::class);
                Route::resource('event', EventController::class);
                Route::resource('bidang-ilmu', BidangIlmuController::class);
                Route::resource('customer-care', CustomerCareController::class);
                Route::resource('agenda', AgendaController::class);
                Route::resource('certificate', Certificate::class);
                Route::resource('rekening', RekeningController::class);
                Route::resource('images', ImageController::class);
                Route::resource('imagecategories', ImageCategoryController::class);
                Route::resource('videos', VideoController::class);
                Route::resource('managers', ManagerController::class);
                Route::resource('memberships', MembershipController::class);

            });
        });


        Route::resource('articles', ArticleController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);

        Route::resource('chats', ChatsController::class);
        Route::resource('userssetting', UserSettingController::class);
        Route::post('changepassword', [UserSettingController::class, 'changePassword'])->name('changepassword');
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/profile', 'index')->name('profile.index');
        });

        Route::resource('guides', GudieController::class);
        Route::resource('menu', MenuController::class);
        Route::resource('pages', PageController::class);
        Route::resource('configuration', ConfigurationController::class);
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['role:super admin|admin']], function () {
    Route::resource('users', UserController::class);
    Route::get('/user/trashed', [UserController::class, 'showTrashed'])->name('usershowTrashed');

    // role permission
    Route::resource('role-permission', RolePermissionController::class);
    Route::get('/permission', [RolePermissionController::class, 'createPermission'])->name('permission');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('phpinfo', fn () => phpinfo());
Route::get('test', function(){
    $data = JournalCollaboration::where('status', 1)->orderByDesc('created_at')->get();
        return view('admin.asosiasi.finances.export-finance-journal', [
            'data' => $data,
        ]);
});
