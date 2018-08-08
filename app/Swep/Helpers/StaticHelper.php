<?php

namespace App\Swep\Helpers;



class StaticHelper{




	// Disbursement Voucher
    public static function dv_mode_of_payment(){

        return ['CASH' => 'CASH', 'CHECK' => 'CHECK', 'OTHERS' => 'OTHERS'];
        
    }



    // Employee
    public static function civil_status(){

        return [

	        'SINGLE' => 'SINGLE', 
	        'MARRIED' => 'MARRIED', 
	        'WIDOWED' => 'WIDOWED', 
	        'SEPERATED' => 'SEPERATED', 
	        'OTHERS' => 'OTHERS'

	    ];
    
    }




    public static function educ_level(){

        return [

	        'ELEMENTARY' => 'ELEMENTARY', 
	        'SECONDARY' => 'SECONDARY', 
	        'VOCATIONAL/TRADE COURSE' => 'VOCATIONAL/TRADE COURSE',
	        'COLLEGE' => 'COLLEGE', 
	        'GRADUATE STUDIES' => 'GRADUATE STUDIES'

	    ];
    
    }




    // Leave Application
    public static function leave_types(){

        return ['Vacation' => 'T1001', 'Sick' => 'T1002', 'Maternity' => 'T1003', 'Others' => 'T1004'];
    
    }



    public static function vacation_types(){

        return ['To seek employment' => 'TV1001', 'others' => 'TV1002'];
    
    }



    public static function spent_vacation(){

        return ['Within the Philippines' => 'SV1001', 'Abroad' => 'SV1002'];
    
    }



    public static function spent_sick(){

        return ['In Hospital' => 'SS1001', 'Out Patient' => 'SS1002'];
    
    }



    public static function commutation_types(){

        return ['Requested' => 'true', 'Not Requested' => 'false'];
    
    }




    // Profile
    public static function user_colors(){

        return [

	      'Blue/Dark' => 'sidebar-mini skin-blue',
	      'White/Dark' => 'sidebar-mini skin-black',
	      'Purple/Dark' => 'sidebar-mini skin-purple',
	      'Green/Dark' => 'sidebar-mini skin-green',
	      'Red/Dark' => 'sidebar-mini skin-red',
	      'Yellow/Dark' => 'sidebar-mini skin-yellow',
	      'Blue/Light' => 'sidebar-mini skin-blue-light',
	      'White/Light' => 'sidebar-mini skin-black-light',
	      'Purple/Light' => 'sidebar-mini skin-purple-light',
	      'Green/Light' => 'sidebar-mini skin-green-light',
	      'Red/Light' => 'sidebar-mini skin-red-light',
	      'Yellow/Light' => 'sidebar-mini skin-yellow-light',

	    ];

    
    }




    // Signatories
    public static function signatory_types(){

        return [

            '1 - ASSISTANT ADMINISTRATOR' => '1',
            '2 - ACCOUNTING VIS' => '2',
            '3 - HRU VIS' => '3',
            '4 - PROPERTY VIS' => '4',
            '5 - RECORDS VIS' => '5',
            '6 - TBM VIS' => '6',
            '7 - LMD VIS' => '7',
            '8 - SRED VIS' => '8',
            '9 - LEGAL VIS' => '9',
            '10 - RDE VIS' => '10',
            '11 - SOILS VIS' => '11',
            '12 - SUGAR VIS' => '12',

        ];

    
    }




    // File Directories
    public static function archive_dir(){

        return 'E:\XAMPP\htdocs\swep_document_storage';
    
    }








}