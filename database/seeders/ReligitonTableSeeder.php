<?php

namespace Database\Seeders;

use App\Models\Religiton;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligitonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religitons')->delete();
        $religions = [

            [
                'en'=> 'Muslim',
                'ar'=> 'مسلم'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'مسيحي'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],

        ];

        foreach ($religions as $R) {
            Religiton::create(['Name' => $R]);
        }
    }
}
