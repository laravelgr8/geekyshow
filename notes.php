For Error File design:
php artisan vendor:publish --tag=laravel-errors
=============================
First Time Install :-
composer global require laravel/installer

Create Project:-
laravel new projectName

go to c drive cd.. and change drive d:


laravel project start:-
php artisan serve

==============================
Route:-

return string by route-
Route::get('about',function(){
    return "Hello World";
});

Route With parameter:-
Route::get('about/{id}',function($id){
    return "Hello World ".$id;
});

Optional Parameter:-
Route::get('about/{id?}',function($id=null){
    return "Hello World ".$id;
});


Route parameter and regular expression:-
Route::get('about/{id?}',function($id=null){
    return "Hello World ".$id;
})->where("id",'[0-9]+');

Route::get('about/{id?}',function($id=null){
    return "Hello World ".$id;
})->where("id",'[A-Za-z]+');

Route::get('about/{id?}/{name?}',function($id=null,$name=null){
    return "Hello World ".$id.$name;
})->where(["id"=>'[0-9]+',"name"=>"[A-Za-z]+"]);

Route parameter with regular helper:-
Route::get('about/{id?}/{name?}',function($id=null,$name=null){
    return "Hello World ".$id.$name;
})->whereNumber('id')->whereAlpha('name');



Redirect Route:-
Route::redirect('yaha','waha');

Fallback:-jab koi url match na ho lo last me ye show hoga
Route::fallback(function(){
    return "Not Found";
});

route::get('home',UserController::class,'show');
route::post('home',UserController::class,'show');
route::put('home',UserController::class,'show');

using multiple method:-
Route::match(['get','post'],'/',function(){

});

Route::any('/',function(){

});
==========================================


View :-
view call by route:
Route::get('home',function(){
    return view('home');
});

or
Route::view('hom','home');

agar view folder ke under ho -
Route::view('hom','user.home');

passing data from route to view:-
Route::get('home',function(){
    return view('home',["name"=>"suman"]);
});
on view {{$name}}
or
Route::view('hom','home',["name"=>"neha"]);
or
Route::view('ho','home')->with('name','rahul');


Route::get('main/{id?}',function($id=null){
    return view('home',["id"=>$id]);
});
on view {{$id}}

=============================================
Controller:-
make controller:
php artisan make:controller controllerName

Fist call controller on route
use App\Http\Controllers\UserController;

Create Route for controller:
Route::get('user',[UserController::class,'show']);

Pass parameter from route to controller:
Route::get('user/{name}',[UserController::class,'show']);
on controller:
function show($name)
{
    return $name;
}

optional parameter pass from route to controller:
Route::get('user/{name?}',[UserController::class,'show']);
on controller
function show($name=null)
{
    return "User Controller call by route".$name;
}

How to view call by controller:
function show($name=null)
{
    return view('home',["name"=>$name]);
}
on view:
{{$name}}
on Route:
Route::get('user/{name?}',[UserController::class,'show']);

====================================
Blade:-
data ko display kara sakte hai curly braces se {{}}
{{}} it is a blade echo system.
ye xss attack se v safe karta hai.
function ko v call kar sakte hai {{myfun()}}
{{--comment--}}

conditional statement use in blade:
@if(condition)
  .........
@else if(condation)
  ........
@else
  .........
@endif


how to use isset:
@isset($age)
<h2>Value Set</h2>
@endisset


@empty($age)
<h2>age is empty</h2>
@endempty


@switch($age)
    @case (15)
    <h2>You Are Young</h2>
    @break

    @case (25)
    <h2>You Are Yealder</h2>
    @break

    @case (10)
    <h2>You Are Small</h2>
    @break

    @default
    <h2>You Are Old</h2>    
@endswitch



@for($i=0;$i<=5;$i++)
<h2>Hello World</h2>
@endfor


How to use Foreach
on controller:
function show()
{
    $ary=["A"=>10,"b"=>20,"c"=>30];
    return view('home',["ary"=>$ary]);
}
On View:
@foreach($ary as $key=>$value)
<h2>{{$value}}</h2>
@endforeach


