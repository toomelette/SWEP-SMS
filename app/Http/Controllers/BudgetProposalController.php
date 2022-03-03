<?php


namespace App\Http\Controllers;


use App\Http\Requests\BudgetProposal\BudgetProposalFormRequest;
use App\Models\RecommendedBudget;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
                ->addColumn('action',function ($data){
                    return 1;
                })
                ->editColumn('pap_title',function ($data){
                    if($data->pap_desc == ''){
                        return $data->pap_title;
                    }
                    return $data->pap_title.
                        '<div class="table-subdetail">
                        '.$data->pap_desc.'
                        </div>';
                })
                ->addColumn('details',function ($data){
                    return '<div class="table-subdetail-no-border ">
                                <table style="width: 100%;" class="table-borderless">
                                    <tr>
                                      <td>Fiscal Year:</td>
                                      <td>'.$data->fiscal_year.'</td>
                                    </tr>
                                    <tr>
                                      <td>Budget Type:</td>
                                      <td>'.$data->budget_type.'</td>
                                    </tr>
                                    <tr>
                                      <td>Resp. Center:</td>
                                      <td>'.$data->resp_center.'</td>
                                    </tr>
                                 </table>
                            </div>';
                })
                ->editColumn('ps',function ($data){
                    return number_format($data->ps,2);
                })
                ->editColumn('co',function ($data){
                    return number_format($data->co,2);
                })
                ->editColumn('mooe',function ($data){
                    return number_format($data->mooe,2);
                })
                ->editColumn('pcent_share',function ($data){
                    if($data->pcent_share != ''){
                        return $data->pcent_share.' %';
                    }
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }

        if($request->ajax() && $request->has('typeahead') && $request->typeahead == true){
            return $this->typeAhead($request);
        }

        if($request->has('fiscal_year') && $request->has('resp_center')){


            return view('dashboard.recommended_budget.index')->with([
                'request' => $request,
            ]);

        }

        return view('dashboard.recommended_budget.pre_index');
    }

    private  function typeAhead($request){

        if($request->for == 'division'){
            $arr = [];
            $bps = RecommendedBudget::query()->where('division','like','%'.$request->get('query').'%')->get();
            if($bps->count() > 0) {
                foreach ($bps as $bp){
                    array_push($arr,[
                        'id' => $bp->division,
                        'name' => $bp->division,
                    ]);
                }
            }
            return $arr;
        }
        if($request->for == 'section'){
            $arr = [];
            $bps = RecommendedBudget::query()->where('section','like','%'.$request->get('query').'%')->get();
            if($bps->count() > 0) {
                foreach ($bps as $bp){
                    array_push($arr,[
                        'id' => $bp->section,
                        'name' => $bp->section,
                    ]);
                }
            }
            return $arr;
        }
    }

    public function store(BudgetProposalFormRequest $request){
        if(!$request->has('fiscal_year') || !$request->has('resp_center') || $request->fiscal_year == '' || $request->resp_center == ''){
            abort(503,'No year and responsibility center assigned.');
        }
        $bp  = new RecommendedBudget;
        $bp->slug = Str::random(16);
        $bp->pap_title = $request->pap_title;
        $bp->budget_type = $request->budget_type;
        $bp->pap_code = $request->pap_code;
        $bp->pap_desc = $request->pap_desc;
        $bp->fiscal_year = $request->fiscal_year;
        $bp->resp_center = $request->resp_center;
        $bp->pcent_share = $request->pcent_share;
        $bp->ps = Helper::sanitizeAutonum($request->ps);
        $bp->co = Helper::sanitizeAutonum($request->co);
        $bp->mooe = Helper::sanitizeAutonum($request->mooe);
        $bp->division = $request->division;
        $bp->section = $request->section;
        if($bp->save()){
            return $bp->only('slug');
        }

    }
}