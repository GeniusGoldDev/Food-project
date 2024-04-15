<?php

namespace App\Console;

use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if (Schema::hasTable('restaurants')) {

            // $schedule->command('inspire')->hourly();

            // Fetches today's week name and converts it into lowercase
            $day = strtolower(Carbon::now()->timezone(config('app.timezone'))->format('l'));

            // Gets All Restaurants
            $restaurants = Restaurant::all();
            // Loop All Restaurants with and for each restaurants variable as $restaurant
            foreach ($restaurants as $restaurant) {

                if ($restaurant->is_schedulable) {
                    // Get Timing Data From Database
                    $schedule_data = $restaurant->schedule_data;
                    // Json Decode The data
                    $schedule_data = json_decode($schedule_data);

                    // Checks if the restaurant has Schedule_data
                    if ($schedule_data) {

                        if (isset($schedule_data->$day)) {

                            // Checks if it has more than 0 data
                            if (count($schedule_data->$day) > 0) {
                                $is_active = false;

                                // Loops Data into Time Slots
                                foreach ($schedule_data->$day as $time) {
                                    if (!$is_active) {
                                        // Checks for Time Slots, Where  Current Time is In between those Slots If true its open
                                        if (Carbon::parse($time->open) < Carbon::now()->timezone(config('app.timezone')) && Carbon::parse($time->close) > Carbon::now()->timezone(config('app.timezone'))) {
                                            $is_active = true;
                                        }
                                    }
                                }
                                // dd($is_active);
                                $restaurant->is_active = $is_active;
                                $restaurant->save();
                            }
                        }
                    }
                }
            }
        }

        // $schedule->command('schedule:restaurants')->everyMinute();
    }

/**
 * Register the commands for the application.
 *
 * @return void
 */
    public function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
};
