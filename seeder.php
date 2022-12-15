How to use faker:-
first create a seeder
php artisan make:seeder StudenSeeder

use Faker\Factory as Faker;
public function run()
{
	$faker=Faker::create();
	foreach(range(1,10) as $value){
		DB::table('students')->insert([
			"name" => $faker->name(),
			"city" => $faker->city(),
			"fee" => $faker->randomFloat(2),
                        'gender' => $faker->randomElement($array = array ('male', 'female')) ,
		]);
	}
}

Now go to databaseSeeder.php
public function run(){
	$this->call([
		StudentSeeder::class,
	]);
}

Now call seeder
php artisan db:seed

How to run specific seeder
php artisan db:seed --class=StudentSeeder
