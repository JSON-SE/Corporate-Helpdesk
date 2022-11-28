<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert([
            [
                'office' => 'Personal Staff',
                'abbr' => 'MMO-PS'
            ],
            [
                'office' => 'Management Information System Section',
                'abbr' => 'MMO-MIS'
            ],
            [
                'office' => 'Municipal Disaster Risk Reduction and Management Office',
                'abbr' => 'MDRRMO'
            ],
            [
                'office' => 'Public Affairs, Information and Assistance Division',
                'abbr' => 'MMO-PAIAD'
            ],
            [
                'office' => 'Bids and Award Committee',
                'abbr' => 'MMO-BAC'
            ],
            [
                'office' => 'Purchasing Office',
                'abbr' => 'MMO-PO'
            ],
            [
                'office' => 'Livelihood Division',
                'abbr' => 'MMO-LD'
            ],
            [
                'office' => 'Permits and Licenses Division',
                'abbr' => 'MMO-BPLO'
            ],
            [
                'office' => 'General Services Office',
                'abbr' => 'MMO-GSO'
            ],
            [
                'office' => 'Population Development Division',
                'abbr' => 'MMO-PopDev'
            ],
            [
                'office' => 'Nutrition Division',
                'abbr' => 'MMO-ND'
            ],
            [
                'office' => 'Municipal Enterprise Management Office',
                'abbr' => 'MEMO'
            ],
            [
                'office' => 'Barangay Affairs Division',
                'abbr' => 'MMO-BA'
            ],
            [
                'office' => 'Human Resource Management Office',
                'abbr' => 'MMO-HRMO'
            ],
            [
                'office' => 'Civil Security Unit',
                'abbr' => 'MMO-CSU'
            ],
            [
                'office' => 'Office of the Sangguniang Bayan',
                'abbr' => 'SBO'
            ],
            [
                'office' => 'Municipal Planning and Development Office',
                'abbr' => 'MPDO'
            ],
            [
                'office' => 'Municipal Budget Office',
                'abbr' => 'MBO'
            ],
            [
                'office' => 'Municipal Accounting Office',
                'abbr' => 'MACCO'
            ],
            [
                'office' => 'Municipal Treasurer Office',
                'abbr' => 'MTO'
            ],
            [
                'office' => 'Municipal Engineer Office',
                'abbr' => 'MEO'
            ],
            [
                'office' => 'Municipal Assessor Office',
                'abbr' => 'MAO'
            ],
            [
                'office' => 'Municipal Health Office',
                'abbr' => 'MHO'
            ],
            [
                'office' => "Municipal Mayor's Office",
                'abbr' => 'MMO'
            ],
            [
                'office' => 'Municipal Agriculture Office',
                'abbr' => 'DA'
            ],
            [
                'office' => 'Municipal Civil Registrar Office',
                'abbr' => 'MCRO'
            ],
            [
                'office' => 'Municipal Social Welfare and Development Office',
                'abbr' => 'MSWD'
            ],
            [
                'office' => 'Municipal Environment and Natural Resources Office',
                'abbr' => 'MENRO'
            ],
            [
                'office' => 'Commission On Audit',
                'abbr' => 'COA'
            ],
            [
                'office' => 'Commission On Elections',
                'abbr' => 'COMELEC'
            ],
            [
                'office' => 'Philippine National Police',
                'abbr' => 'PNP'
            ],
            [
                'office' => 'Bureau of Fire Protection',
                'abbr' => 'BFP'
            ],
            [
                'office' => 'Department of Interior Local Government',
                'abbr' => 'DILG'
            ],
        ]);
    }
}
