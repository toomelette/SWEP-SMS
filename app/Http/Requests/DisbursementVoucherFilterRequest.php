<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;

    }



    public function rules(){

        return [
            
            'q' => 'nullable|max:50|string',
            'fs' => 'nullable|max:4|min:4|string',
            'pi' => 'nullable|max:4|min:4|string',
            'dn' => 'nullable|max:20|string',
            'dun' => 'nullable|max:20|string',
            'ac' => 'nullable|max:20|string',
            'df' => 'date_format:"mm/dd/yy"|nullable',
            'dt' => 'date_format:"mm/dd/yy"|nullable',

        ];
    }



    public function messages(){

        return [

            'q.string'  => 'Invalid Input! You must enter a string value.',
            'q.max'  => 'The Field may not be greater than 50 characters.',

            'fs.string'  => 'Invalid Input! You must enter a string value.',
            'fs.max'  => 'The Field may not be greater than 4 characters.',
            'fs.min'  => 'The Field may not be lesser than 4 characters.',

            'pi.string'  => 'Invalid Input! You must enter a string value.',
            'pi.max'  => 'The Field may not be greater than 4 characters.',
            'pi.min'  => 'The Field may not be lesser than 4 characters.',

            'dn.string'  => 'Invalid Input! You must enter a string value.',
            'dn.max'  => 'The Field may not be greater than 20 characters.',

            'dun.string'  => 'Invalid Input! You must enter a string value.',
            'dun.max'  => 'The Field may not be greater than 20 characters.',

            'ac.string'  => 'Invalid Input! You must enter a string value.',
            'ac.max'  => 'The Field may not be greater than 20 characters.',

            'df.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',
            'dt.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

        ];

    }




}
