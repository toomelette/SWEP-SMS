<?php

namespace App\Swep\Helpers;



class __static{




	// Disbursement Voucher
    public static function dv_mode_of_payment(){

        return [
//            'CASH' => 'CASH',
            'CHECK' => 'MDS CHECK',
            'COM_CHECK' => 'COMMERCIAL CHECK',
            'ADA' => 'AUTO DEBIT ADJUSTMENT',
            'OTHERS' => 'OTHERS',
        ];
        
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

        return [

            'Vacation Leave' => 'VL', 
            'Sick Leave' => 'SL', 
            'Maternity Leave' => 'ML', 
            'Paternity Leave' => 'PL', 
            'Special Leave' => 'SPL',
            'Rehabilitation Leave' => 'RL',
            'Study Leave' => 'STL',
            'Special Emergency Leave' => 'SEL',
            'Magna Carta Leave' => 'MC',
            'Forced Leave' => 'FL',
            'Solo Parent Leave' => 'SOLO',
        ];

    
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
            '13 - DV PAYMENT APPROVAL' => '13',

        ];

    
    }




    // File Directories
    public static function archive_dir(){

        return '/home/swep_afd_storage/';
    
    }




    // Document Types
    public static function document_types($reverse = false){
        if($reverse == true){
            return [

                'ADMIN_ORD'=>'Administrative Order' ,
                'CIR_LTR'=>'Circular Letter' ,
                'MEMO'=>'Memo' ,
                'MEMO_CIR'=>'Memorandum Circular',
                'MEMO_ORD'=>'Memorandum Order' ,
                'SEC_CERT'=>'Secretary Certificate' ,
                'SUGAR_ORD'=>'Sugar Order' ,
                'SPECIAL_ORD'=>'Special Order' ,
                'VOM'=>'VOM' ,
                'IN_LTR'=>'Incoming Letter' ,
                'OUT_LTR'=>'Outgoing Letter' ,
                'OTHERS'=>'Others' ,

            ];
        }
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




    // Leave Card
    public static function document_types_leave_card(){

        return [
                'Leave' => 'LEAVE', 
                'Overtime' => 'OT', 
                'Tardy' => 'TARDY', 
                'Undertime' => 'UT', 
                'Monitize' => 'MON', 
                'Compensatory' => 'COM'
            ];
    
    }




    public static function leave_card_charges(){

        return ['Overtime' => 'OT', 'Vacation' => 'VL', 'Sick' => 'SL'];
    
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






}
