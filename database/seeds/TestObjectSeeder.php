<?php

use Illuminate\Database\Seeder;
use App\TestObject;

class TestObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestObject::create([
            'name'  => 'Apple',
            'label' => 'A kind of fruit',
        ]);

        TestObject::create([
            'name'  => 'Banana',
            'label' => 'A kind of fruit',
        ]);

        TestObject::create([
            'name'  => 'Car',
            'label' => 'A kind of vehicle',
        ]);



    }
}
