<?php

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            'answer' => '2534',
            'state' => '0A2B',
            'questionID' => 1
        ]);

        DB::table('answers')->insert([
            'answer' => '9831',
            'state' => '0A2B',
            'questionID' => 1
        ]);

        DB::table('answers')->insert([
            'answer' => '0143',
            'state' => '3A0B',
            'questionID' => 1
        ]);

        DB::table('answers')->insert([
            'answer' => '0473',
            'state' => '2A0B',
            'questionID' => 1
        ]);
    }
}
