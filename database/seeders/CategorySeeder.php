<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category' => 'Technical Support',
            ],
            [
                'category' => 'Complaints',
            ],
            [
                'category' => 'Question and Inquiries',
            ],
            [
                'category' => 'Events and Activities'
            ],
            [
                'category' => 'Service Requests'
            ],
            [
                'category' => 'Emergency Services'
            ],
            [
                'category' => 'Administrative Task'
            ],
            [
                'category' => 'Tracking Inquiries'
            ]
        ]);
    }
}
