ORM:-

=>how to define specific table
protected $table='my_table';

=>If you want to remove created_at and updated_at
protected $timestamp=false;

=>if you want to change crated_at name when you fetch data
const CREATED_AT='create';

=>if you want to define database connect on model
protected $connection='mysql';

=>if we want to add where condition in model query
Student::where('id',2)->get();
Student::where('id',2)->first();

=>if data not found then show message
Student::where('marks','=',91)->firstOr(function(){
    echo "Not Found";
});


=>id data exsist then display othewise data insert then fetch
Student::firstOrCreate(
    ["email"=>"suman@gmail.com"],
    ["name"=>"suman","mobile"=>"878445874","city"=>"noida0","marks"=>90]
);

=>How to use aggregates function in model
Student::where('subject','php')->max('marks');

=>How to data insert by model
$student=new Student;
$student->name='jack';
$student->email='jack@gmail.com';
$student->save();

or

Student::create([
	"name"=>"Rahul",
	"email"=>"rahul@gmail.com"
]);




=>How to update recoed using model
$student=Student::find(5);
$student->name='jack';
$student->email='jack@gmail.com';
$student->save();

or

Student::where('city','noida')->update([
	"name"=>"jack",
	"email"=>"jack@gmail.com"
]);

=> if data exist then update outherwise data insert
Studnt::updateOrCreate(
	["email"=>"jack@gmail.com"].
	["name"=>"jack","city"=>"agara"]
);


\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\Relation\\\\\\\\\\\\\\\\\\\\\\\\
oneToone relation:-
syntex:
hasOne(Model_class,'foreign_key','local_key');
belongsTo(Model_class,'foreign_key','owner_key');

we have to table (1) Custome (2)Mobile
on customer model:-
public function mobile()
{
	return $this->hasOne(Mobile:class)
}

on mobile model:-
public function customer()
{
	return $this->belongsTo(Customer::class);
}
----
How to data insert both table useing model (foreign key)
public function show()
{
    $mobile1=new Mobile();
    $mobile1->model='Vivo 1905';

    $customer=new Customer();
    $customer->name='Ravi';
    $customer->email='ravi@gmail.com';
    $customer->save();

    $customer->mobile()->save($mobile1);  //here mobile() is method name, whose define in customer table
}
------

mobiles table display by customer table:
on customer model:-
public function mobile()
{
	return $this->hasOne(Mobile:class)
}
on controller:
return Customer::find(1)->mobile;

-----
customer table display by mobile model
on mobile model
public function customer()
{
    return $this->belongsTo(Customer::class);
}

on controller:
return Mobile::find(1)->customer;
======================================

one to Many:-
syntex:-
hasMany(Model_class,'foreign_key','local_key');

belongsTo(Model_class,'foreign_key','local_key');

we have 2 table 1. User 2.Post
one user has multiple post.

on User Model:
public function post()
{
	return $this->hasMany(Post::class);
}

on Post Model:
public function user()
{
	return $this->belongsTo(User::class);
}


Insert by model:-
first insert in user data only becouse we want multiple entry in post table 
$user=new User();
$user->name="john";
$user->email="john@gmail.com";
$user->password="123456";
$user->save();


Now data insert in post table
function post_insert($id)
{
	$user=User::find($id);//yaha id ko hamlog url se recive karenge
	$post=new Post();
	$post->title='title1';
	$post->content='content1';
	$user->post()->save($post);
}


User model ke through post table record fetch
$user=user::find(1)->post;
return $user;


Post model ke through user's data fetch
$post=Post::find(3)->user;
return $post;
