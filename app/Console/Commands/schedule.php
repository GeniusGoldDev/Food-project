<?php

namespace App\Console\Commands;

use App\Restaurant;
use Carbon\Carbon;
use Illuminate\Console\Command;

class schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:restaurants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Schedule Restaurnts based on their scheduleing data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {

        // Fetches today's week name and converts it into lowercase
        $day = strtolower(Carbon::now()->timezone(config('app.timezone'))->format('l'));

        // Gets All Restaurants
        $restaurants = Restaurant::all();
        // Loop All Restaurants with and for each restaurants variable as $restaurant
        foreach ($restaurants as $restaurant) {

            // Get Timing Data From Database
            $schedule_data = $restaurant->schedule_data;
            // Json Decode The data
            $schedule_data = json_decode($schedule_data);

            // Checks if the restaurant has Schedule_data
            if ($schedule_data) {

                if (isset($schedule_data->$day)) {

                    // Checks if it has more than 0 data
                    if (count($schedule_data->$day) > 0) {
                        // Loops Data into Time Slots
                        foreach ($schedule_data->$day as $time) {
                            // Checks for Time Slots, Where  Current Time is In between those Slots If true its open
                            if (Carbon::parse($time->open) < Carbon::now()->timezone(config('app.timezone')) && Carbon::parse($time->close) > Carbon::now()->timezone(config('app.timezone'))) {
                                $is_active = true;
                            }
                            // If Slots are not in Current Time The Restaurant is Closed
                            else {
                                $is_active = false;
                            }
                        }
                        // dd($is_active);
                        // Saves to Database (coloumn -> schedule_data )
                        $restaurant->is_active = $is_active;
                        $restaurant->save();
                    }
                }
            }
        }
    }
}
