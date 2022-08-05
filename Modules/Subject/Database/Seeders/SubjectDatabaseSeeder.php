<?php

namespace Modules\Subject\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Subject\Entities\Subject;

class SubjectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Subject::factory(20)->create();
        // $this->call("OthersTableSeeder");
    }
}
