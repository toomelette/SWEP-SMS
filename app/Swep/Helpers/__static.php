<?php

namespace App\Swep\Helpers;



class __static{




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

        return ['Vacation' => 'VAC', 'Sick' => 'SICK', 'Maternity' => 'MAT', 'Forced' => 'FORCED', 'Others' => 'OTHERS'];
    
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

        return 'D:/swep_storage/';
    
    }




    // Document Types
    public static function document_types(){

        return [

            'Administrative Order' => 'ADMIN_ORD',
            'Circular Letter' => 'CIR_LTR',
            'Memo' => 'MEMO',
            'Memorandum Circular'=> 'MEMO_CIR',
            'Memorandum Order' => 'MEMO_ORD',
            'Secretary Certificate' => 'SEC_CERT',
            'Sugar Order' => 'SUGAR_ORD',
            'Special Order' => 'SPECIAL_ORD',
            'VOM' => 'VOM',
            'Incoming Letter' => 'IN_LTR',
            'Outgoing Letter' => 'OUT_LTR',
            'Others' => 'OTHERS',

        ];
    
    }




    // Month
    public static function months(){

        return [

            'January'  => '01',
            'February'  => '02',
            'March'  => '03',
            'April'  => '04',
            'May'  => '05',
            'June' => '06',
            'July' => '07',
            'August' => '08',
            'September' => '09',
            'October' => '10',
            'November' => '11',
            'December' => '12',

        ];
    
    }




    // Days
    public static function days(){

        return [

            '01'  => '01',
            '02'  => '02',
            '03'  => '03',
            '04'  => '04',
            '05'  => '05',
            '06'  => '06',
            '07'  => '07',
            '08'  => '08',
            '09'  => '09',
            '10'  => '10',
            '11'  => '11',
            '12'  => '12',
            '13'  => '13',
            '14'  => '14',
            '15'  => '15',
            '16'  => '16',
            '17'  => '17',
            '18'  => '18',
            '19'  => '19',
            '20'  => '20',
            '21'  => '21',
            '22'  => '22',
            '23'  => '23',
            '24'  => '24',
            '25'  => '25',
            '26'  => '26',
            '27'  => '27',
            '28'  => '28',
            '29'  => '29',
            '30'  => '30',
            '31'  => '31',

        ];
    
    }








}