forelse: 
ye check karta hai ki array empty hai ya nahi.
function show()
{
    $ary=["A"=>10,"b"=>20,"c"=>30];
    return view('home',["ary"=>$ary]);
}

On View:
@forelse($ary as $value)
<h2>{{$value}}</h2>
@empty
<h2>Array Is Empty</h2>
@endforelse


break:
function show()
{
    $ary=["A"=>10,"b"=>20,"c"=>30];
    return view('home',["ary"=>$ary]);
}
on view:
@foreach($ary as $v)
@if($v==20)
    @break
@endif
<h2>{{$v}}</h2>
@endforeach

===================================

include:-
@include('home');

@includeIf('home')

==================================
How to write plane php code in laravel:-
@php
echo "Hello";
@endphp

=================================
Component : 
ek code ko bar 2 use kar sakte hai.
method
class based component
anonymous component

How to component create:
php artisan make:component component_name


create new file in view->component   //its view file
also create a php file in app/view/components   //its php file
<x-component_name />

first create a component whose name Card.
goto recource/view/component/Card.blade.php
and write code.
<div>
    <h2>Card Title</h2>
    <h2>Card Sub Titel</h3>
        <p>It's Description</p>
</div>

and call on view 
<x-Card />

Component ko dynemic data kaise pas kare
first go to app/view/component/componentName.php

public $title;
public $desc;
public function __construct($title,$desc)
{
    $this->title=$title;
    $this->desc=$desc;
}

Now go to view->component->componentName.blade.php
<h2>{{$title}}</h2>
<h2>{{$desc}}</h2>

Now go to view
@php
$desc="This Is description";
@endphp
<x-Card title="my Title" :desc=$desc/>

How to pass function in component:-
public function sumNum($a)
{
    return $a+20;
}
On card.blade.php
{{$sumNum(10)}}


anonymous component:
isme class wala file ka use nahi karna parta hai.
on card.blade.php
<div>
    <h2>{{$title}}</h2>
    <p>{{$desc}}</p>
</div>

on view:
<x-Card title="my Title"/>
<x-Card desc="my description"/>

============================
sloat :
on view:
<x-Card>
<h2>This is Slot part of component</h2>
</x-Card>

resource->view->component:
{{$slot}}

Named slot:
on view:
<x-Card>
    <x-slot name="title">Hello I Am Title</x-slot>
</x-Card>
resource->view->component:
{{$title}}

===============================
Layout :
iska use code ko reduce karne ke liye karte hai taki same code har page par likhna na ho.
Two way to create layout-
(1)Layput Using Component
(2)Layout Using Template Inheritance 

Layput Using Component:
first create a component
php artisan make:component Layout
goto resources->view->component->Layout.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>
<body>
   {{$slot}} 
    
    
</body>
</html>

on view:
<x-layout>
    <x-slot name="title">Home</x-slot> 
    Hello I am Content
</x-layout>

15 not read

==================================
Adding Css and JS:-
Public Folder :
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{url('css/style.css')}}">

==================================
How to add Image :-
Public Folder :
<img src="img/mypic.jpg">
<img src="{{asset('img/mypic.jpg')}}">

=================================
Named Route:-
Route::get("Home",[UserController::class,'show'])->name('hom');
now call
<a href="{{route('hom')}}" >Home </a>

<a href="{{route('hom',['id'=>'12'])}}" >Home </a>
Route::get("Home/{id}",[UserController::class,'show'])->name('hom');
or
<a href="{{route('hom',['id'=>'12'])}}" >Home </a>
Route ::get('Home/{id}',function($id){
    return view('home',["id"=>$id])
})->name('hom');
========================================

Middleware :-
php artisan make:middleware middleware_name

Global Middleware :
first create middle ware
php artisan make:middleware UnderConstruction

check app->http->middleware->yourfile

For UnderConstruction in Global Middleware
first open your middleware file whose you create and impoer this on above page
use Symfony\Component\HttpKernel\Exception\HttpException;
now go to handel function 
public function handle(Request $request, Closure $next)
{
    throw new HttpException(503);
}

now open kernel page and active your middleware

