<?php


namespace App\Http\Controllers;


use App\Http\Requests\BudgetProposal\BudgetProposalFormRequest;
use App\Models\RecommendedBudget;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BudgetProposalController extends Controller
{
    public function create(){
        return view('dashboard.recommended_budget.create');
    }

    public function index(Request $request){

        if(request()->ajax() && $request->has('draw')){
            $rec_budget = RecommendedBudget::query();
            return DataTables::of($rec_budget)
                ->editColumn('action',function ($data){
                    return 1;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }

        if($request->has('year') && $request->has('resp_center')){


            return view('dashboard.recommended_budget.index')->with([
                'request' => $request,
            ]);

        }

        return view('dashboard.recommended_budget.pre_index');
    }

    public function store(BudgetProposalFormRequest $request){
        if(!$request->has('year') || !$request->has('resp_center') || $request->year == '' || $request->resp_center == ''){
            abort(503,'No year and responsibility center assigned.');
        }
        $bp  = new RecommendedBudget;
        
    }
}