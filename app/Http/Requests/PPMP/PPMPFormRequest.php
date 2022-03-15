<?php


namespace App\Http\Requests\PPMP;


use App\Swep\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PPMPFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'ppmp_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('ppu_ppmp','ppmp_code')->ignore($this->request->get('slug'),'slug'),
            ],
            'pap_code' => [
                'required',
                Rule::exists('ppu_rec_budget','pap_code'),
            ],
            'mode_of_proc' => [
                'required',
                Rule::in(array_keys(Helper::modesOfProcurement())),
                'max:50',
            ],
            'budget_type' => [
                'required',
                Rule::in(array_keys(Helper::budgetTypes())),
            ],
            'qty' => 'required|int',
            'gen_desc' => 'required|string|max:255',
            'unit_cost' => 'required|string|max:50',
            'uom' => [
                'required',
                'string',
                'max:10',
                Rule::in(array_keys(Helper::unitsOfMeasurementPPMP()))
            ],
            'remark' => 'nullable|string|max:255',
        ];
        foreach (Helper::milestones() as $month){
            $rules['qty_'.strtolower($month)] = ['nullable','int'];
        }
        return $rules;
    }
}