Route Middleware:
sirf kiski ek route par middleware use karna ho.
On route:-
Route::get("report",[ReportController::class,'show'])->middleware("construction");

Group Middleware:
ek key par multiple middleware create kar sakte hai. look kernel page. ek key ke under multiple middleware call kiya huaa hai.
=============================

Form:-
all form value recive:
    $request->all()
    $request->input()

Single value recive:
$request->input('name');
$request->name;

$request->has();
$request->hasAny();
$request->filled();
$request->missing();

redirect kaise karte hai route name se.
return redirect()->route('name');


Form Validation:
1.validate method
2.form request validation

validate rule:
alpha: only alpha
alpha_dash:alpha-numeric,dashes and underscore
alpha_num:alpha numeric
date:
digits:value:-
email:
file:
filled: not empty
image: 
integer:
max:value-
min:value
numeric:
required:
unique:table,column,except,idColumn:

validate method:
$validate=$request->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=>'required'
    ]);


best way to show error.
@error("email")
{{$message}}
@enderror

error display on view:
all error:
@if($errors->any())
    {{$errors}}
@endif


single error:
@if($errors->any())
    @foreach ($errors->get('email') as $err)
        {{$err}}
    @endforeach
@endif


first error display:-
@if($errors->any())
    {{$errors->first('email')}}
@endif



=============================
Database:-
database configeration on .env page.

use Illuminate\Support\Facades\DB;

DB::unprepared("select * from login where id=2");//sql injuction nahi stop karta hai. Not Use

selct():-
it's return result as array.
ex:-
DB::select('select * from login');
DB::select('select * from login where id=?',[1]);
or
DB::select('select * from login where id=:id',['id'=>1]);

function show()
{
    $data=DB::select('select * from login');
    return view('home',["data"=>$data]);
}

On view:
@foreach ($data as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
    </tr>
@endforeach

Agar ek record show karna ho.
<td>{{$data[0]->id}}</td>

with where :-
$data=DB::select('select * from login where gender=?',['Female']);
-----------------------
insert():-
DB::insert('insert into login(name,email) values(?,?)',['jack','John']);
DB::insert('insert into login(name,email) values(:name,:city)',["name"=>"jack","email"=>"j@gmail.com"]);
Ex:-
DB::insert('insert into login(name,email) values(?,?)',['John','Roy']);

----------------------
update():-
DB::update('update login set name=?,email=? where id=?',['jack','jack@gmail.com','229']);
----------------------
delete():-
DB::delete('delete from login where id=?',['229']);
---------------------
transactions:-
DB::transaction(function(){
    //your muliple query write
});
==========================================

Query Builder:-
How to all record fetch:
$data=DB::table('login')->get();


How to select specific column select:-
$data=DB::table('login')->select('name','email')->get();

How to show only unique record:-
$data=DB::table('login')->distinct()->get();


first:-
Jo first record fetch ho.
$data=DB::table('login')->where("gender",'Female')->first();
on view:  {{$data->name}}

value:-
sirf ek column ka record show hoga.
$data=DB::table('login')->where("gender","Female")->value('name');


find():-
jab kisi ek id ka record fetch karna ho.
$data=DB::table('login')->find(149);

pluck():-
ek column ka full record show hoga.
$data=DB::table('login')->pluck('name');


count():-
$data=DB::table('login')->count();

max():-
$data=DB::table('login')->max('salary');

min():-
$data=DB::table('login')->min('salary');


orWhere():-
$data=DB::table('login')->where('id',4)->orWhere('name','neha')->get();

whereBetween():-
$data=DB::table('login')->whereBetween('id',[7,12])->get();

whereDate():-
$data=DB::table('login')->whereDate('date','2021-03-12')->get();

whereMonth():-
$data=DB::table('login')->whereMonth('date','03')->get();

whereYear():-
$data=DB::table('login')->whereYear('date','2021')->get();

orderBy():-
whereDate():-
$data=DB::table('login')->orderBy('id','desc')->get();


inRandomOrder():-
$data=DB::table('login')->inRandomOrder()->get();




like():-
$data=DB::table('login')->where('name','like','s%')->get();

Group By and Having:-
$data=DB::table('login')->groupBy('name')->having('id', '>','50')->get();


take():-
first 5 record:
$data=DB::table('login')->take(5)->get();

skip():-
$data=DB::table('login')->skip(2)->take(5)->get();

Limit():-
$data=DB::table('login')->limit(5)->get();

offset():-
kaha se start karni hai.
$data=DB::table('login')->offset(3)->limit(5)->get();


If record exist:-
if(DB::table('login')->where('id',149)->exist())
{
    echo "Yes";
}



Insert:-
By query Builder.
DB::table('login')->insert([
       "name"=>'ram', 
       "email"=>'ram@gmail.com' 
    ]);


insertOrIgnore():    
DB::table('login')->insertOrIgnore([
       "name"=>'ram', 
       "email"=>'ram@gmail.com' 
    ]);

How to get insert id:-
DB::table('login')->insertGetId([
       "name"=>'ram', 
       "email"=>'ram@gmail.com' 
    ]);    


Update:-
DB::table('login')->where('id',2)->update([
        "name"=>'ram', 
       "email"=>'ram@gmail.com'
    ]);


updateOrInsert:-
agar data hai to usko update kar do or nahi hai to insert kar do.
DB::table('login')-updateOrInsert(
        ['email'=>"neha@gmail.com"],  //ye check karega ki hai to update nahi to insert
        ['name'=>"Neha","city"=>"Patna"]
    );   


delete:-
DB::table("login")->where("id",2)->delete();

=================================
pagination:-
paginate():-
DB::table('login')->paginate(5);

On View:
@foreach ($data as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->mobile}}</td>
    </tr>
