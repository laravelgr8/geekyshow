
laravel 9 me Senctum api default install rahta hai,
kernel.php ke api array me senctum ka middleware comment rahta hai usko uncomment karna parta hai

aap jo model use kar rahe hai uspe import kare
use Laravel\Sanctum\HasApiTokens;
or class ke under jaha use key hai usme v import kare
use HasApiTokens,


On web.php
Route::middleware('auth:sanctum')->('/student',[StudentController::class,'index']);

or

Route::middleware(['auth:sanctum'])->group(function(){
	//define all route
});

ab student route ko use karne ke liye postman me kuchh parameter pass karna parega
Accept : Application/json
Authorization : Bearer 2|GJHGJHJHGJHJHJHJHJHrdsdf  //this is your token

go to Auth and select Bearer Token option in type select box
you can see the token option here put your token



jaha how log user ko signup karte hai waha pe token generate karenge

public function signup(Request $request){
	$user=User::create([
		'name' => $request->name,
		'email' => $request->email,
		'password' => Hash::make($request->password)
	]);
    $token=$user->createToken('mytoken')->plainTextToken
    return response([
    	'user' => $user,
    	'token'=> $token
    ],201);
}



Now work on logout:
in logout all token delete
public function logout()
{
	auth()->user()->tokens()->delete()
}


Now work on login:
public function login(Request $request)
{
	$user=User::where('email',$request->email)->first();
	if(!$user || !Hash::check($request->password,$user->password))
	{
		return response([
			'message' => 'invalid user id'
		],401);
	}

	$token=$user->createToken('mytoken')->plainTextToken
    return response([
    	'user' => $user,
    	'token'=> $token
    ],200);
}

=========================

Normal Api without sanctum

How to create get api:
public function index()
{
	return Student::all();
}


how to show specific record:
public function show($id)
{
	return Student::find($id);
}



insert api
public function create(Request $request)
{
	$request->validate([
		'name' => 'required',
		'email' => 'required',
		'password' => 'required',
	]);
	return Student::create($request->all());
}



update data:
public function update(Request $request, $id)
{
	$student=Student::find($id);
	$student->update($request->all());
	return $student;
}


delete api:
function destroy($id)
{
	Student::find($id)->delete();
}
