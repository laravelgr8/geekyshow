how to define gates:-
define()
allow()
denies()
forUser()
any()
none()
authorize()
check()
can()
cannot()
insepect()
before()
after()

on blade:-
@can
@cannot
@canany



Where write the gates method:-
Gates are define within the boot method of the App\Provider\AuthServiceProvider
use illuminate\Support\Facades\Gate;
public function boot()
{
	$this->registerPolicies();//allready exist in boot method
	Gate::define('isAdmin',function($user){
		if($user->email==='suman@gmail.com')
		{
			return true;
		}
		else
		{
			return false;
		}
	});
}




Another way to write Gate code:
create a folder in App, Folder name Gate
App\Gate\AdminGate.php
<?php 

namespace App\Gate;
class AdminGate
{
	public function check_admin($user)
	{
		if($user->email==='suman@gmail.com')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}


Now you go to boot method of AuthServiceProvider
use illuminate\Support\Facades\Gate;
use App\Gate\AdminGate;
public function boot()
{
	$this->registerPolicies();
	Gate::define('isAdmin',[AdminGate::class,'check_admin']);
}




How to check by middleware
Route::get('/post',[PostController::class,'index'])->middleware(['auth','can:isAdmin']);

How to check on blade
@can('isAdmin')
//
@endcan

@cannot()...@endcannot

$canany()...@endcanany



How to check on controller:-
public function edit($id)
{
	$post=Post::find($id);
	if(Gate::deines('isAdmin',$post))
	{
		abort(403);
	}
	return view('edit',compact('post'));
}
