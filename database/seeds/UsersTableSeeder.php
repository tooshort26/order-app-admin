<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
		        'name' => 'Adminstrator Mai Place',
		        'email' => 'admin@yahoo.com',
		        'email_verified_at' => now(),
		        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
		        'remember_token' => Str::random(10),
		        'mobile_no' => '09193693499'
	    ]);
    	 
    }
}
