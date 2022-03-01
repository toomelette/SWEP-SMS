<?php


namespace App\Http\Requests\BudgetProposal;


use Illuminate\Foundation\Http\FormRequest;

class BudgetProposalFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'pap_title' => 'required|string|max:255',
            'pap_desc' => 'nullable|string|max:255',
            'ps' => 'nullable|string',
            'co' => 'nullable|string',
            'mooe' => 'nullable|string',
            'pcent_share' => 'nullable|int|max:100',
        ];
    }
}