<?php

use Illuminate\Database\Seeder;

class UploadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uploads')->insert([
            'uid' 	    => 0,
            'name' 		=> 'avatar.jpeg',
            'path' 		=> '/assets/apps/img/avatar.jpeg',
            'url' 		=> '/assets/apps/img/avatar.jpeg',
            'extension' => 'jpg',
            'size' 		=> '89657',
            'md5' 		=> 'ab92a944e8a4846654efcf54d846e9ad',
            'sha1' 		=> '61c8f679b73ba9c6fc796b8b5cc03b79b2191d64',
            'disk' 		=> 'local',
            'download' 	=> 0,
            'status'  	=> 1,
            'sort' 	=> 0,
        ]);
    }
}
