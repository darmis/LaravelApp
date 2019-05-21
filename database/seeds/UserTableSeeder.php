<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Test',
            'lastname' => 'Testing',
            'role_id' => '1',
            'email' => 'test@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('notes')->insert([
            'user_id' => '1',
            'note' => 'Cia gali buti jusu privatus uzrasai',
        ]);
    }
}
