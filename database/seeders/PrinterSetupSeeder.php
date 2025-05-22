<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrinterSetupSeeder extends Seeder
{
    public function run()
    {
      $printerSetting = [
    "province" => ["left" => "132.28px", "top" => "143.62px", "width" => "302.36px"],
    "city" => ["left" => "188.98px", "top" => "166.30px", "width" => "226.77px"],
    "c_firstname" => ["left" => "158.74px", "top" => "200.31px", "width" => "151.18px"],
    "c_middlename" => ["left" => "343.94px", "top" => "200.31px", "width" => "151.18px"],
    "c_lastname" => ["left" => "532.91px", "top" => "200.31px", "width" => "151.18px"],
    "c_sex" => ["left" => "94.49px", "top" => "241.89px", "width" => "170.08px"],
    "c_dob_d" => ["left" => "415.75px", "top" => "241.89px", "width" => "56.69px"],
    "c_dob_m" => ["left" => "510.24px", "top" => "241.89px", "width" => "113.39px"],
    "c_dob_y" => ["left" => "661.42px", "top" => "241.89px", "width" => "56.69px"],
    "c_pob_brgy" => ["left" => "170.08px", "top" => "283.46px", "width" => "207.87px"],
    "c_pob_city" => ["left" => "396.85px", "top" => "283.46px", "width" => "120.94px"],
    "c_pob_province" => ["left" => "540.47px", "top" => "283.46px", "width" => "177.64px"],
    "c_typeofbirth" => ["left" => "113.39px", "top" => "336.38px", "width" => "139.84px"],
    "c_childwas" => ["left" => "302.36px", "top" => "336.38px", "width" => "139.84px"],
    "c_birthOrder" => ["left" => "491.34px", "top" => "336.38px", "width" => "139.84px"],
    "c_weight" => ["left" => "661.42px", "top" => "336.38px", "width" => "68.03px"],
    "m_firstname" => ["left" => "158.74px", "top" => "377.95px", "width" => "151.18px"],
    "m_middlename" => ["left" => "343.94px", "top" => "377.95px", "width" => "151.18px"],
    "m_lastname" => ["left" => "532.91px", "top" => "377.95px", "width" => "151.18px"],
    "m_citizenship" => ["left" => "170.08px", "top" => "415.75px", "width" => "113.39px"],
    "m_religion" => ["left" => "585.83px", "top" => "415.75px", "width" => "170.08px"],
    "m_totalbornalive" => ["left" => "94.49px", "top" => "468.66px", "width" => "94.49px"],
    "m_totalstillaliveinclude" => ["left" => "196.54px", "top" => "468.66px", "width" => "109.61px"],
    "m_totalbornalivebutdead" => ["left" => "317.48px", "top" => "468.66px", "width" => "109.61px"],
    "m_occupation" => ["left" => "442.20px", "top" => "468.66px", "width" => "207.87px"],
    "m_ageBorn" => ["left" => "661.42px", "top" => "468.66px", "width" => "105.83px"],
    "m_res_brgy" => ["left" => "151.18px", "top" => "498.90px", "width" => "200.32px"],
    "m_res_city" => ["left" => "366.61px", "top" => "498.90px", "width" => "113.39px"],
    "m_res_province" => ["left" => "487.56px", "top" => "498.90px", "width" => "139.84px"],
    "m_res_country" => ["left" => "634.96px", "top" => "498.90px", "width" => "132.28px"],
    "f_firstname" => ["left" => "158.74px", "top" => "544.25px", "width" => "151.18px"],
    "f_middlename" => ["left" => "343.94px", "top" => "544.25px", "width" => "151.18px"],
    "f_lastname" => ["left" => "532.91px", "top" => "544.25px", "width" => "151.18px"],
    "f_citizenship" => ["left" => "113.39px", "top" => "597.17px", "width" => "132.28px"],
    "f_religion" => ["left" => "283.46px", "top" => "597.17px", "width" => "170.08px"],
    "f_occupation" => ["left" => "480.00px", "top" => "597.17px", "width" => "162.52px"],
    "f_ageBorn" => ["left" => "661.42px", "top" => "597.17px", "width" => "102.05px"],
    "f_res_brgy" => ["left" => "151.18px", "top" => "631.18px", "width" => "200.32px"],
    "f_res_city" => ["left" => "366.61px", "top" => "631.18px", "width" => "113.39px"],
    "f_res_province" => ["left" => "487.56px", "top" => "631.18px", "width" => "139.84px"],
    "f_res_country" => ["left" => "634.96px", "top" => "631.18px", "width" => "132.28px"],
    "mop_date_m" => ["left" => "132.28px", "top" => "691.65px", "width" => "75.59px"],
    "mop_date_d" => ["left" => "211.65px", "top" => "691.65px", "width" => "41.57px"],
    "mop_date_y" => ["left" => "257.01px", "top" => "691.65px", "width" => "60.47px"],
    "mop_place_city" => ["left" => "393.07px", "top" => "691.65px", "width" => "139.84px"],
    "mop_place_province" => ["left" => "548.03px", "top" => "691.65px", "width" => "83.15px"],
    "mop_place_country" => ["left" => "642.52px", "top" => "691.65px", "width" => "113.39px"],
    "coaab_name" => ["left" => "151.18px", "top" => "835.28px", "width" => "245.67px"],
    "coaab_position" => ["left" => "170.08px", "top" => "857.95px", "width" => "226.77px"],
    "coaab_address" => ["left" => "472.44px", "top" => "808.82px", "width" => "291.02px"],
    "coaab_date" => ["left" => "453.54px", "top" => "857.95px", "width" => "302.36px"],
    "coaab_time" => ["left" => "480.00px", "top" => "782.36px", "width" => "68.03px"],
    "coi_name" => ["left" => "151.18px", "top" => "948.66px", "width" => "245.67px"],
    "coi_relationship" => ["left" => "196.54px", "top" => "971.34px", "width" => "200.31px"],
    "coi_address_brgy" => ["left" => "132.28px", "top" => "994.02px", "width" => "272.13px"],
    "coi_date" => ["left" => "132.28px", "top" => "1016.69px", "width" => "264.57px"],
    "prepby_name" => ["left" => "510.24px", "top" => "956.22px", "width" => "245.67px"],
    "prepby_title" => ["left" => "517.80px", "top" => "978.90px", "width" => "238.11px"],
    "prepby_date" => ["left" => "472.44px", "top" => "1002.02px", "width" => "283.46px"]
];


        DB::table('printer_setups')->insert([
            'printer_brand' => 'Cannon',
            'printer_unit' => 'G3010',
            'form_no' => '102-a-v8-2016',
            'printer_setting' => json_encode($printerSetting)
        ]);
    }
}
