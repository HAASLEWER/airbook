<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Auth;
use DB;

use Carbon\Carbon;

use App\Credit;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	//Change valid status of all tickets that no longer qualify as valid
	$schedule->call(function () {
		DB::table('tickets')
			->where('dateofdeparture', '<=', Carbon::now())	
			->update(['valid' => 0]);
	})->everyMinute();

	//Decrement credits from users that have newly invalid tickets that are still tradable and mark them untradable once complete
	$schedule->call(function () {

		$where["valid"] = '0';
        	$where["tradable"] = '1';

		$tickets = DB::table('tickets')
				   ->where($where)
				   ->get();

		foreach ($tickets as $ticket) {
			//Determine the credit value on the class of the ticket to set the decrement amount
        		switch ($ticket->class) {
                		case 'Economy':
                        		$ticketValue = 1;
                        		break;
                		case 'Business':
                        		$ticketValue = 2;
                        		break;
                		case 'First':
                        		$ticketValue = 3;
                        		break;
                		case 'Premium':
                        		$ticketValue = 4;
                        		break;
                		default:
                        		$ticketValue = 1;
                        		break;
        		}

                        DB::table('credits')
                                ->where('user_id', $ticket->user_id)
                                ->decrement('trade', $ticketValue);

			DB::table('tickets')
				->where('id', $ticket->id)
				->update(['tradable' => 0]);
		}		
	})->everyMinute();
    }
}
