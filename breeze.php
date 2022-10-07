install breeze:-
composer require laravel/breeze --dev
php artisan breeze:install

use illuminate\Support\Facades\Auth;
get login user ful detal
Auth::user()

if you want get only id of logined user
Auth::id();

if you want to get only name of logined user
Auth::user()->name;

if you want to get logined user detail from request
public function index(Request $request)
{
    return $request->user();
}


if you want to check user is logined or not
if(Auth::check())
{
	//
}



if you want to restrist route, logined user access and without logined not access
Route::get('/get',[PostController::class,'index'])->middleware('auth');

ye middleware default kernal.php me add rahta hai
'auth' => \App\Http\Middleware\Authenticate::class,
