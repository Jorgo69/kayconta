<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\Admin\AdminAddAuthorsComponent;
use App\Http\Livewire\Admin\AdminAddChapterComponent;
use App\Http\Livewire\Admin\AdminAddChapters;
use App\Http\Livewire\Admin\AdminAddGenresComponent;
use App\Http\Livewire\Admin\AdminAddMangasComponent;
use App\Http\Livewire\Admin\AdminAuthor;
use App\Http\Livewire\Admin\AdminChapters;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditAuthorsComponent;
use App\Http\Livewire\Admin\AdminEditChaptersComponent;
use App\Http\Livewire\Admin\AdminEditGenresComponent;
use App\Http\Livewire\Admin\AdminEditMangasComponent;
use App\Http\Livewire\Admin\AdminEditStreamersComponent;
use App\Http\Livewire\Admin\AdminGenresComponent;
use App\Http\Livewire\Admin\AdminMangasComponent;
use App\Http\Livewire\Admin\AdminStreamersComponent;
use App\Http\Livewire\Admin\AdminViewDemandeDetailComponent;
use App\Http\Livewire\Author\AuthorAddChapterComponent;
use App\Http\Livewire\Author\AuthorAddChapterMangaComponent;
use App\Http\Livewire\Author\AuthorAddMangaComponent;
use App\Http\Livewire\Author\AuthorDashboardComponent;
use App\Http\Livewire\Author\AuthorEditChapterComponent;
use App\Http\Livewire\Author\AuthorEditMangaComponent;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CommentsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ListeComponent;
use App\Http\Livewire\ListeMangaComponent;
use App\Http\Livewire\NotFoundComponent;
use App\Http\Livewire\StreamingComponent;
use App\Http\Livewire\TermsComponent;
use App\Http\Livewire\User\DashboardComponent;
use App\Http\Livewire\User\UserFavoritesComponent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/cache', function() {
    Artisan::call('inspire');
    return Artisan::output();
});

Route::get('/', HomeComponent::class)->name('home.index');

Route::get('listes/{slug}', ListeComponent::class)->name('manga.chapters.liste');

Route::get('liste/{slug}', ListeMangaComponent::class)->name('manga.liste');

Route::get('streaming/{chapter_id}', StreamingComponent::class)->name('chapter.streaming');

Route::get('comments/{chapter_id}', CommentsComponent::class)->name('chapter.comment');

Route::get('category', CategoryComponent::class)->name('category.index');

Route::get('about', AboutComponent::class)->name('about.index');

Route::get('terms', TermsComponent::class)->name('terms.index');

Route::get('blog', BlogComponent::class)->name('blog.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('user/favorites', UserFavoritesComponent::class)->name('user.favorites');
    Route::get('user/dashboard', DashboardComponent::class)->name('user.dashboard');

});

Route::middleware(['auth', 'auth.admin'])->group(function(){
    Route::get('/admin/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('admin/streamers', AdminStreamersComponent::class)->name('admin.streamers');
    Route::get('admin/stremers/edit/{user_id}', AdminEditStreamersComponent::class)->name('admin.streamers.edit');


    Route::get('admin/mangas', AdminMangasComponent::class)->name('admin.mangas');
    Route::get('admin/mangas/add', AdminAddMangasComponent::class)->name('admin.add.mangas');
    Route::get('admin/mangas/edit/{mangas_id}', AdminEditMangasComponent::class)->name('admin.edit.mangas');


    Route::get('admin/genres', AdminGenresComponent::class)->name('admin.genres');
    Route::get('admin/genres/edit/{genre_id}', AdminEditGenresComponent::class)->name('admin.edit.genres');
    Route::get('admin/genres/add', AdminAddGenresComponent::class)->name('admin.add.genres');


    Route::get('admin/chapters', AdminChapters::class)->name('admin.chapters');
    Route::get('admin/add/chapters', AdminAddChapterComponent::class)->name('admin.add.chapter');
    Route::get('admin/chapters/adds/{id}', AdminAddChapters::class)->name('admin.add.chapters');
    Route::get('admin/chapters/edit/{chapters_id}', AdminEditChaptersComponent::class)->name('admin.edit.chapters');


    Route::get('admin/view/{id}/detail/', AdminViewDemandeDetailComponent::class)->name('admin.view.details');
});


Route::middleware(['auth', 'auth.author'])->group(function(){
    Route::get('author/dashboard', AuthorDashboardComponent::class)->name('author.dashboard');

    Route::get('auhtor/manga/add', AuthorAddMangaComponent::class)->name('author.manga.add');
    Route::get('author/manga/{mangas_id}/edit/', AuthorEditMangaComponent::class)->name('author.manga.edit');


    Route::get('author/chapter/add', AuthorAddChapterComponent::class)->name('author.chapter.add');
    Route::get('author/chapter/manga/add/{id}', AuthorAddChapterMangaComponent::class)->name('author.chapter-manga.add');
    Route::get('author/chapter/{chapters_id}/edit', AuthorEditChapterComponent::class)->name('author.chapter.edit');



});

require __DIR__.'/auth.php';