@endforeach
For create link.
{{$data->links()}}

for Add Bootstrap:-
Open App\Providers\AppServiceProvider.php
Import this line
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::useBootstrap();
}
====================================

Migration:-
php artisan make:migration create_student_table

all migration run:
php artisan migrate

php artisan migrate:rollback
php artisan migrate:rollback --step=3
php artisan migrate:reset  //savi table delete hoga.
php artisan migrate:fresh  //drop all table and fresh create table again.


Renaming Table:-
php artisan make:migration rename_oldTableName_newTableName
Go to migrate file.
public function up()
{
    Schema::rename('oldTableName','newTableName')
}

public function down()  //agar old name again then rollback
{
    Schema::rename('newTableName','oldTableName')
}


Create Column:
increments()= $table->increments('id');
integer()= $table->integer('vote');
Char()= $table->char('name',100);
float()= $table->float('amount',8,2);
string() =$table->string('name',100);
text() =$table->text('description');
date() =$table->date('created_at');
time() =$table->time('create_time',$precision=0);
dateTime() =$table->dateTime('create_at',$precision=0);
year()= $table->year('created_year');


$table->id();
$table->string('name')->nullable();
$table->string('status')->default(0);
$table->timestamps();


How to add column:
ye sabse pahle ek new migration file create karega or waha pe jo column add karna hai usko
add karenge or last me migrate karenge

php artisan make:migration add_county_to_student --table=student  

How to drop column name:
php artisan make:migration droping_name_from_student --table=student
On Up function.
$table->dropColumn('name');

on Down function, me create ka code karenge.

=========================================

seeding:-
first create seeder.
php artisan make:seeder StudentSeeder
Now go to database/seeder

Open your seeder.
import some file bellow
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
public function run()
{
    $faker=Faker::create();
    foreach(range(1,10) as $value)
    {
        DB::table('student')->insert([
            "name"=>$faker->name(),
            "email"=>$faker->unique->safeEmail(),
            "password"=>Hash::make($faker->password)
        ]);
    }
}

Now
php artisan db:seed --class=StudentSeeder   //agar sirf ek seeder run karna hai.

or
Open DatabaseSeeder file jo default hota hai usko open kare or 
public function run()
{
    $this->call([
        StudentSeeder::class    
    ]);
}
php artisan db:seed

==========================================
Modal:-
php artisan make:model Student

php artisan make:model Student --migration   //moder and migration both create by one cmd.




==========================================
return redirect(route('index'))->with('status','Insert Success');
@if(session()->has('status'))
{{session('status')}}
@endif












