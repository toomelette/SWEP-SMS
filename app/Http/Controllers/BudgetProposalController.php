<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class BudgetProposalController extends Controller
{
    public function create(){
        return view('dashboard.budget_proposal.create');
    }

    public function index(Request $request){
        if(request()->ajax()){

        }

        if($request->has('year') && $request->has('dept')){


            return view('dashboard.budget_proposal.index')->with([
                'request' => $request,
            ]);

        }

        return view('dashboard.budget_proposal.pre_index');
    }
}