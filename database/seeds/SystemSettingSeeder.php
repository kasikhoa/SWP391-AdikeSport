<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_settings')->insert([
            'shop_name' => 'Adike',
            'site_title' => 'Just Do It',
            'email' => 'tungptse140843@fpt.edu.vn',
            // 'copyright_text' => '© 2021 Made with ♥ by tungptse140843@fpt.edu.vn'
        ]);
    }
}
