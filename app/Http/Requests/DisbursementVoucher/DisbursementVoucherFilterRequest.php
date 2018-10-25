<?php

namespace App\Http\Requests\DisbursementVoucher;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;

    }



    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            'fs' => 'nullable|max:11|string',
            'pi' => 'nullable|max:11|string',
            'dn' => 'nullable|max:20|string',
            'dun' => 'nullable|max:20|string',
            'pc' => 'nullable|max:20|string',
            'df' => 'date_format:"m/d/Y"|nullable',
            'dt' => 'date_format:"m/d/Y"|nullable',

        ];
    }




}
