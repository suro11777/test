<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'name' => 'event 1',
                'date' => '2020-07-03 11:00:31',
                'city' => 'Kiev'
            ],
            [
                'name' => 'event 2',
                'date' => '2020-07-07 11:00:31',
                'city' => 'Helsinki'
            ],
            [
                'name' => 'event 3',
                'date' => '2020-09-07 11:00:31',
                'city' => 'Helsinki'
            ],
        ]);
    }
}


