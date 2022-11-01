<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;


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

Route::get('/', function () {
    //return "Mogy";
    return view('welcome');
});
/*
Route::get('/test', function () {
    $testname = "tarek";
    return view(view:'test', data:['name'=>$testname]);
});
*/
Route::get('posts', [PostController::class,'index'])
->name('posts.index')
->middleware('auth');
Route::get('posts/create',[PostController::class, 'create'])
->name('posts.create')
->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])
->name('posts.show')
->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
->name('posts.edit')
->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])
->name('posts.update')
->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'delete'])
->name('posts.destroy')
->middleware('auth');
Route::post('posts', [PostController::class, 'store'])
->name('posts.store')
->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
    return redirect()->route('posts.index');

    // $user->token
});

//sign in with google

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    // dd($googleUser);
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
    ]);
    Auth::login($user);
    return redirect('/');
    // $user->token
});
