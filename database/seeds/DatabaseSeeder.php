<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

	    factory(App\User::class, 100)->create();
	    factory(App\Ticket::class, 500)->create();
	    factory(App\Credit::class, 500)->create();
	}
}
