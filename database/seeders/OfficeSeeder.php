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
                'office' => 'MMO - Personal Staff',
                'abbr' => 'PS'
            ],
            [
                'office' => 'MMO - Management Information System Division',
                'abbr' => 'MIS'
            ],
            [
                'office' => 'Municipal Disaster Risk Reduction and Management Office',
                'abbr' => 'MDRRMO'
            ],
            [
                'office' => 'MMO - Public Affairs, Information and Assistance Division',
                'abbr' => 'PAIAD'
            ],
            [
                'office' => 'MMO - Bids and Award Committee',
                'abbr' => 'BAC'
            ],
            [
                'office' => 'MMO - Procurement Office',
                'abbr' => 'PO'
            ],
            [
                'office' => 'MMO - Livelihood Division',
                'abbr' => 'LD'
            ],
            [
                'office' => 'MMO - Permits and Licenses Division',
                'abbr' => 'BPLO'
            ],
            [
                'office' => 'MMO - General Services Office',
                'abbr' => 'GSO'
            ],
            [
                'office' => 'MMO - Population Development Division',
                'abbr' => 'PopDev'
            ],
            [
                'office' => 'MMO - Nutrition Division',
                'abbr' => 'ND'
            ],
            [
                'office' => 'Municipal Enterprise Management Office',
                'abbr' => 'MEMO'
            ],
            [
                'office' => 'MMO - Barangay Affairs Division',
                'abbr' => 'BA'
            ],
            [
                'office' => 'MMO - Human Resource Management Office',
                'abbr' => 'HRMO'
            ],
            [
                'office' => 'MMO - Civil Security Unit',
                'abbr' => 'CSU'
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
